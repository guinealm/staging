<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

const IMPORT_CONFIRM_TOKEN = 'SI_IMPORTAR';
const ENABLE_PRE_CLEAN = false;

function responder(array $payload, int $statusCode = 200): void
{
    http_response_code($statusCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    exit;
}

function parsearFuente(?string $fuenteRaw): array
{
    $fuente = normalizarTextoUtf8($fuenteRaw);

    if ($fuente === '') {
        return [
            'titulo' => 'Fuente pendiente',
            'url' => null,
            'observaciones' => 'El campo fuente estaba vacio en el JSON.',
        ];
    }

    if (filter_var($fuente, FILTER_VALIDATE_URL) !== false) {
        return [
            'titulo' => 'Fuente enlazada',
            'url' => $fuente,
            'observaciones' => null,
        ];
    }

    return [
        'titulo' => $fuente,
        'url' => null,
        'observaciones' => null,
    ];
}

function normalizarTextoUtf8(?string $texto): string
{
    $valor = trim((string) $texto);

    // Fuerza UTF-8 normal para evitar parametros tratados como binario en comparaciones SQL.
    if (function_exists('mb_convert_encoding')) {
        $convertido = mb_convert_encoding($valor, 'UTF-8', 'UTF-8');
        if ($convertido !== false) {
            $valor = $convertido;
        }
    }

    return $valor;
}

function obtenerOInsertarId(PDO $pdo, string $tabla, string $nombre): int
{
    $mapa = [
        'corr_partidos' => [
            // Se fuerza utf8mb4_unicode_ci para evitar mezcla de collations al comparar texto.
            'select' => 'SELECT id FROM corr_partidos
                         WHERE nombre COLLATE utf8mb4_unicode_ci = CONVERT(:nombre USING utf8mb4) COLLATE utf8mb4_unicode_ci
                         LIMIT 1',
            'insert' => 'INSERT INTO corr_partidos (nombre, sigla) VALUES (:nombre, NULL)',
        ],
        'corr_fases' => [
            'select' => 'SELECT id FROM corr_fases
                         WHERE nombre COLLATE utf8mb4_unicode_ci = CONVERT(:nombre USING utf8mb4) COLLATE utf8mb4_unicode_ci
                         LIMIT 1',
            'insert' => 'INSERT INTO corr_fases (nombre, `orden`) VALUES (:nombre, NULL)',
        ],
        'corr_tribunales' => [
            'select' => 'SELECT id FROM corr_tribunales
                         WHERE nombre COLLATE utf8mb4_unicode_ci = CONVERT(:nombre USING utf8mb4) COLLATE utf8mb4_unicode_ci
                         LIMIT 1',
            'insert' => 'INSERT INTO corr_tribunales (nombre, ambito) VALUES (:nombre, NULL)',
        ],
        'corr_personas' => [
            'select' => 'SELECT id FROM corr_personas
                         WHERE nombre COLLATE utf8mb4_unicode_ci = CONVERT(:nombre USING utf8mb4) COLLATE utf8mb4_unicode_ci
                         LIMIT 1',
            'insert' => 'INSERT INTO corr_personas (nombre) VALUES (:nombre)',
        ],
    ];

    if (!isset($mapa[$tabla])) {
        throw new RuntimeException('Tabla no permitida para insercion automatica: ' . $tabla);
    }

    $stmtSelect = $pdo->prepare($mapa[$tabla]['select']);
    $stmtSelect->execute([':nombre' => $nombre]);
    $id = $stmtSelect->fetchColumn();

    if ($id !== false) {
        return (int) $id;
    }

    $stmtInsert = $pdo->prepare($mapa[$tabla]['insert']);
    $stmtInsert->execute([':nombre' => $nombre]);

    return (int) $pdo->lastInsertId();
}

function insertarLogImportacion(PDO $pdo, string $origen, int $casosImportados, string $observaciones): void
{
    $sql = 'INSERT INTO corr_import_log (origen, casos_importados, observaciones)
            VALUES (:origen, :casos_importados, :observaciones)';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':origen' => $origen,
        ':casos_importados' => $casosImportados,
        ':observaciones' => $observaciones,
    ]);
}

$confirmar = $_GET['confirmar'] ?? null;
if ($confirmar !== IMPORT_CONFIRM_TOKEN) {
    responder([
        'ok' => false,
        'ejecutado' => false,
        'mensaje' => 'Importacion bloqueada. No se ha ejecutado nada.',
        'uso' => 'Anade ?confirmar=SI_IMPORTAR para ejecutar manualmente este script.',
    ], 200);
}

$configFile = __DIR__ . '/../api/db_config.local.php';
if (!is_file($configFile)) {
    responder([
        'ok' => false,
        'ejecutado' => false,
        'mensaje' => 'Falta el archivo api/db_config.local.php.',
    ], 500);
}

$config = require $configFile;
if (!is_array($config)) {
    responder([
        'ok' => false,
        'ejecutado' => false,
        'mensaje' => 'La configuracion local no tiene formato valido.',
    ], 500);
}

foreach (['host', 'db', 'user', 'pass'] as $key) {
    if (!array_key_exists($key, $config)) {
        responder([
            'ok' => false,
            'ejecutado' => false,
            'mensaje' => 'Falta la clave de configuracion requerida: ' . $key,
        ], 500);
    }
}

$jsonFile = __DIR__ . '/../data/casos.json';
if (!is_file($jsonFile)) {
    responder([
        'ok' => false,
        'ejecutado' => false,
        'mensaje' => 'No se encontro el archivo data/casos.json.',
    ], 500);
}

$rawJson = file_get_contents($jsonFile);
if ($rawJson === false) {
    responder([
        'ok' => false,
        'ejecutado' => false,
        'mensaje' => 'No se pudo leer data/casos.json.',
    ], 500);
}

// Elimina BOM UTF-8 si existiera para decodificar JSON de forma consistente.
$rawJson = preg_replace('/^\xEF\xBB\xBF/', '', $rawJson);

$casos = json_decode($rawJson, true);
if (!is_array($casos)) {
    responder([
        'ok' => false,
        'ejecutado' => false,
        'mensaje' => 'El JSON no tiene el formato esperado (array de casos).',
    ], 500);
}

$dsn = sprintf(
    'mysql:host=%s;dbname=%s;charset=utf8mb4',
    (string) $config['host'],
    (string) $config['db']
);

$resumen = [
    'casos_leidos' => count($casos),
    'casos_insertados' => 0,
    'personas_detectadas' => 0,
    'relaciones_creadas' => 0,
    'fuentes_insertadas' => 0,
    'errores' => [],
];

try {
    $pdo = new PDO(
        $dsn,
        (string) $config['user'],
        (string) $config['pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    // Fuerza juego de caracteres y collation de sesion para evitar mezcla utf8mb4_unicode_ci vs utf8mb4_bin.
    $pdo->exec('SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci');

    $pdo->beginTransaction();

    if (ENABLE_PRE_CLEAN) {
        $pdo->exec('DELETE FROM corr_fuentes');
        $pdo->exec('DELETE FROM corr_caso_persona');
        $pdo->exec('DELETE FROM corr_personas');
        $pdo->exec('DELETE FROM corr_casos');
    }

    $stmtBuscarCaso = $pdo->prepare(
        'SELECT id FROM corr_casos
                 WHERE nombre COLLATE utf8mb4_unicode_ci = CONVERT(:nombre USING utf8mb4) COLLATE utf8mb4_unicode_ci
                     AND partido_id = :partido_id AND fase_id = :fase_id AND tribunal_id = :tribunal_id
         LIMIT 1'
    );

    $stmtInsertarCaso = $pdo->prepare(
        'INSERT INTO corr_casos
            (nombre, partido_id, fase_id, tribunal_id, gravedad, vinculo, estado, visible_publico, observaciones, ultima_revision)
         VALUES
            (:nombre, :partido_id, :fase_id, :tribunal_id, :gravedad, :vinculo, :estado, :visible_publico, :observaciones, :ultima_revision)'
    );

    $stmtExisteRelacion = $pdo->prepare(
        'SELECT 1 FROM corr_caso_persona WHERE caso_id = :caso_id AND persona_id = :persona_id LIMIT 1'
    );

    $stmtInsertarRelacion = $pdo->prepare(
        'INSERT INTO corr_caso_persona (caso_id, persona_id, rol)
         VALUES (:caso_id, :persona_id, :rol)'
    );

    $stmtExisteFuente = $pdo->prepare(
        'SELECT id FROM corr_fuentes
         WHERE caso_id = :caso_id
           -- Parametros unicos + collation forzada para evitar HY093 y mezcla de cotejamientos.
           AND titulo COLLATE utf8mb4_unicode_ci <=> CONVERT(:titulo_cmp USING utf8mb4) COLLATE utf8mb4_unicode_ci
           AND url COLLATE utf8mb4_unicode_ci <=> CONVERT(:url_cmp USING utf8mb4) COLLATE utf8mb4_unicode_ci
         LIMIT 1'
    );

    $stmtInsertarFuente = $pdo->prepare(
        'INSERT INTO corr_fuentes (caso_id, titulo, url, fecha_consulta, observaciones)
         VALUES (:caso_id, :titulo, :url, :fecha_consulta, :observaciones)'
    );

    foreach ($casos as $caso) {
        if (!is_array($caso)) {
            throw new RuntimeException('Cada elemento del JSON debe ser un objeto de caso.');
        }

        $partidoNombre = normalizarTextoUtf8((string) ($caso['partido'] ?? ''));
        $faseNombre = normalizarTextoUtf8((string) ($caso['fase'] ?? ''));
        $tribunalNombre = normalizarTextoUtf8((string) ($caso['tribunal'] ?? ''));
        $casoNombre = normalizarTextoUtf8((string) ($caso['caso'] ?? ''));

        if ($partidoNombre === '' || $faseNombre === '' || $tribunalNombre === '' || $casoNombre === '') {
            throw new RuntimeException('Hay un caso con campos obligatorios vacios (partido, fase, tribunal o caso).');
        }

        $partidoId = obtenerOInsertarId($pdo, 'corr_partidos', $partidoNombre);
        $faseId = obtenerOInsertarId($pdo, 'corr_fases', $faseNombre);
        $tribunalId = obtenerOInsertarId($pdo, 'corr_tribunales', $tribunalNombre);

        $stmtBuscarCaso->execute([
            ':nombre' => $casoNombre,
            ':partido_id' => $partidoId,
            ':fase_id' => $faseId,
            ':tribunal_id' => $tribunalId,
        ]);
        $casoId = $stmtBuscarCaso->fetchColumn();

        if ($casoId === false) {
            $estado = normalizarTextoUtf8((string) ($caso['estado'] ?? ''));
            $visiblePublico = ($estado === 'Excluido') ? 0 : 1;

            $ultimaRevision = normalizarTextoUtf8((string) ($caso['ultimaRevision'] ?? ''));
            if ($ultimaRevision === '') {
                $ultimaRevision = null;
            }

            $stmtInsertarCaso->execute([
                ':nombre' => $casoNombre,
                ':partido_id' => $partidoId,
                ':fase_id' => $faseId,
                ':tribunal_id' => $tribunalId,
                ':gravedad' => normalizarTextoUtf8((string) ($caso['gravedad'] ?? '')),
                ':vinculo' => normalizarTextoUtf8((string) ($caso['vinculo'] ?? '')),
                ':estado' => $estado,
                ':visible_publico' => $visiblePublico,
                ':observaciones' => normalizarTextoUtf8((string) ($caso['observaciones'] ?? '')),
                ':ultima_revision' => $ultimaRevision,
            ]);

            $casoId = (int) $pdo->lastInsertId();
            $resumen['casos_insertados']++;
        } else {
            $casoId = (int) $casoId;
        }

        $personasRaw = (string) ($caso['personas'] ?? '');
        $personas = preg_split('/\s*,\s*/', $personasRaw) ?: [];

        foreach ($personas as $personaNombreRaw) {
            $personaNombre = normalizarTextoUtf8($personaNombreRaw);
            if ($personaNombre === '') {
                continue;
            }

            $resumen['personas_detectadas']++;

            $personaId = obtenerOInsertarId($pdo, 'corr_personas', $personaNombre);

            $stmtExisteRelacion->execute([
                ':caso_id' => $casoId,
                ':persona_id' => $personaId,
            ]);

            if ($stmtExisteRelacion->fetchColumn() === false) {
                $stmtInsertarRelacion->execute([
                    ':caso_id' => $casoId,
                    ':persona_id' => $personaId,
                    ':rol' => 'pendiente de clasificar',
                ]);
                $resumen['relaciones_creadas']++;
            }
        }

        $fuente = parsearFuente((string) ($caso['fuente'] ?? ''));

        $stmtExisteFuente->execute([
            ':caso_id' => $casoId,
            ':titulo_cmp' => $fuente['titulo'],
            ':url_cmp' => $fuente['url'],
        ]);

        if ($stmtExisteFuente->fetchColumn() === false) {
            $stmtInsertarFuente->execute([
                ':caso_id' => $casoId,
                ':titulo' => $fuente['titulo'],
                ':url' => $fuente['url'],
                ':fecha_consulta' => date('Y-m-d'),
                ':observaciones' => $fuente['observaciones'],
            ]);
            $resumen['fuentes_insertadas']++;
        }
    }

    $observaciones = 'Importacion JSON completada. Casos insertados: ' . $resumen['casos_insertados']
        . ', Personas detectadas: ' . $resumen['personas_detectadas']
        . ', Relaciones creadas: ' . $resumen['relaciones_creadas']
        . ', Fuentes insertadas: ' . $resumen['fuentes_insertadas'] . '.';

    insertarLogImportacion(
        $pdo,
        'projects/corrupcion/data/casos.json',
        $resumen['casos_insertados'],
        $observaciones
    );

    $pdo->commit();

    responder([
        'ok' => true,
        'ejecutado' => true,
        'resumen' => $resumen,
    ], 200);
} catch (Throwable $e) {
    if (isset($pdo) && $pdo instanceof PDO && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $resumen['errores'][] = $e->getMessage();

    if (isset($pdo) && $pdo instanceof PDO) {
        try {
            insertarLogImportacion(
                $pdo,
                'projects/corrupcion/data/casos.json',
                0,
                'ERROR EN IMPORTACION: ' . $e->getMessage()
            );
        } catch (Throwable $logError) {
            $resumen['errores'][] = 'No se pudo registrar corr_import_log: ' . $logError->getMessage();
        }
    }

    responder([
        'ok' => false,
        'ejecutado' => false,
        'resumen' => $resumen,
    ], 500);
}

<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

function responder(array $payload, int $statusCode = 200): void
{
    http_response_code($statusCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    exit;
}

$configFile = __DIR__ . '/db_config.local.php';
if (!is_file($configFile)) {
    responder([
        'origen' => 'mysql',
        'estado' => 'error',
        'error' => 'Falta el archivo de configuracion local: api/db_config.local.php',
    ], 500);
}

$config = require $configFile;
if (!is_array($config)) {
    responder([
        'origen' => 'mysql',
        'estado' => 'error',
        'error' => 'La configuracion local no tiene el formato esperado.',
    ], 500);
}

$requiredKeys = ['host', 'db', 'user', 'pass'];
foreach ($requiredKeys as $key) {
    if (!array_key_exists($key, $config)) {
        responder([
            'origen' => 'mysql',
            'estado' => 'error',
            'error' => 'Falta la clave de configuracion requerida: ' . $key,
        ], 500);
    }
}

$dsn = sprintf(
    'mysql:host=%s;dbname=%s;charset=utf8mb4',
    (string) $config['host'],
    (string) $config['db']
);

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

    $pdo->exec('SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci');

    $sql = 'SELECT
                (SELECT COUNT(*) FROM corr_casos) AS total_casos_tabla,
                (SELECT COUNT(*) FROM corr_v_casos_publicos) AS total_casos_publicos,
                (SELECT MAX(ultima_revision) FROM corr_casos) AS ultima_revision_max,
                NOW() AS fecha_servidor';

    $stmt = $pdo->query($sql);
    $status = $stmt->fetch();

    if (!is_array($status)) {
        responder([
            'origen' => 'mysql',
            'estado' => 'error',
            'error' => 'No se pudo obtener el estado de control.',
        ], 500);
    }

    responder([
        'origen' => 'mysql',
        'total_casos_tabla' => (int) $status['total_casos_tabla'],
        'total_casos_publicos' => (int) $status['total_casos_publicos'],
        'ultima_revision_max' => $status['ultima_revision_max'],
        'fecha_servidor' => $status['fecha_servidor'],
        'estado' => 'ok',
    ]);
} catch (PDOException $e) {
    responder([
        'origen' => 'mysql',
        'estado' => 'error',
        'error' => 'Error de conexion o consulta en MySQL.',
        'detalle' => $e->getMessage(),
    ], 500);
}

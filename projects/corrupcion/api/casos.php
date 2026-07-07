<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

function json_error(string $message, int $statusCode = 500): void
{
    http_response_code($statusCode);
    echo json_encode([
        'ok' => false,
        'error' => $message,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

$configFile = __DIR__ . '/db_config.local.php';

if (!is_file($configFile)) {
    json_error('Falta el archivo de configuración local: api/db_config.local.php', 500);
}

$config = require $configFile;

if (!is_array($config)) {
    json_error('La configuración local no tiene el formato esperado.', 500);
}

$requiredKeys = ['host', 'db', 'user', 'pass'];
foreach ($requiredKeys as $key) {
    if (!array_key_exists($key, $config)) {
        json_error("Falta la clave de configuración requerida: {$key}", 500);
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

    $sql = 'SELECT partido, caso, fase, tribunal, personas, gravedad, vinculo, estado, observaciones, fuente, ultimaRevision
            FROM corr_v_casos_publicos
            ORDER BY caso';

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();

    echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (PDOException $e) {
    json_error('Error de conexión o consulta en MySQL.', 500);
}

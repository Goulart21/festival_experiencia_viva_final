
<?php

$envPath = __DIR__ . '/../.env';

$env = parse_ini_file(
    $envPath,
    false,
    INI_SCANNER_RAW
);

if ($env === false) {
    die('Não foi possível carregar as configurações.');
}

$host = $env['DB_HOST'];
$dbname = $env['DB_NAME'];
$username = $env['DB_USER'];
$password = $env['DB_PASSWORD'];

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {
    error_log($e->getMessage());

    die('Erro ao conectar ao banco de dados.');
}

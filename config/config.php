<?php


$envPath = __DIR__ . '/../.env';
$env = parse_ini_file($envPath, false, INI_SCANNER_RAW);

$host = $env['DB_HOST'];
$dbname = $env['DB_NAME'];
$username = $env['DB_USER'];
$password = $env['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", 
    $username, $password);
} catch (PDOException $e) {

    die($e->getMessage());
}


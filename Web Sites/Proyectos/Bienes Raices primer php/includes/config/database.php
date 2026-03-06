<?php
require __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

function conectarDB() : mysqli {
    $db = mysqli_connect(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_NAME']
    );

    $db->set_charset("utf8");

    if (!$db) {
        exit("Error de conexión a la base de datos");
    }
    return $db;
}
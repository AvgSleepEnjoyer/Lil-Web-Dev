<?php

include 'includes/header.php';


// Función para cargar el archivo .env
function loadEnv($path) {
    if (!file_exists($path)) {
        die("No se encontró el archivo .env");
        }
        
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue; // Ignorar comentarios
            list($name, $value) = explode('=', $line, 2);
            $_ENV[trim($name)] = trim($value);
            }
            }
            
            // 1. Cargar variables de entorno
            loadEnv(__DIR__ . '/.env');
            

// Conectar a la DB con PDO
$dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8";

try {
    $db = new PDO(
        $dsn,
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    );

    // Opciones recomendadas
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "Conexión exitosa";
    echo "<br>";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$query = "SELECT titulo, imagen FROM propiedades";

// Consultar la DB

// $propiedades = $db->query($query)->fetch();
// var_dump($propiedades);

$stmt = $db->prepare($query);

$stmt->execute();

$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

"<pre>";
var_dump($resultado);
"</pre>";

include 'includes/footer.php';
<?php include 'includes/header.php';


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
            
// Conectar a la DB con mysqli en oop

$db = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME']
);

// 3. Verificar conexión
if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}

$db->set_charset("utf8");

// Creamos query
$query = "SELECT titulo, imagen FROM propiedades";

// Lo preparamos
$stmt = $db->prepare($query);

// Lo ejecutamos
$stmt->execute();

// Creamos la variable
$stmt->bind_result($titulo, $imagen);


// Mostramops el resultado
while ($stmt->fetch()):
    var_dump($titulo);
    var_dump($imagen);

endwhile;

// while ($row = $resultado->fetch_assoc()):
//     var_dump($row);
// endwhile;

// var_dump($resultado->fetch_assoc());



$db->close();

include 'includes/footer.php';
<?php  

require "../../includes/app.php";

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;    

estaAutenticado(); // Importante: protege la ruta, solo usuarios autenticados


$propiedad = new Propiedad;

// Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();


// Arreglo con mensajes de errores (inicialmente vacío)
$errores = Propiedad::getErrores(); 

// Código que se ejecuta al enviar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $propiedad = new Propiedad($_POST["propiedad"]);

    // Generar nombre único para la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Primero procesamos la imagen y la asignamos a la propiedad
    if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES["propiedad"]["tmp_name"]["imagen"])->cover(800, 600);
        $propiedad->setImagen($nombreImagen); // importante: asignar nombre ANTES de validar
    }

    // Ahora sí validamos, ya con la imagen asignada
    $errores = $propiedad->validar();

    // Revisar que no haya errores
    if (empty($errores)) {
        // Crear carpeta si no existe
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES, 0755, true);
        }

        // Guardar imagen en el servidor
        $imagen->save(CARPETA_IMAGENES . $nombreImagen);
        
        // Guardar en DB
        $propiedad->guardar();
    }
}

incluirTemplate("header"); // Importante: incluir header antes del HTML
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Regresar</a>

    <!-- Mostrar errores -->
    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <!-- Formulario -->
    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Crear propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate("footer"); // Importante: cerrar con footer ?>
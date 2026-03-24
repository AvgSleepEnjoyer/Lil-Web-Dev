<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;  

require "../../includes/app.php";
estaAutenticado();

$vendedores = Vendedor::all();

// Validar id valido
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id)
    header("Location: /admin");


$propiedad = Propiedad::find($id);

// Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta) ;


// Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

// Codigo de que el usuariou despues de mandar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $args = $_POST["propiedad"];

    $propiedad->sincronizar($args);

    
    $errores = $propiedad->validar();
    
    // Validacion subida de archivos
    // Generar nombre único para la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    // Procesar imagen solo si se subió
    if (!empty($_FILES["propiedad"]["tmp_name"]["imagen"])) {
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES["propiedad"]["tmp_name"]["imagen"])->cover(800, 600);

        // Asignar nombre a la propiedad
        $propiedad->setImagen($nombreImagen);
    }



    // Revisar que el arreglo de errores este vacio
    if (empty($errores)) {
        // Guardar imagen solo si existe una nueva
        if (isset($imagen)) {
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);
        }

        // Guardar cambios en BD
        $propiedad->guardar();
    }


}



incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Actualizar propiedad</h1>
    <a href="/admin" class="boton boton-verde">Regresar</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>

</main>

<?php incluirTemplate("footer");?>

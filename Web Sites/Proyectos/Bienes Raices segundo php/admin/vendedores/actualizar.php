<?php  
require "../../includes/app.php";
use App\Vendedor;
estaAutenticado(); // Importante: protege la ruta, solo usuarios autenticados

// Validar que sea un ID valido

$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id){
    header("Location: /admin");
}

// Obtener el arreglo del vendedor de la db
$vendedor= Vendedor::find($id);


// Arreglo con mensajes de errores (inicialmente vacío)
$errores = Vendedor::getErrores(); 


// Código que se ejecuta al enviar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Asigar los valores
    $args = $_POST["vendedor"];



    // Sincronicar objeto en memoria con lo que el usuario escribio
    $vendedor->sincronizar($args);
    
    // Validacion
    $errores = $vendedor->validar();



    if(empty($errores)){
        $vendedor->guardar();
    }

}

incluirTemplate("header"); // Importante: incluir header antes del HTML
?>


<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Regresar</a>

    <!-- Mostrar errores -->
    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <!-- Formulario -->
    <form class="formulario" method="POST"  enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input type="submit" value="Guardar cambios" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate("footer"); // Importante: cerrar con footer ?>
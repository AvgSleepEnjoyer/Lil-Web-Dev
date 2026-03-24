<?php  

require "../../includes/app.php";

use App\Vendedor;

estaAutenticado(); // Importante: protege la ruta, solo usuarios autenticados

$vendedor= new Vendedor;

// Arreglo con mensajes de errores (inicialmente vacío)
$errores = Vendedor::getErrores(); 

// Código que se ejecuta al enviar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    $vendedor = new Vendedor($_POST["vendedor"]);

    $errores = $vendedor->validar();
    

    if(empty($errores)){
        $vendedor->guardar();
    }    

}

incluirTemplate("header"); // Importante: incluir header antes del HTML
?>


<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Regresar</a>

    <!-- Mostrar errores -->
    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <!-- Formulario -->
    <form class="formulario" method="POST" action="/admin/vendedores/crear.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate("footer"); // Importante: cerrar con footer ?>
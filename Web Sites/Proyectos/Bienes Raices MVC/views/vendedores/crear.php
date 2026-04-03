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
    <form class="formulario" method="POST" action="/vendedores/crear" enctype="multipart/form-data">
        <?php include "formulario.php"; ?>
        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>
</main>
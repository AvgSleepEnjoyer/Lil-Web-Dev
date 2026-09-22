<div class="contenedor olvide">

<?php @include_once __DIR__ . "/../templates/nombre-sitio.php"; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu password de UpTask</p>

        <form method="POST" action="/olvide" class="formulario">

            
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu E-mail" name="email">
            </div>
            
             
            <input type="submit" class="boton" value="Enviar Instrucciones">

        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/crear">¿Aún no tienes una cuenta? Obtener una</a>
        </div>

    </div>

</div>
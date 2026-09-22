<div class="contenedor reestablecer">
    
<?php @include_once __DIR__ . "/../templates/nombre-sitio.php"; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>

        <form method="POST" action="/reestablecer" class="formulario">

            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu E-mail" name="email">
            </div>
            
            <div class="campo">
                <label for="password">password</label>
                <input type="password" id="password" placeholder="Tu Password" name="password">
            </div>

            <input type="submit" class="boton" value="Guardar Password">

        </form>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? Obtener una</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>

    </div>

</div>
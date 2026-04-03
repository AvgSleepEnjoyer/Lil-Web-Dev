<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" action="/login">
            <fieldset>
                <legend>E-mail y Password</legend>

                <label for="email">E-Mail</label>               
                <input type="email" id="email" placeholder="Tu E-mail" name="email" >

                <label for="password">password</label>                
                <input type="password" id="password" placeholder="Tu Password" name="password" >

            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>
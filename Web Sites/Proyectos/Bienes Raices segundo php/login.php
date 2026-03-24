<?php  

    require "includes/app.php";
    $db = conectarDB();

    // Autenticar el usuario

    $errores = [];

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)); 

        // var_dump($email);

        $password = mysqli_real_escape_string($db, $_POST["password"]);

        if(!$email){
            $errores[] = "El E-mail es obligatorio o no es válido.";
        }
        if(!$password){
            $errores[] = "El Password es obligatorio";
        }

        if(empty($errores)){
            // Revisar si un usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email';";
            $resultado = mysqli_query($db, $query);

            // var_dump($resultado);

            if($resultado->num_rows){
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $usuario["password"]);

                if($auth){
                    // Usuario autenticado
                    session_start();

                    // Llenar el arreglo de la sesion

                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION["login"] = true;

                    header("Location: /admin");

                    // echo "<pre>";
                    // var_dump($_SESSION);
                    // echo "<pre>";

                }else{
                    // Usuario no verificado
                    $errores[] = "El password es incorrecto";
                }

            }else{
                $errores[] = "El usuario no existe";
            }
        }
    }


    incluirTemplate("header");
    ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" action="">
            <fieldset>
                <legend>E-mail y Password</legend>

                <label for="email">E-Mail</label>               
                <input type="email" id="email" placeholder="Tu E-mail" name="email" required>

                <label for="password">password</label>                
                <input type="password" id="password" placeholder="Tu Password" name="password" required>

            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>
    
    <?php incluirTemplate("footer");?>

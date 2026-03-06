<?php  

    require "../../includes/funciones.php";
    $auth = estaAutenticado();

    if(!$auth){
        header("Location: /");
    }

    // Base de datos

    require "../../includes/config/database.php";
    $db = conectarDB();

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta) ;


    // Arreglo con mensajes de errores
    $errores= [];
    
    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $baños = "";
    $estacionamiento = "";
    $vendedores_ID = "";
    

// Codigo de que el usuariou despues de mandar el formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //  echo "<pre>";
        //  var_dump($_POST);
        //  echo "</pre>";

        //  echo "<pre>";
        //  var_dump($_FILES);
        //  echo "</pre>";

        $titulo = mysqli_real_escape_string( $db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string( $db, $_POST["precio"]);
        $descripcion = mysqli_real_escape_string( $db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string( $db, $_POST["habitaciones"]);
        $baños = mysqli_real_escape_string( $db, $_POST["baños"]);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST["estacionamiento"]);
        $vendedores_ID = $_POST["vendedor"] ?? "";
        $vendedores_ID = mysqli_real_escape_string($db, $vendedores_ID);
        $creado = date("Y/m/d");

        // Asignar files hacia una variable
        $imagen = $_FILES["imagen"];

        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        } 
        if(!$precio){
            $errores[] = "Debes añadir un precio";
        } 
        if(strlen($descripcion)<50){
            $errores[] = "Debes añadir un minimo de 50 caracteres";
        } 
        if(!$baños){
            $errores[] = "Debes añadir un numero de baños";
        } 
        if(!$habitaciones){
            $errores[] = "Debes añadir un numero de habitaciones";
        } 
        if(!$estacionamiento){
            $errores[] = "Debes añadir un numero de estacionamiento";
        } 
        if(!$vendedores_ID){
            $errores[] = "Debes añadir un vendedor";
        } 
        if (!$imagen["name"] || $imagen["error"]){
            $errores[] = "La imagen es obligatoria";
        }

        // Validar por tamaño (maximo 2mb)
        $medida = 2000 * 1000;
        if ($imagen["size"] > $medida ){
            $error[] = "La imagen es muy pesada";
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el arreglo de errores este vacio
        if (empty($errores)) {

        // SUBIDA DE ARCHIVOS 

        // Crear carpeta

        $carpetaImagenes = "../../imagenes/";

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
            echo "directorio creado";
        }
        // Generar nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Subir la imagen

        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);


            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, baños, estacionamiento, creado, vendedores_ID) 
                    VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$baños', '$estacionamiento', '$creado', '$vendedores_ID');";
            // Insertar en la base de datos
            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                // Redireccionar al usuario, tiene que hacerse antes de html y no redireccionar varias veces
                header("Location: /admin?resultado=1");
            }
        }
    }


    incluirTemplate("header");
    ?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-verde">Regresar</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label> <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" 
                value = "<?php echo $titulo; ?>" >

                <label for="precio">Precio:</label> <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" 
                value = "<?php echo $precio; ?>" >
                
                <label for="imagen">Imagen:</label> <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripcion</label>    <textarea id="descripcion" name="descripcion" ><?php echo $descripcion; ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Información propiedad</legend>

                <label for="habitaciones">Habitaciones:</label> <input type="number" id="habitaciones" name="habitaciones" placeholder="3" 
                value = "<?php echo $habitaciones; ?>" min="1" max="10">
                
                <label for="baños">Baños:</label> <input type="number" id="baños" name="baños" placeholder="3" 
                value = "<?php echo $baños; ?>" min="1" max="10">
                
                <label for="estacionamiento">Estacionamiento:</label> <input type="number" 
                id="estacionamiento" name="estacionamiento" placeholder="3" value = "<?php echo $estacionamiento; ?>" min="1" max="10">

            </fieldset>

                <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="" disabled selected >--Seleccione--</option>
                    <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
                        <option <?php echo $vendedores_ID === $row["id"] ? "selected" : ""; ?> value="<?php echo $row["id"]; ?>"> <?php echo $row["nombre"] . " " . $row["apellidos"]; ?> </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear propiedad" class="boton boton-verde">
        </form>

    </main>
    
    <?php incluirTemplate("footer");?>

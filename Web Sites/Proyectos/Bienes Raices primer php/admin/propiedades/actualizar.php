<?php  

    require "../../includes/funciones.php";
    $auth = estaAutenticado();

    if(!$auth){
        header("Location: /");
    }

    
    // Validar id valido
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if(!$id)
        header("Location: /admin");


    // Base de datos
    
    require "../../includes/config/database.php";
    $db = conectarDB();
    
    // OBtener los datos de la propiedad 
    $consulta = "SELECT * FROM propiedades WHERE id = {$id};";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    // echo "<pre>";
    // var_dump($propiedad);
    // echo "</pre>";


    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores;";
    $resultado = mysqli_query($db, $consulta) ;


    // Arreglo con mensajes de errores
    $errores= [];
    
    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $baños = $propiedad["baños"];
    $estacionamiento = $propiedad["estacionamiento"];
    $vendedores_ID = $propiedad["vendedores_id"];
    $imagenPropiedad = $propiedad["imagen"];
    

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

            // Crear carpeta
            $carpetaImagenes = "../../imagenes/";

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
                echo "directorio creado";
        }

        // -- SUBIDA DE ARCHIVOS --

        $nombreImagen = "";

        // Reviar si hay una nueva imagen para borrar la anterior
        if($imagen["name"]){
            unlink($carpetaImagenes . $propiedad["imagen"]);
            
            // Generar nombre unico para nueva imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        }else{
            $nombreImagen = $propiedad["imagen"];
        }



        // Subir la imagen
        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);


        $query = "UPDATE propiedades SET titulo= '{$titulo}', precio= '{$precio}', imagen = '{$nombreImagen}' , descripcion= '{$descripcion}', habitaciones= {$habitaciones}, baños= {$baños}, estacionamiento= {$estacionamiento}, vendedores_id= {$vendedores_ID} WHERE id = {$id};";

        // echo $query;
        // exit;

        // Insertar en la base de datos
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            // Redireccionar al usuario, tiene que hacerse antes de html y no redireccionar varias veces
            header("Location: /admin?resultado=2");
        }
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
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label> <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" 
                value = "<?php echo $titulo; ?>" >

                <label for="precio">Precio:</label> <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" 
                value = "<?php echo $precio; ?>" >
                
                <label for="imagen">Imagen:</label> <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                <img class="imagen-small" src="/imagenes/<?php echo $imagenPropiedad; ?> " alt="Imagen propiedad">

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

            <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
        </form>

    </main>
    
    <?php incluirTemplate("footer");?>

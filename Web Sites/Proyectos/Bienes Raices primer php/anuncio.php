<?php  

    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id)
        header("Location: /");

    // Importar la base de datos
    require __DIR__ . "/includes/config/database.php";
    $db = conectarDB();

    // Consulta de DB
    $query = "SELECT * FROM propiedades WHERE id = {$id}";

    // Obtener resultados
    $resultado = mysqli_query($db, $query);
    $propiedad = mysqli_fetch_assoc($resultado);



    require "includes/funciones.php";

    incluirTemplate("header");
    ?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad["titulo"]; ?></h1>
        
        <img src="/imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen de propiedad" loading="lazy">


        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad["precio"]; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                        <p><?php echo $propiedad["baños"]; ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                        <p><?php echo $propiedad["estacionamiento"]; ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                        <p><?php echo $propiedad["habitaciones"]; ?></p>
                    </li>
                </ul>

                <p><?php echo $propiedad["descripcion"]; ?></p>
        </div>
    </main>

    <?php 
        mysqli_close($db);
        incluirTemplate("footer");
    ?>


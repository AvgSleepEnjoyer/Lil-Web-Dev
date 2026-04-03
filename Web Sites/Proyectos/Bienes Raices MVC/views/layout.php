<?php 
    if(! isset($_SESSION))
        session_start();

    $auth = $_SESSION["login"] ?? false;

    if(!isset($inicio)){
        $inicio = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body>
    
    <header class="header <?php echo $inicio ? "inicio" : "" ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logo empresa">
                </a>

                <div class="movil-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>
                    <div class="derecha">
                        <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                        <nav class="navegacion">
                            <a href="/nosotros">Nosotros</a>
                            <a href="/propiedades">Propiedades</a>
                            <a href="/blog">Blog</a>
                            <a href="/contacto">Contacto</a>
                            <?php if($auth): ?>
                                <a href="/logout">Cerrar sesion</a>

                            <?php endif; ?>
                        </nav>
                    </div>
            </div>  <!---cierre de la barra---->

            <?php if($inicio){
                echo "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>";
            } ?>
        </div>
    </header>

    <?php echo $contenido; ?>


    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>


        <p class="copyright">Todos los Derechos Reservados <?php echo date("Y"); ?> &copy; </p>
            
        <script src="../build/js/bundle.min.js"></script>
    </footer>   
</body>
</html>
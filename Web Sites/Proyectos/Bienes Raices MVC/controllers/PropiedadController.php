<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;    


class PropiedadController{
    
    public static function index(Router $router){

        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();
        // Muestra mensaje condicional
        $resultado = $_GET["resultado"] ?? null;
        
        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "resultado" => $resultado,
            "vendedores" => $vendedores
        ]);
    }
    public static function crear(Router $router){
        
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores(); 

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
            $propiedad = new Propiedad($_POST["propiedad"]);

            // Generar nombre único para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Primero procesamos la imagen y la asignamos a la propiedad
            if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES["propiedad"]["tmp_name"]["imagen"])->cover(800, 600);
                $propiedad->setImagen($nombreImagen); // importante: asignar nombre ANTES de validar
            }

            // Ahora sí validamos, ya con la imagen asignada
            $errores = $propiedad->validar();

            // Revisar que no haya errores
            if (empty($errores)) {
                // Crear carpeta si no existe
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES, 0755, true);
                }

                // Guardar imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                
                // Guardar en DB
                $propiedad->guardar();
            }
        }

        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }
    

    public static function actualizar(Router $router){
        $id = validarORedireccionar("/admin");

        $errores = Propiedad::getErrores();
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        // Codigo de que el usuariou despues de mandar el formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $args = $_POST["propiedad"];

        $propiedad->sincronizar($args);
        
        $errores = $propiedad->validar();
        
        // Validacion subida de archivos
        // Generar nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Procesar imagen solo si se subió
        if (!empty($_FILES["propiedad"]["tmp_name"]["imagen"])) {
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES["propiedad"]["tmp_name"]["imagen"])->cover(800, 600);

            // Asignar nombre a la propiedad
            $propiedad->setImagen($nombreImagen);
        }

        // Revisar que el arreglo de errores este vacio
        if (empty($errores)) {
            // Guardar imagen solo si existe una nueva
            if (isset($imagen)) {
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }
        // Guardar cambios en BD
        $propiedad->guardar();
    }

    }

        $router->render("propiedades/actualizar", [
            "propiedad" => $propiedad,
            "errores" => $errores,
            "vendedores" => $vendedores,
        ]);
    }


    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === ("POST")){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){

                $tipo = $_POST["tipo"];
                if(validarTipocontenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                    }
                }
            }
        }

}    

<?php

namespace Controllers;
use Model\Propiedad;
use Model\Vendedor;
use MVC\Router;

class VendedorController{

    public static function crear(Router $router){

        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
        $vendedor = new Vendedor($_POST["vendedor"]);

        $errores = $vendedor->validar();
        

        if(empty($errores)){
            $vendedor->guardar();
        }    
    }

        $router->render("vendedores/crear", [
            "errores" => $errores,
            "vendedor" => $vendedor
            
        ]);
    }


    public static function actualizar(Router $router){

        $errores = Vendedor::getErrores();
        $id = validarORedireccionar("/admin");
        $vendedor = Vendedor::find($id);
        

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Asigar los valores
            $args = $_POST["vendedor"];

            // Sincronicar objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);   
            
            // Validacion
            $errores = $vendedor->validar();
            

            if(empty($errores)){
                
                $vendedor->guardar();
            }
        }
    
        $router->render("vendedores/actualizar", [
            "errores" => $errores,
            "vendedor" => $vendedor
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);

                    // Traer todas las propiedades
                    $propiedades = Propiedad::all();

                    // Filtrar las que pertenecen al vendedor
                    $tienePropiedades = false;
                    foreach($propiedades as $propiedad) {
                        if($propiedad->vendedores_ID == $id) {
                            $tienePropiedades = true;
                            break;
                        }
                    }

                    if($tienePropiedades) {
                        header("Location: /admin?resultado=4");
                    } else {
                        $vendedor->eliminar();
                    }
                }
            }
        }
    }

    
}
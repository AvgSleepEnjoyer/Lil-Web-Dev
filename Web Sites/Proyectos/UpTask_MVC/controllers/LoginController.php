<?php

namespace Controllers;

use MVC\Router;

class LoginController{

    public static function login(Router $router) {
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            }


        $router->render("auth/login", [
            "titulo" => "Iniciar Sesión"
        ]);
    }

    public static function logout() {
        
    }

    public static function crear(Router $router) {
       

        
        if($_SERVER["REQUEST_METHOD"] === "POST"){

        }


        $router->render("auth/crear", [
            "titulo" => "Crear Cuenta"
        ]);
    }
    
    public static function olvide() {
        echo "olvide";


        if($_SERVER["REQUEST_METHOD"] === "POST"){

        }
    }
    
    public static function reestablecer() {
        echo "reestablecer";
        
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            }
    }
            
            
    public static function mensaje() {
        echo "mensaje";
    }


    public static function confirmar() {
        echo "confirmar";
    }


}
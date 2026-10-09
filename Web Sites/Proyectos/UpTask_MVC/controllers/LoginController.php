<?php

namespace Controllers;

use Model\Usuario;
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
        $alertas = [];
        $usuario = new Usuario();
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);

            // Se pasa password2 a la lista de validaciones, revisa si son iguales
            $alertas = $usuario->validarNuevaCuenta($_POST["password2"] ?? "");

            if (empty($alertas)) {
                $existeUsuario = Usuario::where("email", $usuario->email);

                if ($existeUsuario) {
                    Usuario::setAlerta("error", "El Usuario ya está registrado");
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear password
                    $usuario->hashPassword();
                    
                    // Crear token
                    $usuario->crearToken();

                    // Crear nuevo usuario
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header("Location: /mensaje");
                    }
                }
            }
        }


        $router->render("auth/crear", [
            "titulo" => "Crea tu cuenta en UpTask",
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }
    
    public static function olvide(Router $router) {
        


        if($_SERVER["REQUEST_METHOD"] === "POST"){

        }

        $router->render("auth/olvide", [
            "titulo" => "Olvidé mi password"
        ]);
    }
    
    public static function reestablecer(Router $router) {
               
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            }

        $router->render("auth/reestablecer", [
            "titulo" => "Reestablecer Password"
        ]);
    }
            
            
    public static function mensaje(Router $router) {

        $router->render("auth/mensaje", [
            "titulo" => "Cuenta Creada Exitosamente"
        ]);
    }


    public static function confirmar(Router $router) {
        $router->render("auth/confirmar", [
            "titulo" => "Confirmar Cuenta"
        ]);
    }


}
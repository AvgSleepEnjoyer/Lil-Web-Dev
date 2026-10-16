<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router) {

        $alertas = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario = new Usuario($_POST);
            
            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                // Verificar si el usuario existe en el sistema
                $usuario = Usuario::where("email", $usuario->email);
                if (!$usuario || !$usuario->confirmado) {
                    Usuario::setAlerta("error", "El usuario no existe o no está confirmado");
                } else {
                    // Si El Usuario Existe, Se Revisa Si Tiene La Contrraseña Correcta
                    if (password_verify($_POST["password"], $usuario->password)) {
                        // Iniciar la Sesion del Usuario
                        session_start();
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["nombre"] = $usuario->nombre;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["login"] = true;
                        
                        // Redireccionar a la pagina de proyectos
                        header("Location: /dashboard");
                    } else {
                        Usuario::setAlerta("error", "Password Incorrecto");
                    }

                }
            } 

        }
        
        $alertas = Usuario::getAlertas();

        $router->render("auth/login", [
            "titulo" => "Iniciar Sesión",
            "alertas" => $alertas
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

                    // Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

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
        
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where("email", $usuario->email);
                if ($usuario && $usuario->confirmado) {
                    // Generar nuevo token
                    $usuario->crearToken();
                    
                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();


                    // Imprimir la alerta
                    Usuario::setAlerta("exito", "Hemos enviado las instrucciones a tu email.");
                } else {
                    Usuario::setAlerta("error", "El Usuario no existe o no está confirmado");
                    }
                }
                
            }
        $alertas = Usuario::getAlertas();

        $router->render("auth/olvide", [
            "titulo" => "Olvidé mi password",
            "alertas" => $alertas
        ]);
    }
    
    public static function reestablecer(Router $router) {
               
        $token = s($_GET["token"]);
        $mostrar= true;
        $alertas = [];

        if (!$token) header("Location: /");

        // Identificar el usuario con ese token

        $usuario = Usuario::where("token", $token);
        if (empty($usuario)) {
            Usuario::setAlerta("error", "Token no válido");
            // $mostrar permite ver el label para password, si es falso, no permite
            $mostrar = false;
        } else {

        }
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar password
            $alertas = $usuario->validarPassword();

            if (empty($alertas)) {
                // Hashear password y eliminar token
                $usuario->hashPassword();
                $usuario->token = "";

                $resultado = $usuario->guardar();
                if ($resultado) {
                    header("Location: /");
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/reestablecer", [
            "titulo" => "Reestablecer Password",
            "alertas" => $alertas,
            "mostrar" => $mostrar
        ]);
    }
            
            
    public static function mensaje(Router $router) {

        $router->render("auth/mensaje", [
            "titulo" => "Cuenta Creada Exitosamente"
        ]);
    }


    public static function confirmar(Router $router) {

        $token = s($_GET["token"]);
        if(!$token) header("Location: /");
        
        // Encontrar al usuario con ese token
        $usuario = Usuario::where("token", $token);

        if (empty($usuario)) {
            // No se encontró usuario con ese token
            Usuario::setAlerta("error", "Token no válido");
        } else {
            // Confirmar la cuenta
            $usuario->token = "";
            $usuario->confirmado = 1;
            // Guardar en DB
            $usuario->guardar();
            
            Usuario::setAlerta("exito", "Cuenta Confirmada Correctamente");
        }

        $alertas = Usuario::getAlertas();


        $router->render("auth/confirmar", [
            "titulo" => "Confirmar Cuenta",
            "alertas" => $alertas
        ]);
    }


}
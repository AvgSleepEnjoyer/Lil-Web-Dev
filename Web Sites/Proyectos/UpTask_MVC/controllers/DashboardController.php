<?php

namespace Controllers;

use MVC\Router;
use Model\Proyecto;
 

class DashboardController{
    public static function index(Router $router): void {

        session_start();
        isAuth();
        
        $router->render("dashboard/index", [
            "titulo" => "Proyectos"
        ]);
    }

    public static function crear_proyecto(Router $router): void {

        session_start();
        isAuth();
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $proyecto = new Proyecto($_POST);

            // Validacion de errores
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                // Generar una URL unica
                $proyecto->url = md5(uniqid());
                // Almacenar creador del proyecto
                $proyecto->propietarioId = $_SESSION["id"];
                // Guardar el proyecto
                $proyecto->guardar();
                // Redireccionar
                header("Location: /proyecto?id=" . $proyecto->url);
            }
        }
        
        $router->render("dashboard/crear-proyecto", [
            "titulo" => "Crear Proyecto",
            "alertas" => $alertas
        ]);
    }

    public static function proyecto(Router $router) : void {

        session_start();
        isAuth();

        $token = $_GET["id"];
        if (!$token) 
            header("Location: /dashboard");
        // Revisar si la persona que visita el proyecto es quien lo creo
        $proyecto = Proyecto::where("url", $token);
        if ($proyecto->propietarioId !== $_SESSION["id"]) 
            header("Location: /dashboard");

        $alertas = [];

        $router->render("dashboard/proyecto", [
            "titulo" => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router) : void {

        session_start();
        isAuth();
        
        $router->render("dashboard/perfil", [
            "titulo" => "Perfil"
        ]);
    }
    
}
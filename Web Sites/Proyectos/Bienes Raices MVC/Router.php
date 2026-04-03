<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }
    
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }
    
    public function comprobarRutas(){

        session_start();
        $auth = $_SESSION["login"] ?? null;


        // Arreglo de rutas protegidas
        $rutas_protegidas = ["/admin", "/propiedades/crear", "/propiedades/actualizar", "/propiedades/eliminar", "/vendedores/crear", "/vendedores/actualizar", "/vendedores/eliminar"];

        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET"){
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        } else{
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }

        // Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth ){
            header("Location: /");
        }


        if($fn){
            call_user_func($fn, $this);
        } else{
            echo "Pagina no encontrada";
        }

        }

    // Muestra una vista
    public function render($view, $datos = []){

        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";

    }


}
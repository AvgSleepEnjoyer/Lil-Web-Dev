<?php

namespace Model;

class ActiveRecord{
    // Conexión a la DB (se asigna desde app.php con setDB)
    protected static $db;

    // Columnas de la tabla propiedades
    protected static $columnasDB = [];
    protected static $tabla = "";

    // Arreglo estático para acumular errores de validación
    protected static $errores = [];


    // Definir la conexión a la base de datos
    public static function setDB($databse){
        self::$db = $databse;
    }

    public function guardar(){      // Las siguientes dos funciones crear() y actualizar() sirven cuando hay o no id, para actualizar o crear un registro
        if(!(is_null($this->id))){
            // Actualizar
            $this->actualizar();
        } else{
            // Creando un nuevo registro
            $this->crear();
        }
    }

    // Guardar en la DB
    public function crear(){
        // Sanitizar los datos antes de insertarlos
        $atributos = $this->sanitizarDatos();

        $columnas = join(', ', array_keys($atributos));
        $filas = join("', '", array_values($atributos));
        
        // Consulta para insertar datos
        $query = "INSERT INTO " . static::$tabla . " ($columnas) VALUES ('$filas')";

        $resultado = self::$db->query($query);
        if ($resultado) {
            // Redireccionar al usuario
            header("Location: /admin?resultado=1");
        }
    }

    public function actualizar(){
        // Sanitizar los datos antes de insertarlos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", " ,$valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar al usuario, tiene que hacerse antes de html y no redireccionar varias veces
            header("Location: /admin?resultado=2");
            exit;
        }
    }

    // Eliminar un registro
    public function eliminar(){
            $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
            
            $resultado = self::$db->query($query);
            if($resultado){
                $this->borrarImagen();
                header("Location: /admin?resultado=3");
            }
    }

    // Identificar y unir atributos de la DB
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === "id") continue; // id se autogenera, no se inserta
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar datos contra inyección SQL
    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Validación de datos obligatorios
    public static function getErrores(){   
        return static::$errores;
    }

    public function validar(){
        static::$errores = []; // importante: reiniciar errores cada vez
        return static::$errores; // importante: devolver errores para usarlos en crear.php
    }

    // Asignar nombre de imagen a la propiedad
    public function setImagen($imagen){

        // Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Elimina el archivo de la imagen
    public function borrarImagen(){
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca una propiedad por id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id};";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    // Toma los arreglos de la funcion consultarSQL porque ActiveRecord usa objetos
    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        foreach ($args as $key => $value) {
            if(property_exists($this, $key) && !(is_null($value))){
                $this->$key = $value;
            }
        }

    }
}
<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = "vendedores";
    protected static $columnasDB = ["id", "nombre", "apellidos", "telefono"];

    // Atributos de la clase (coinciden con columnas de la DB)
    public $id;
    public $nombre;
    public $apellidos;
    public $telefono;

    // Constructor: inicializa propiedades con datos del formulario
    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellidos = $args["apellidos"] ?? "";
        $this->telefono = $args["telefono"] ?? "";

    }

    public function validar(){
        self::$errores = []; // importante: reiniciar errores cada vez

        if(!$this->nombre){
            self::$errores[] = "Debes añadir un nombre";
        } 
        if(!$this->apellidos){
            self::$errores[] = "Debes añadir los apellidos";
        } 
        if(!$this->telefono){
            self::$errores[] = "Debes añadir un telefono";
        } 
        if(!preg_match("/[0-9]{10}/", $this->telefono)){
            self::$errores[] = "Formato no valido";
        }

        return self::$errores;
    }
}
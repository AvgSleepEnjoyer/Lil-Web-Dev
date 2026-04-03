<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = "propiedades";
    protected static $columnasDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedores_ID"];

    // Atributos de la clase (coinciden con columnas de la DB)
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_ID;

    // Constructor: inicializa propiedades con datos del formulario
    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d"); // importante: siempre guarda fecha actual
        $this->vendedores_ID = $args["vendedores_ID"] ?? "";
    }

    public function validar(){
        self::$errores = []; // importante: reiniciar errores cada vez

        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        } 
        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        } 
        if(strlen($this->descripcion) < 50){
            self::$errores[] = "Debes añadir un minimo de 50 caracteres";
        } 
        if(!$this->wc){
            self::$errores[] = "Debes añadir un numero de wc";
        } 
        if(!$this->habitaciones){
            self::$errores[] = "Debes añadir un numero de habitaciones";
        } 
        if(!$this->estacionamiento){
            self::$errores[] = "Debes añadir un numero de estacionamiento";
        } 
        if(!$this->vendedores_ID){
            self::$errores[] = "Debes añadir un vendedor";
        } 
        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores; // importante: devolver errores para usarlos en crear.php
    }
}
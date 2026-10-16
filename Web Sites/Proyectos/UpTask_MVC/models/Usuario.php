<?php

namespace Model;

class Usuario extends ActiveRecord{

    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "nombre", "email", "password", "token", "confirmado"];

    public ?int $id;
    public string $nombre;
    public string $email;
    public string $password;
    public string $token;
    public int $confirmado;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->token = $args["token"] ?? "";
        $this->confirmado = $args["confirmado"] ?? 0;
    }

    // Validar el login de usuarios
    public function validarLogin() : array {
        
        if(!$this->email){
            self::$alertas["error"][] = "El E-mail del Usuario es Obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas["error"][] = "Email no válido";
        }
        if(!$this->password){
            self::$alertas["error"][] = "El Password no puede ir vacio";
        }
        return self::$alertas;
    }

    // Validacion para cuentas nuevas
    public function validarNuevaCuenta(string $password2): array {
        if(!$this->nombre){
            self::$alertas["error"][] = "El Nombre del Usuario es Obligatorio";
        }
        if(!$this->email){
            self::$alertas["error"][] = "El E-mail del Usuario es Obligatorio";
        }
        if(!$this->password){
            self::$alertas["error"][] = "El Password no puede ir vacio";
        }
        if(strlen($this->password) < 6){
            self::$alertas["error"][] = "El Password debe ser mayor a 6 caracteres";
        }
        // Aqui el parametro password2 en uso
        if ($this->password !== $password2) {
            self::$alertas["error"][] = "Las contraseñas no coinciden";
        }
        return self::$alertas;
    }

    public function hashPassword(): void {
        // Hashea password
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar token
    public function crearToken() : void {
        $this->token = md5(uniqid());
    }

    // Valida el password
    public function validarPassword() : array {
        if(!$this->password){
            self::$alertas["error"][] = "El Password no puede ir vacio";
        }
        if(strlen($this->password) < 6){
            self::$alertas["error"][] = "El Password debe ser mayor a 6 caracteres";
        }
        return self::$alertas;
    }

    // Valida un Email
    public function validarEmail(): array {
        
        if (!$this->email) {
            self::$alertas["error"][] = "El Email es Obligatorio";
        }
            
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas["error"][] = "Email no válido";
        }

        return self::$alertas;
    }

}
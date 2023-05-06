<?php

namespace Model;

class Usuario extends ActiveRecord {

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '';
        $this->token = $args['token'] ?? '';
    }

    // Validación nueva cuenta
    public function validarNuevaCuenta() {
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del usuario es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        return self::$alertas;
    }

}
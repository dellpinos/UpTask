<?php

namespace Model;

class Usuario extends ActiveRecord
{

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    // Validación nueva cuenta
    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del usuario es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Los password no coinciden';
        }
        // Esta valicadión obliga a una contraseña mas segura
        // $patron = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'; // Debe contener un numero, una min, una may y una extensión de 8 caracteres
        // $resultado = preg_match($patron, $this->password);
        // if ($resultado) {
        //     self::$alertas['error'][] = 'El password debe contener mayusculas, minusculas, letras y numeros';
        // }
        return self::$alertas;
    }

    // Hashea el password
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

    }

    // Generar un token
    public function crearToken() {
        $this->token = uniqid();
    }
    // Valida un email
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'Debes completar el campo';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no válido';
        }
        return self::$alertas;
    }
}

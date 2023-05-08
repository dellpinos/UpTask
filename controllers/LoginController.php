<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Classes\Email; // <<<<<<<<<<<< TODO: enviar mails de confirmación, ya esta la clase y el namespace

class LoginController
{
    public static function login(Router $router)
    {
        echo 'Desde Login!!!';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        // Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión'
        ]);
    }
    public static function logout()
    {
        echo 'Desde Logout';
    }



    public static function crear(Router $router)
    {

        $alertas = [];
        $usuario = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {

                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El email ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2
                    // unset($usuario->password2);
                    $usuario->password2 = null;

                    // Generar el token
                    $usuario->crearToken();
                    $usuario->confirmado = 0;
                     
                    // Crear un nuevo usuario

                    $resultado = $usuario->guardar();

                    // Enviar Email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $email->enviarConfirmacion();
                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            };
        }


        // Render a la vista
        $router->render('auth/crear', [
            'titulo' => 'Crear cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();
        }
        // Render a la vista
        $router->render('auth/olvide', [
            'titulo' => 'Recuperar cuenta',
            'alertas' => $alertas
        ]);
    }
    public static function restablecer(Router $router)
    {
        echo 'Desde Reeeeestablecer!!!';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
        // Render a la vista
        $router->render('auth/restablecer', [
            'titulo' => 'Restablece tu password'
        ]);
    }
    public static function mensaje(Router $router)
    {
        echo 'Desde Mensaje';

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta creada'
        ]);
    }
    public static function confirmar(Router $router)
    {
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // No se encontro usuario con este token
            Usuario::setAlerta('error', 'Token no valido o Email inexistente');
        } else {
            // Confirmar usuario
            $usuario->confirmado = 1;
            $usuario->password2 = null;
            $usuario->token = '';
            $usuario->guardar();
            
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta',
            'alertas' => $alertas
        ]);
    }
}

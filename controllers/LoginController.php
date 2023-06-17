<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                // Verificar que el usuario existe
                $usuario = Usuario::where('email', $auth->email);
                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error', 'El usuario no existe');
                } else {
                    // El usuario esta registrado
                    if(password_verify($auth->password, $usuario->password)){

                        // Iniciar Sesión
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        // Redireccionar
                        header('Location: /dashboard');

                        debuguear('TODO: /dashboard');

                    } else {
                        Usuario::setAlerta('error', 'Password incorrecto');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        // Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Login',
            'alertas' => $alertas,
            'inicio' => false
        ]);
    }
    public static function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('Location: /');
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
                    $email = new Email($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->token);


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
            'alertas' => $alertas,
            'inicio' => false
        ]);
    }

    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)){
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {
                    // Generar un nuevo Token
                    $usuario->crearToken();
                    $usuario->password2 = null;

                    // Actualizar el Usuario
                    $usuario->guardar();

                    // Enviar Email
                    $email = new Email($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->token);
                    $email->enviarInstrucciones();

                    // Imprimir Alerta
                    Usuario::setAlerta('exito', 'Se ha enviado un email con las instrucciones');
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe');
                    
                }
               
            }
        }
        $alertas = Usuario::getAlertas();
        // Render a la vista
        $router->render('auth/olvide', [
            'titulo' => 'Recuperar cuenta',
            'alertas' => $alertas,
            'inicio' => false
        ]);
    }

    public static function restablecer(Router $router)
    {
 
        $token = s($_GET['token']);
        $mostrar = true;

        if(!$token) header('Location: /');

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // No hay usuario
            Usuario::setAlerta('error', 'Token invalido');
            $mostrar = false;
        } else {
            // Usuario encontrado
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $usuario->sincronizar($_POST);

                // Almacenar password nuevo

                $usuario->validarPassword();

                if(empty($alertas)) {

                    $usuario->hashPassword();
                    $usuario->password2 = null;
                    $usuario->token = null;
                    $resultado = $usuario->guardar();

                    if($resultado) header('Location: /');
                }

            }
        }

        $alertas = Usuario::getAlertas();

        // Render a la vista
        $router->render('auth/restablecer', [
            'titulo' => 'Restablece tu password',
            'alertas' => $alertas,
            'mostrar' => $mostrar,
            'inicio' => false
        ]);
    }
    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta creada',
            'inicio' => false
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
            $usuario->confirmado = '1';
            $usuario->password2 = null;
            $usuario->token = '';
            $usuario->guardar();
            
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta',
            'alertas' => $alertas,
            'inicio' => false
        ]);
    }
    public static function noValida(Router $router)
    {
        $router->render('auth/rutaNoValida', [
            'titulo' => '404',
            'inicio' => false
        ]);
    }
}

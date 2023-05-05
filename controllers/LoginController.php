<?php

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router){
        echo 'Desde Login!!!';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }

        // Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión'
        ]);

    }
    public static function logout() {
        echo 'Desde Logout';

    }
    public static function crear(Router $router){
        echo 'Desde Crear!!!';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }

        // Render a la vista
        $router->render('auth/crear', [
            'titulo' => 'Crear'
        ]);

    }
    public static function olvide(Router $router){
        echo 'Desde Olvide!!!';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }

    }
    public static function restablecer(Router $router){
        echo 'Desde Reeeeestablecer!!!';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        }

    }
    public static function mensaje() {
        echo 'Desde Mensaje';

    }
    public static function confirmar() {
        echo 'Desde Confirmar';

    }
}

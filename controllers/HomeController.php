<?php

namespace Controllers;


use MVC\Router;

class HomeController {

    public static function index(Router $router){

        $inicio = true;

        $router->render('home/index', [
            'titulo' => 'TaskTrack',
            'inicio' => $inicio
        ]);
    }
}
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
    public static function infoApp(Router $router){

        $inicio = false;

        $router->render('home/info-app', [
            'titulo' => 'About Us',
            'inicio' => $inicio
        ]);
    }
}
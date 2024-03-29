<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {

        // $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '' ? '/' : parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';

        $method = $_SERVER['REQUEST_METHOD'];


        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }


        if ( $fn ) {
            // Call user fn va a llamar una función cuando no se cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            header('Location: /404');
        }
    }

    public function render($view, $datos = [])
    {

        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento

        //  incluiyo la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer


        // Utilizar el layout acorde a la URL
        $url_actual = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '' ? '/' : parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


        if(str_contains($url_actual, '/tasktrack')){
            include_once __DIR__ . '/views/tasktrack-layout.php';
            
        } else {
            include_once __DIR__ . '/views/layout.php';
        }   

    }
}


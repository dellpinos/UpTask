<?php

namespace Controllers;

class TareaController {

    public static function index() {

        echo 'Desde TareaController - index';
    }
    public static function crear() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuesta = [
                'proyectoId' => $_POST['proyectoId']
            ];


            echo json_encode($respuesta);
            
        }
    }
    public static function actualizar() {
        echo 'Desde TareaController - actualizar';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

    }
    public static function eliminar() {
        echo 'Desde TareaController - eliminar';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

    }
}
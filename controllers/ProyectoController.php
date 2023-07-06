<?php

namespace Controllers;

use MVC\Router;
use Model\Tarea;
use Model\Proyecto;




class ProyectoController
{

    public static function index()
    {

        session_start();
        isAuth();
        $id = $_SESSION['id'];


        $proyectos = Proyecto::belongsTo('propietarioId', $id);

        $query = "SELECT * FROM tareas LEFT OUTER JOIN proyectos ON tareas.proyectoId=proyectos.id WHERE propietarioId={$id}";

        $tareas = Tarea::SQL($query);


        requiereCors();
        echo json_encode([
            'proyectos' => $proyectos,
            'tareas' => $tareas
        ]);
    }
}

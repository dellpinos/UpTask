<?php

namespace Controllers;

use Model\Tarea;
use Model\Usuario;
use Model\Proyecto;

class APIPerfil {

    public static function getContadores() {

        session_start();
        isAuth();
        $alertas = [];
    
        $usuario = Usuario::find($_SESSION['id']);
    
        $proyectos = Proyecto::belongsTo('propietarioId', $usuario->id);
        $contadores = [
            'total_proyectos' => 0,
            'total_proyectos_completados' => 0,
            'total_tareas' => 0,
            'total_tareas_completadas' => 0
        ];
    
        foreach ($proyectos as $proyecto) {
            $contadores['total_proyectos']++;
    
            if($proyecto->completado === "1") {
                $contadores['total_proyectos_completados']++;
            }
            $tareas = Tarea::belongsTo('proyectoId', $proyecto->id);
    
            foreach ($tareas as $tarea) {
                $contadores['total_tareas']++;
                if($tarea->estado === "1") {
                    $contadores['total_tareas_completadas']++;
                }
            }
        }

        echo json_encode([
            'contadores' => $contadores
        ]);

        
    }




}
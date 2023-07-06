<?php

namespace Controllers;

use Model\Tarea;
use Model\Proyecto;

class TareaController {

    public static function index() {

        $proyectoId = $_GET['id'];
        if(!$proyectoId) header('Location: /tasktrack/dashboard');
        $proyecto = Proyecto::where('url', $proyectoId);

        session_start();

        if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) header('Location: /404');
        $tareas = Tarea::belongsTo('proyectoId', $proyecto->id);


        requiereCors();
        echo json_encode(['tareas' => $tareas]);
    }

    public static function crear() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);

            if(!$proyecto || $proyecto->propietarioId != $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];
                requiereCors();
                echo json_encode($respuesta);
                return;
            }

            // Pasa las validaciones, crear la tarea
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;

            $resultado = $tarea->guardar();

            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => 'Almacenada correctamente',
                    'id' => $resultado['id'],
                    'proyectoId' => $proyecto->id
                ];
                requiereCors();
                echo json_encode($respuesta);
            } else {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];
                echo json_encode($respuesta);
            }

        }
    }
    public static function actualizar() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar que el proyecto exista
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);
            session_start();

            if(!$proyecto || $proyecto->propietarioId != $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar la tarea'
                ];
                requiereCors();
                echo json_encode($respuesta);
                return;
            }
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;

            $resultado = $tarea->guardar();
            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea->id,
                    'proyectoId' => $proyecto->id,
                    'mensaje' => "Actualizado correctamente!"
                ];
                requiereCors();
                echo json_encode(['respuesta' => $respuesta]);
            }
        }

    }
    public static function eliminar() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar que el proyecto exista
            $proyecto = Proyecto::where('url', $_POST['proyectoId']);
            session_start();

            if(!$proyecto || $proyecto->propietarioId != $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar la tarea'
                ];
                requiereCors();
                echo json_encode($respuesta);
                return;
            }
            $tarea = new Tarea($_POST);

            $resultado = $tarea->eliminar();

            if($resultado) {
                $resultado = [
                    'resultado' => $resultado,
                    'mensaje' => "Eliminado correctamente",
                    'tipo' => 'exito'
                ];
            } else {
                $resultado = [
                    'resultado' => $resultado,
                    'mensaje' => "Algo salio mal",
                    'tipo' => 'error'
                ];
            }
            
            requiereCors();
            echo json_encode($resultado);

            
        }

    }
}
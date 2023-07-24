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

        $proyectos_ids = [];
        $contador_tareas = [];
        $tareas_completadas = [];


        foreach ($tareas as $tarea) {
            $proyectos_ids[] = $tarea->proyectoId;
        }

        foreach ($proyectos_ids as $proyecto_id) {
            $contador_tareas[$proyecto_id] = Tarea::total('proyectoId', $proyecto_id);
            $tareas_completadas[$proyecto_id] = Tarea::totalArray(['proyectoId' => $proyecto_id, 'estado' => 1]);

            if ($contador_tareas[$proyecto_id] === $tareas_completadas[$proyecto_id]) {

                foreach ($proyectos as $proyecto) {
                    if ($proyecto->id === $proyecto_id) {
                        $proyecto->completado = 1;
                        $proyecto->sincronizar();
                        $proyecto->guardar();
                    }
                }
            } else {
                foreach ($proyectos as $proyecto) {
                    if ($proyecto->id === $proyecto_id) {
                        $proyecto->completado = 0;
                        $proyecto->sincronizar();
                        $proyecto->guardar();
                    }
                }


            }
        }


        requiereCors();
        echo json_encode([
            'proyectos' => $proyectos,
            'tareas' => $tareas
        ]);
    }

    public static function actualizar_proyecto(Router $router)
    {

        session_start();
        isAuth();
        $alertas = [];

        $id = $_GET['id'];
        $proyecto = Proyecto::where('url', $id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            isAuth();

            $id = $_GET['id'];
            $proyecto = Proyecto::where('url', $id);



            if (empty($alertas)) {
                // Generar una URL única
                $proyecto->proyecto = $_POST['proyecto'];

                $proyecto->sincronizar();

                // Validación
                $alertas = $proyecto->validarProyecto();

                // Guardar Proyecto
                $proyecto->guardar();

                // Redireccionar
                header('Location: /tasktrack/proyecto?id=' . $proyecto->url);
            }
        }

        $router->render('dashboard/actualizar-proyecto', [
            'titulo' => 'Cambiar nombre',
            'proyecto' => $proyecto,
            'alertas' => $alertas
        ]);
    }



    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar id
            session_start();
            isAuth();

            $id = $_POST['proyecto-hidden'];

            if ($id) {
                $proyecto = Proyecto::where('url', $id);
                $proyecto->eliminar();

                header('Location: /tasktrack/dashboard');
            }
        }
    }
}

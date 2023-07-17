<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Proyecto;

use Orhanerday\OpenAi\OpenAi;

class APIAssistantController
{

    public static function prueba(Router $router)
    {
        session_start();

        $alertas = [];
        $complete = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $post = $_POST['prompt'];

            $open_ai_key = $_ENV['OPENAI_API_KEY'];

            $open_ai = new OpenAi($open_ai_key);

            $complete = $open_ai->completion([
                'model' => 'text-davinci-003',
                'prompt' => $post,
                'temperature' => 0.9,
                'max_tokens' => 150,
                'frequency_penalty' => 0,
                'presence_penalty' => 0.6,
            ]);

            $respuesta = json_decode($complete);


            echo json_encode($respuesta->choices[0]->text);

            return;
        }
    }


    // Copiado de tareas, hay que probar esto y cambiar nombres
    // public static function crear() {

    //     return; // <<<<<<<



    //     if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         session_start();
    //         $proyecto = Proyecto::where('url', $_POST['proyectoId']);

    //         if(!$proyecto || $proyecto->propietarioId != $_SESSION['id']) {
    //             $respuesta = [
    //                 'tipo' => 'error',
    //                 'mensaje' => 'Hubo un error al agregar la tarea'
    //             ];
    //             requiereCors();
    //             echo json_encode($respuesta);
    //             return;
    //         }

    //         // Pasa las validaciones, crear la tarea
    //         $tarea = new Tarea($_POST);
    //         $tarea->proyectoId = $proyecto->id;

    //         $resultado = $tarea->guardar();

    //         if($resultado) {
    //             $respuesta = [
    //                 'tipo' => 'exito',
    //                 'mensaje' => 'Almacenada correctamente',
    //                 'id' => $resultado['id'],
    //                 'proyectoId' => $proyecto->id
    //             ];
    //             requiereCors();
    //             echo json_encode($respuesta);
    //         } else {
    //             $respuesta = [
    //                 'tipo' => 'error',
    //                 'mensaje' => 'Hubo un error al agregar la tarea'
    //             ];
    //             echo json_encode($respuesta);
    //         }

    //     }
    // }
}
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


            $proyecto = $_POST['prompt'];

            // Deberia consultar la base de datos para obtener las tareas actuales del proyecto y añadirlas al prompt

            $prompt = 'Divide el proyecto: ' . $proyecto . ' en 5 tareas (no enumeradas) mas sencillas, estas tareas no pueden tener mas de 5 palabras. Dame una respuesta en texto plano y separa cada tarea con un guion "-". ';


            $open_ai_key = $_ENV['OPENAI_API_KEY'];

            $open_ai = new OpenAi($open_ai_key);

            $complete = $open_ai->completion([
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'temperature' => 0.9,
                'max_tokens' => 150,
                'frequency_penalty' => 0,
                'presence_penalty' => 0.6,
            ]);

            $respuesta = json_decode($complete);

            // accedo al string que corresponde a la respuesta
            
            echo json_encode($respuesta->choices[0]->text); 

            return;
        }
    }



}
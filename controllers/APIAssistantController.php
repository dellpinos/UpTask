<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Proyecto;

use Orhanerday\OpenAi\OpenAi;

class APIAssistantController
{

    public static function tareasIA(Router $router)
    {
        session_start();

        $alertas = [];
        $complete = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $proyecto = $_POST['prompt'];

            if(isset($_POST['tareas'])){
                $tareas = $_POST['tareas'];
            }


            $prompt = 'Divide el proyecto: ' . $proyecto . ' en 5 instrucciones (no enumeradas) mas sencillas, intenta ser elocuente utilizando mas de 2 palabras y menos de 5 palabras por instruccion.';
            
            if(isset($tareas)){
                $prompt .= 'Debes tener en cuenta las instrucciones ya existentes: ' . $tareas;
            }

            $prompt .= 'Dame una respuesta en texto plano (sin puntos) y separa cada instruccion con un guion "-". ';


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
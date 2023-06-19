<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado
function isAuth(): void
{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

// Evitar conflicto CORS de recursos de origen cruzado
// Este codigo es parte de otras soluciones implementadas para que
// la aplicacion funcione en Android, tenia este conflicto bloqueando al fetch() de Js
// e impidiendo la ejecucion.
// Puede no ser necesaria pero se encuentra en Prod y funciona correctamente el codigo
function requiereCors()
{
    
    // Obtener el origen de la solicitud
    $origen = $_SERVER['HTTP_HOST'];

    // Definir el origen permitido
    $origenPermitido = $_ENV['HOST'];

    // Verificar si se requiere el encabezado 'Access-Control-Allow-Origin'
    $seRequiereCors = $origen !== $origenPermitido;

    if ($seRequiereCors) {
        header('Access-Control-Allow-Origin: ' . $_ENV['HOST']);
    }
}

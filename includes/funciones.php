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

function requiereCors()
{
    // Obtener el origen de la solicitud
    $origin = $_SERVER['HTTP_HOST'];

    // Definir el origen permitido
    $allowedOrigin = $_ENV['HOST'];

    // Verificar si se requiere el encabezado 'Access-Control-Allow-Origin'
    $seRequiereCors = $origin !== $allowedOrigin;

    if ($seRequiereCors) {
        header('Access-Control-Allow-Origin:  ' . $_ENV['HOST']);
    }
}

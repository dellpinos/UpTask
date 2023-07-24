<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\HomeController;
use Controllers\LoginController;
use Controllers\TareaController;
use Controllers\ProyectoController;
use Controllers\DashboardController;
use Controllers\APIAssistantController;

$router = new Router();

/* Zona Publica */

// Paginas Principales
$router->get('/', [HomeController::class, 'index']);
$router->get('/info-app', [HomeController::class, 'infoApp']);

// Login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Crear cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

// Formulario de Olvide mi password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

// Colocar nuevo password
$router->get('/restablecer', [LoginController::class, 'restablecer']);
$router->post('/restablecer', [LoginController::class, 'restablecer']);

// Confirmación de cuenta
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar', [LoginController::class, 'confirmar']);

// Ruta no soportada
$router->get('/404', [LoginController::class, 'noValida']);


/* Zona Privada */

// Zona de proyectos
$router->get('/tasktrack/dashboard', [DashboardController::class, 'index']);
$router->get('/tasktrack/crear-proyecto', [DashboardController::class, 'crear_proyecto']);
$router->post('/tasktrack/crear-proyecto', [DashboardController::class, 'crear_proyecto']);

$router->get('/tasktrack/actualizar-proyecto', [ProyectoController::class, 'actualizar_proyecto']);
$router->post('/tasktrack/actualizar-proyecto', [ProyectoController::class, 'actualizar_proyecto']);

$router->post('/tasktrack/eliminar-proyecto', [ProyectoController::class, 'eliminar']);

$router->get('/tasktrack/proyecto', [DashboardController::class, 'proyecto']);

// Prueba de AI
$router->get('/tasktrack/prueba', [DashboardController::class, 'prueba']);
$router->post('/tasktrack/prueba', [APIAssistantController::class, 'prueba']);

// Perfil
$router->get('/tasktrack/perfil', [DashboardController::class, 'perfil']);
$router->post('/tasktrack/perfil', [DashboardController::class, 'perfil']);
$router->get('/tasktrack/cambiar-password', [DashboardController::class, 'cambiar_password']);
$router->post('/tasktrack/cambiar-password', [DashboardController::class, 'cambiar_password']);

// API para las tareas
$router->get('/api/tareas', [TareaController::class, 'index']);
$router->post('/api/tarea', [TareaController::class, 'crear']);
$router->post('/api/tarea/actualizar', [TareaController::class, 'actualizar']);
$router->post('/api/tarea/eliminar', [TareaController::class, 'eliminar']);


// API para proyectos
$router->get('/api/proyectos', [ProyectoController::class, 'index']);


$router->post('/api/proyecto/actualizar', [ProyectoController::class, 'actualizar_proyecto']); // <<<< ?



// Comprueba y valida las rutas, les asigna las funciones del Controlador
$router->comprobarRutas();
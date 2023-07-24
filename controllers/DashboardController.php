<?php

namespace Controllers;

use MVC\Router;
use Model\Tarea;
use Model\Usuario;
use Model\Proyecto;


class DashboardController
{

    public static function index(Router $router)
    {

        session_start();

        isAuth();

        $id = $_SESSION['id'];

        $proyectos = Proyecto::belongsTo('propietarioId', $id);

        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]);
    }
    public static function crear_proyecto(Router $router)
    {

        session_start();
        isAuth();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            // Validación
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                // Generar una URL única
                $proyecto->url = md5(uniqid());

                // Almacenar al creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];

                // Guardar Proyecto
                $proyecto->guardar();

                // Redireccionar
                header('Location: /tasktrack/proyecto?id=' . $proyecto->url);
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }
    public static function proyecto(Router $router)
    {

        session_start();
        isAuth();

        $token = $_GET['id'];
        if (!$token) {
            header('Location: /tasktrack/dashboard');
            return;
        }

        // Verificar al creador del proyecto
        $proyecto = Proyecto::where('url', $token);
        if ($proyecto->propietarioId != $_SESSION['id']) {
            header('Location: /tasktrack/dashboard');
            return;
        }



        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto,
            'token' => $token
        ]);
    }

    public static function perfil(Router $router)
    {

        session_start();
        isAuth();


        $usuario = Usuario::find($_SESSION['id']);

        $alertas = [];


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


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_perfil();

            if (empty($alertas)) {

                $existeUsuario = Usuario::where('email', $usuario->email);


                if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    // Mostrar mensaje de error, este email ya esta registrado
                    Usuario::setAlerta('error', 'El email ya esta registrado');
                } else {
                    // Almacenar nuevos datos
                    $usuario->guardar();
                    Usuario::setAlerta('exito', 'Actualizado correctamente');
                    // Asignar nuevo nombre
                    $_SESSION['nombre'] = $usuario->nombre;
                    $_SESSION['apellido'] = $usuario->apellido;
                }
            }
            $alertas = $usuario->getAlertas();
        }

        $router->render('dashboard/perfil', [
            'titulo' => 'Tu Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas,
            'contadores' => $contadores
        ]);
    }
    public static function cambiar_password(Router $router)
    {

        session_start();
        isAuth();
        $alertas = [];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);

            // Sincronizar con los datos del usuario
            $usuario->sincronizar($_POST);

            $alertas = $usuario->nuevo_password();

            if (empty($alertas)) {
                $resultado = $usuario->comprobar_password();

                if ($resultado) {
                    //Asignar nuevo password
                    $usuario->password = $usuario->password_nuevo;

                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    $usuario->hashPassword();
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        Usuario::setAlerta('exito', 'Password actualizado con exito');
                        $alertas = $usuario->getAlertas();
                    }
                } else {
                    Usuario::setAlerta('error', 'Password Incorrecto');
                    $alertas = $usuario->getAlertas();
                }
            }
        }

        $router->render('dashboard/cambiar-password', [
            'alertas' => $alertas,
            'titulo' => 'Cambiar password'
        ]);
    }

    public static function prueba(Router $router)
    {
        session_start();

        $alertas = [];


        $router->render('dashboard/prueba', [
            'alertas' => $alertas,
            'titulo' => 'Prueba'
        ]);
    }
}

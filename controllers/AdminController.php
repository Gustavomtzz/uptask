<?php

namespace Controllers;

use Model\Proyecto;
use MVC\Router;


class AdminController
{


    public static function index(Router $router)
    {
        $alertas = [];

        $proyectos = Proyecto::belongsTo('propietarioId', $_SESSION['usuarioId']);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
        }

        $router->render('/dashboard/index', [
            'titulo' => "Proyectos",
            'contenido' => "proyectos",
            'alertas' => $alertas,
            'proyectos' => $proyectos
        ]);
    }

    public static function crear(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $proyecto = new Proyecto($_POST);
            $alertas = $proyecto->validarTitulo();

            if (empty($alertas)) {

                //Crear URL unica
                $proyecto->url = md5(uniqid());
                //Asignar el Usuario ID al proyecto
                $proyecto->propietarioId = $_SESSION['usuarioId'];

                //Guardar Proyecto
                $proyecto->guardar();

                //Redireccionar
                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }


        $router->render('/dashboard/index', [
            'titulo' => "Crear Proyecto",
            'alertas' => $alertas,
            'contenido' => "crear"
        ]);
    }

    public static function perfil(Router $router)
    {
        $alertas = [];
        $router->render('/dashboard/index', [
            'titulo' => "Perfil",
            'contenido' => "perfil",
            'alertas' => $alertas
        ]);
    }


    public static function admin(Router $router)
    {

        $router->render('/admin/index', []);
    }


    public static function proyecto(Router $router)
    {
        $alertas = [];
        $url = $_GET['id'];


        //En caso de que no haya un id;
        if (!$url) {
            header('Location: /dashboard');
        }


        //Revisar que la persona que visita el proyecto es quien lo creo.
        $proyecto = Proyecto::where('url', $url);
        if ($_SESSION['usuarioId'] !== $proyecto->propietarioId) {
            header('Location: /dashboard');
        }




        $router->render('/dashboard/index', [
            'titulo' => $proyecto->proyecto,
            'contenido' => "proyecto",
            'alertas' => $alertas
        ]);
    }
}

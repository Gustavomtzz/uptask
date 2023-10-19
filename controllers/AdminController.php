<?php

namespace Controllers;

use MVC\Router;


class AdminController
{


    public static function index(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            debuguear($_POST);
        }

        $router->render('/dashboard/index', [
            'titulo' => "Proyectos",
            'contenido' => "proyectos",
            'alertas' => $alertas
        ]);
    }

    public static function crear(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            debuguear($_POST);
        }


        $router->render('/dashboard/index', [
            'titulo' => "Crear Proyecto",
            'contenido' => "crear",
            'alertas' => $alertas
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
}

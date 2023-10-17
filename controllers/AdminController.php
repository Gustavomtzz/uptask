<?php

namespace Controllers;

use MVC\Router;


class AdminController
{


    public static function index(Router $router)
    {

        $router->render('/dashboard/index', []);
    }


    public static function admin(Router $router)
    {

        $router->render('/admin/index', []);
    }
}

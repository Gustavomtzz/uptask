<?php

namespace Controllers;

use MVC\Router;

class LoginController
{

    public static function login(Router $router)
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        }


        $router->render("/index/login", [
            'titulo' => "Iniciar Sesión"
        ]);
    }

    public static function logout(Router $router)
    {


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        }



        $router->render("/index/logout", []);
    }

    public static function crear(Router $router)
    {


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        }

        $router->render("/index/crearUsuario", [
            'titulo' => "Crear Usuario"
        ]);
    }

    public static function recuperar(Router $router)
    {


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        }

        $router->render("/index/recuperarPassword", [
            'titulo' => "Recuperar Password"
        ]);
    }

    public static function reestablecer(Router $router)
    {


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        }

        $router->render("/index/reestablecerPassword", []);
    }

    public static function mensaje(Router $router)
    {


        $router->render("/index/mensaje", []);
    }

    public static function confirmar(Router $router)
    {


        $router->render("/index/confirmarCuenta", []);
    }
}

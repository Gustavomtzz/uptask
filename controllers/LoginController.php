<?php

namespace Controllers;

use Model\Usuario;
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
            $usuario = new Usuario($_POST);
            $usuario->validarDatos();
            $errores = Usuario::getAlertas();
            if (empty($errores)) {

                $usuarioPrevio = $usuario->usuarioExiste();

                if ($usuarioPrevio->num_rows === 0) {

                    if ($usuario->password === $_POST['repetirpassword']) {
                        $usuario->hashPassword();
                        $usuario->crearToken();
                        $resultado =  $usuario->guardar();

                        if ($resultado['resultado']) {
                            header('Location: /');
                        }
                    } else {
                        echo "No son Iguales";
                    }
                } else {
                    $usuario::setAlerta('error', 'Ya existe un usuario registrado.');
                }
            } else {
                debuguear($errores);
            }
        }
        $errores = Usuario::getAlertas();
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

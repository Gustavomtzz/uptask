<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController
{

    public static function login(Router $router)
    {
        $mensaje = 0;
        if (isset($_GET['mensaje'])) {
            $mensaje = intval($_GET['mensaje']);
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        }


        $router->render("/index/login", [
            'titulo' => "Iniciar Sesión",
            'mensaje' => $mensaje
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
            $alertas = Usuario::getAlertas();

            if (empty($alertas)) {

                $usuarioPrevio = $usuario->usuarioExiste();

                if ($usuarioPrevio->num_rows === 0) {

                    if ($usuario->password === $_POST['repetirpassword']) {
                        $usuario->hashPassword();
                        $usuario->crearToken();
                        //Enviar Email
                        $email = new Email($usuario->nombre, $usuario->email, $usuario->token, 'confirmar');
                        $enviado = $email->enviarEmail();


                        if ($enviado) {
                            $resultado = $usuario->guardar();
                            if ($resultado['resultado'] === true) {
                                $usuario->redireccionar("/mensaje");
                            }
                        }
                    } else {
                        $usuario::setAlerta('error', 'Los Passwords deben ser iguales.');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("/index/crearUsuario", [
            'titulo' => "Crear Usuario",
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router)
    {
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $usuario = Usuario::where('email', $userEmail);

            if (isset($usuario)) {
                $usuario->crearToken();
                $usuario->confirmado = 0;
                $usuario->guardar();
                $email = new Email($usuario->nombre, $usuario->email, $usuario->token, 'reestablecer');
                $enviado =  $email->enviarEmail();
                if ($enviado) {
                    $usuario->redireccionar('/mensaje');
                }
            } else {
                Usuario::setAlerta('error', "Usuario inexistente o email no válido");
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("/index/recuperarPassword", [
            'titulo' => "Recuperar Password",
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router)
    {
        $alertas = [];
        $token = "";
        $form = true;


        if (!empty($_GET['token'])) {
            $token = s($_GET['token']);
            $usuario = Usuario::where('token', $token);
            if (!isset($usuario->id)) {
                $form = false;
            }
        }



        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $nuevoPassword = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);


            if (!empty($_GET['token'])) {
                $token = s($_GET['token']);
                $usuario = Usuario::where('token', $token);
            }


            if (isset($usuario->id)) {
                $usuario->password = $nuevoPassword;
                $alertas = $usuario->validarDatos();

                if (empty($alertas)) {
                    $usuario->hashPassword();
                    $usuario->confirmado = 1;
                    $usuario->token = "";
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        $usuario->redireccionar('/?mensaje=3');
                    } else {
                        Usuario::setAlerta('error', 'Error al Reestablecer el password');
                    }
                }
            } else {
                Usuario::setAlerta('error', 'TOKEN NO VÁLIDO');
                $form = false;
            }
        }


        $alertas = Usuario::getAlertas();

        $router->render("/index/reestablecerPassword", [
            'titulo' => "Reestablecer Password",
            'alertas' => $alertas,
            'form' => $form
        ]);
    }

    public static function mensaje(Router $router)
    {


        $router->render("/index/mensaje", [
            'titulo' => "Cuenta creada correctamente"
        ]);
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = "";


        if (!empty($_GET['token'])) {
            $token = s($_GET['token']);
            $usuarioDB = Usuario::where('token', $token);
        }


        if (isset($usuarioDB->id)) {
            $usuarioDB->confirmado = "1";
            $usuarioDB->token = null;
            $usuarioDB->guardar();
            $usuarioDB::setAlerta('exito', 'Usuario creado correctamente');
        } else {
            Usuario::setAlerta('error', 'TOKEN NO VÁLIDO');
        }

        $alertas = Usuario::getAlertas();

        $router->render("/index/confirmarCuenta", [
            'titulo' => "Confirmar cuenta",
            'alertas' => $alertas
        ]);
    }
}

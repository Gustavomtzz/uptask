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

            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {

                //Verificar si existe el email del Usuario
                $usuarioDB = Usuario::where('email', $usuario->email);

                if (!empty($usuarioDB)) {
                    //Verificar Password
                    $passwordCorrecto = $usuario->comprobarPassword($usuarioDB->password);
                    if ($passwordCorrecto) {
                        $confirmado = $usuarioDB->confirmado;
                        if ($confirmado === "1") {
                            session_start();
                            $_SESSION = [];
                            $_SESSION['nombre'] = "{$usuarioDB->nombre} {$usuarioDB->apellido}";
                            $_SESSION['login'] = true;
                            $_SESSION['email'] = $usuarioDB->email;
                            $_SESSION['usuarioId'] = $usuarioDB->id;

                            //Reedireccionamos
                            if ($usuarioDB->admin === "1") {
                                $_SESSION['admin'] = $usuarioDB->admin;
                                header('Location: /admin');
                            } else {
                                header('Location: /dashboard');
                            }
                        }
                    }
                } else {
                    Usuario::setAlerta('error', "Usuario inexistente");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("/index/login", [
            'titulo' => "Iniciar Sesión",
            'mensaje' => $mensaje,
            'alertas' => $alertas
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
        $form = false;


        if (!empty($_GET['token'])) {
            $token = s($_GET['token']);
            $usuario = Usuario::where('token', $token);
            if (isset($usuario->id)) {
                $form = true;
            }
        } else {
            Usuario::setAlerta('error', 'TOKEN NO VÁLIDO');
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
        } else {
            header('Location: /');
        }


        if (isset($usuarioDB->id)) {
            $usuarioDB->confirmado = "1";
            $usuarioDB->token = null;
            $usuarioDB->guardar();
            $usuarioDB::setAlerta('exito', 'Cuenta confirmada correctamente');
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

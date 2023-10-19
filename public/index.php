<?php

require_once __DIR__ . '/../includes/app.php';


//IMPORTAR CLASSES
use MVC\Router;
use Controllers\AdminController;
use Controllers\LoginController;

$router = new Router();


/*RUTAS INDEX */

//Login
$router->get('/', [LoginController::class, "login"]);
$router->post('/', [LoginController::class, "login"]);
$router->get('/logout', [LoginController::class, 'logout']);

//Crear Cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

//Recuperar Password
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//Reestablecer Nuevo Password
$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);

//Mensaje Exito Password Reestablecido
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//Confirmar Cuenta
$router->get('/confirmar', [LoginController::class, 'confirmar']);


/*FIN RUTAS INDEX */


/**AREA  DASHBOARD  */
$router->get('/dashboard', [AdminController::class, 'index']);
$router->post('/dashboard', [AdminController::class, 'index']);
$router->get('/crearproyecto', [AdminController::class, 'crear']);
$router->post('/crearproyecto', [AdminController::class, 'crear']);
$router->get('/perfil', [AdminController::class, 'perfil']);
$router->post('/perfil', [AdminController::class, 'perfil']);


/** AREA ADMINISTRADOR */
$router->get('/admin', [AdminController::class, 'admin']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

<?php

require_once __DIR__ . '/../includes/app.php';


//IMPORTAR CLASSES
use MVC\Router;
use Controllers\ApiController;
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
//INDICE
$router->get('/dashboard', [AdminController::class, 'index']);
$router->post('/dashboard', [AdminController::class, 'index']);
//Crear Nuevo Proyecto
$router->get('/crearproyecto', [AdminController::class, 'crear']);
$router->post('/crearproyecto', [AdminController::class, 'crear']);
//Perfil Usuario
$router->get('/perfil', [AdminController::class, 'perfil']);
$router->post('/perfil', [AdminController::class, 'perfil']);

// URL del PROYECTO CREADO
$router->get('/proyecto', [AdminController::class, 'proyecto']);


/** AREA ADMINISTRADOR */
$router->get('/admin', [AdminController::class, 'admin']);

/**Fin AREA DASHBOARD */

/** API TAREAS */
$router->get('/api/tarea', [ApiController::class, 'index']);
$router->post('/api/tarea/crear', [ApiController::class, 'guardar']);
$router->get('/api/tarea/actualizar', [ApiController::class, 'actualizar']);
$router->post('/api/tarea/actualizar', [ApiController::class, 'actualizar']);
$router->post('/api/tarea/eliminar', [ApiController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

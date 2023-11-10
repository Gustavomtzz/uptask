<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;


class ApiController
{


    public static function index()
    {
        $urlProyecto = $_GET['id'];
        if (!$urlProyecto) header('Location: /dashboard');

        $proyecto = Proyecto::where('url', $urlProyecto);
        session_start();;
        if (!$proyecto || $proyecto->propietarioId !== $_SESSION['usuarioId']) header('Location: /404');

        $tareas = Tarea::belongsTo('idProyecto', $proyecto->id);

        echo json_encode($tareas);
    }

    public static function guardar()
    {

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            session_start();


            $idProyecto = Proyecto::where('url', $_POST['idProyecto']);


            /**Verificamos si la persona que inicio sesión es diferente a la que envio el proyecto o no existe el proyecto */

            if (!$idProyecto || $idProyecto->propietarioId !== $_SESSION['usuarioId']) {

                //Si NO EXISTE el proyecto enviamos una respuesta.
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'No se pudo agregar la tarea correctamente.'
                ];

                echo json_encode($respuesta);
                return; //Cortamos la ejecución del código siguiente
            }

            /**EN CASO DE QUE EL PROPIETARIO Y EL PROYECTO SEA CORRECTO */

            $_POST['idProyecto'] = $idProyecto->id;


            $tarea = new Tarea($_POST);
            $alertas = $tarea->validar();

            if (empty($alertas)) {
                $resultado = $tarea->guardar();
            }
            $resultado["idProyecto"] = $idProyecto->id;

            //Mostramos la Respuesta
            echo json_encode($resultado);
        }
    }

    public static function actualizar()
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            //Verificamos el ID del POST
            $idTarea = $_POST['id'];

            //Si no existe o es incorrecto redireecionamos al dashboard
            if (!$idTarea) header('Location: /dashboard');
            //Buscamos la Tarea en la BD
            $tarea = Tarea::where('id', $idTarea);
            //Si no Existe la Tarea en la BD
            if (!$tarea) header('Location: /404');


            if ($tarea->tarea) {
                $tarea->tarea = $_POST['tarea'];
                $resultado =  $tarea->guardar();
                echo json_encode($resultado);
            }
        } else {
            //Verificamos el ID del Get
            $idTarea = $_GET['id'];
            //Si no existe o es incorrecto redireecionamos al dashboard
            if (!$idTarea) header('Location: /dashboard');
            $tarea = Tarea::where('id', $idTarea);
            if (!$tarea) header('Location: /404');

            $proyecto = Proyecto::where('id', $tarea->idProyecto);

            if ($tarea->estado === "1") {
                $tarea->estado = "0";
                $tarea->guardar();
                header("Location: /proyecto?id={$proyecto->url}");
            } else {
                $tarea->estado = "1";
                $tarea->guardar();
                header("Location: /proyecto?id={$proyecto->url}");
            }
        }
    }
    public static function eliminar()
    {

        //Verificamos el ID del Get
        $idTarea = $_POST['id'];
        //Si no existe o es incorrecto redireecionamos al dashboard
        if (!$idTarea) header('Location: /dashboard');
        $tarea = Tarea::where('id', $idTarea);
        if (!$tarea) header('Location: /404');

        //Si Existe una Tarea buscamos la url del proyecto
        $proyecto = Proyecto::where('id', $tarea->idProyecto);

        //Eliminamos la Tarea
        if ($tarea) {
            $tarea->eliminar();
            header("Location: /proyecto?id={$proyecto->url}");
        }
    }
}

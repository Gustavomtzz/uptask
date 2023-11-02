<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;


class ApiController
{


    public static function index()
    {
        $id = 1;
        $tareas = Tarea::belongsTo('idProyecto', $id);

        echo json_encode($tareas);
    }

    public static function guardar()
    {

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            session_start();


            $idProyecto = Proyecto::where('url', $_POST['idProyecto']);


            //Verificamos si la persona que inicio sesión es diferente a la que envio el proyecto o no existe el proyecto
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

            //Retornamos una Respuesta
            $respuesta = [
                'resultado' => $resultado
            ];
            //Mostramos la Respuesta
            echo json_encode($respuesta);
        }
    }

    public static function actualizar()
    {
    }
    public static function eliminar()
    {
    }
}

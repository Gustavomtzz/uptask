<?php

namespace Model;

use Model\ActiveRecord;

class Tarea extends ActiveRecord
{

    protected static $tabla = 'tareas';
    protected static $columnasDB = ['id', 'tarea', 'idProyecto', 'estado'];

    public $id;
    public $tarea;
    public $idProyecto;
    public $estado;


    public function __construct(array $args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->tarea = $args['tarea'] ?? '';
        $this->idProyecto = $args['idProyecto'] ?? null;
        $this->estado = $args['estado'] ?? 0;
    }

    public function validar()
    {
        if (empty($this->tarea)) {
            self::$alertas['error'][] = "Nombre de la Tarea Vacio";
        }
        if (empty($this->idProyecto)) {
            self::$alertas['error'][] = "Url de la Tarea Vacio";
        }
    }
}

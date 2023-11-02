<?php

namespace Model;

use Model\ActiveRecord;


class Proyecto extends ActiveRecord
{

    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id', 'proyecto', 'url', 'propietarioId', 'estado'];

    public $id;
    public $proyecto;
    public $url;
    public $propietarioId;
    public $estado;

    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->proyecto = $args['proyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? null;
        $this->estado = $args['estado'] ?? 0;
    }



    public function validarTitulo()
    {

        if (empty($this->proyecto)) {
            self::$alertas['error'][] = "El Nombre del proyecto es obligatorio.";
        }

        return self::$alertas;
    }
}

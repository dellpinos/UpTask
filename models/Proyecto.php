<?php

namespace Model;

use Model\ActiveRecord;

class Proyecto extends ActiveRecord {

    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id', 'proyecto', 'url', 'propietarioId', 'completado'];

    public $id;
    public $proyecto;
    public $url;
    public $propietarioId;
    public $completado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->proyecto = $args['proyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';     
        $this->completado = $args['completado'] ?? '0';   
    }

    public function validarProyecto() {
        if(!$this->proyecto) {
            self::$alertas['error'][] = "El nombre del proyecto es obligatorio";
        }
        return self::$alertas;
    }
}
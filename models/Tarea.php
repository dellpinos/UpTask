<?php

namespace Model;


class Tarea extends ActiveRecord {

    protected static $tabla = 'tareas';
    protected static $columnasDB = ['id', 'nombre', 'estado', 'proyectoId'];

    static $id;
    static $nombre;
    static $estado;
    static $proyectoId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->estado = $args['estado'] ?? 0;
        $this->proyectoId = $args['proyectiId'] ?? '';

    }
}
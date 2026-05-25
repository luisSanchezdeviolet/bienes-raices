<?php


namespace App;

class Seller extends ActiveRecord {
    protected static $table = 'vendedores';
    protected static $columnsDb = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        
    }


    public function validate()
    {
        if (!$this->nombre) {
            self::$errors[] = 'Debes añadir un nombre';
        }
        
        if (!$this->apellido) {
            self::$errors[] = 'Debes añadir un apellido';
        }

        if (!$this->telefono) {
            self::$errors[] = 'Debes añadir un telefono';
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errors[] = 'Formato no valido';
        }

        return self::$errors;

    }

    
}
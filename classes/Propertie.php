<?php

namespace App;


class Propertie extends ActiveRecord
{
    protected static $table = 'propiedades';
    protected static $columnsDb = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'vendedorId', 'creado'];


    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $vendedorId;
    public $creado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->vendedorId = $args['vendedorId'] ?? '';
        $this->creado = date('Y/m/d');
    }


    public function validate()
    {
        if (!$this->titulo) {
            self::$errors[] = 'Debes añadir un titulo';
        }

        if (!$this->precio) {
            self::$errors[] = 'El precio es Obligatorio';
        }

        if (!(strlen($this->descripcion) > 50)) {
            self::$errors[] = 'La descripcion es Obligatorio y debe tener al menos 50 caracteres';
        }

        if (!$this->habitaciones) {
            self::$errors[] = 'El numero de habitaciones es obligatorio';
        }

        if (!$this->wc) {
            self::$errors[] = 'El numero de baños es obligatorio';
        }

        if (!$this->estacionamiento) {
            self::$errors[] = 'El numero de estacionamientos es obligatorio';
        }

        if (!$this->vendedorId) {
            self::$errors[] = 'Elige un vendedor';
        }

        if (!$this->imagen) {
            self::$errors[] = 'La imagen de la propiedad es obligatoria';
        }

        return self::$errors;
    }
}

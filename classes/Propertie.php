<?php

namespace App;


class Propertie
{

    //Base de datos
    protected static $db;
    protected static $columnsDb = ['id', 'title', 'price', 'image', 'description', 'rooms', 'wc', 'parking', 'date', 'sellers_id'];

    //Errores
    protected static $errors = [];

    public $id;
    public $title;
    public $price;
    public $image;
    public $description;
    public $rooms;
    public $wc;
    public $parking;
    public $sellers_id;
    public $date;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->rooms = $args['rooms'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->parking = $args['parking'] ?? '';
        $this->sellers_id = $args['sellers_id'] ?? '';
        $this->date = date('Y/m/d');
    }


    //Definir la conexion a la db
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function save()
    {
        if (!is_null($this->id)) {
            //actualizar
            $this->update();
        } else {
            //Creando nuevo registro
            $this->create();
        }
    }


    public function create()
    {

        //sanitizar los datos
        $attributes = $this->sanitizeAttributes();


        //Insertar en la base de datosd
        $query = "INSERT INTO properties (";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";


        $result = self::$db->query($query);

        if ($result) {
            //Redireccionar al usuario
            header('Location: ../index.php?result=2');
        }
    }

    public function update()
    {
        $attributes = $this->sanitizeAttributes();

        $values = [];
        foreach ($attributes as $key => $value) {
            $values[] = "{$key}='value'";
        }

        $query = "UPDATE properties SET ";
        $query .= join(', ', $values);
        $query .= "WHERE id ='" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";

        $result = self::$db->query($query);

        return $result;

        if ($result) {
            //Redireccionar al usuario
            header('Location: ../index.php?result=2');
        }
    }

    //Eliminar registro
    public function delete()
    {
        $query = "DELETE FROM properties WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);

        if ($result) {
            $this->imageDelete();
            header("Location: ../admin/index.php?result=3");
        }
    }

    //identificar y unir los atributos de la bd
    public function attributes()
    {
        $attributes = [];
        foreach (self::$columnsDb as $column) {
            if ($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeAttributes()
    {
        $attributes = $this->attributes();
        $sanitize = [];

        foreach ($attributes as $key => $value) {
            $sanitize[$key] = self::$db->escape_string($value);
        }

        return $sanitize;
    }

    public static function getErros()
    {
        return self::$errors;
    }

    public function validate()
    {
        if (!$this->title) {
            self::$errors[] = 'Debes añadir un titulo';
        }

        if (!$this->price) {
            self::$errors[] = 'El precio es Obligatorio';
        }

        if (!(strlen($this->description) > 50)) {
            self::$errors[] = 'La descripcion es Obligatorio y debe tener al menos 50 caracteres';
        }

        if (!$this->rooms) {
            self::$errors[] = 'El numero de habitaciones es obligatorio';
        }

        if (!$this->wc) {
            self::$errors[] = 'El numero de baños es obligatorio';
        }

        if (!$this->parking) {
            self::$errors[] = 'El numero de estacionamientos es obligatorio';
        }

        if (!$this->sellers_id) {
            self::$errors[] = 'Elige un vendedor';
        }

        if (!$this->image) {
            self::$errors[] = 'La imagen es obligatoria';
        }

        return self::$errors;
    }


    public function setImage($image)
    {
        //Elimina imagen previa
        if (!is_null($this->id)) {
            $this->imageDelete();
        }

        if ($image) {
            $this->image = $image;
        }
    }

    //Elimina el archivo
    public function imageDelete()
    {
        //Comprobar si existe el archivo
        $archiveExist = file_exists(IMAGE_FOLDER . $this->image);
        if ($archiveExist) {
            unlink(IMAGE_FOLDER . $this->image);
        }
    }


    public static function getAll()
    {
        $query = "SELECT * FROM properties";

        $result = self::sqlConsult($query);

        return $result;
    }

    public static function getPropertie($id)
    {
        $query = "SELECT * FROM properties WHERE id = ${id}";
        $result = self::sqlConsult($query);
        return array_shift($result);
    }

    public static function sqlConsult($query)
    {
        //Consultar la base de datos
        $result = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while ($register = $result->fetch_assoc()) {
            $array[] = self::createObject($register);
        }

        //Liberar la memoria
        $result->free();


        //retornar los resultados
        return $array;
    }


    protected static function createObject($register)
    {
        $object = new self;

        foreach ($register as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }


    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sync($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}

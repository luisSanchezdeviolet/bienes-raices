<?php


namespace App;


class ActiveRecord {
    
    //Base de datos
    protected static $db;
    protected static $columnsDb = [];
    protected static $table = '';

    //Errores
    protected static $errors = [];

    

    


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
        $query = "INSERT INTO ". static::$table ." (";
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
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE ". static::$table . " SET ";
        $query .= join(', ', $values);
        $query .= "WHERE id ='" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1";

        $result = self::$db->query($query);

        if ($result) {
            //Redireccionar al usuario
            header('Location: ../index.php?result=2');
        }
    }

    //Eliminar registro
    public function delete()
    {
        $query = "DELETE FROM ". static::$table ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
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
        foreach (static::$columnsDb as $column) {
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

    public static function getErrors()
    {
        
        return static::$errors;
    }

    public function validate()
    {
        
        static::$errors = [];
        return static::$errors;
    }


    public function setImage($image)
    {
        //Elimina imagen previa
        if (!is_null($this->id)) {
            $this->imageDelete($image);
        }


        if ($image) {
            $this->imagen = $image;
        }
    }

    //Elimina el archivo
    public function imageDelete()
    {
        
        //Comprobar si existe el archivo
        $archiveExist = is_file(IMAGE_FOLDER . $this->imagen);
        if ($archiveExist) {
            unlink(IMAGE_FOLDER . $this->imagen);
        }
    }


    public static function getAll()
    {
        $query = "SELECT * FROM ".static::$table;

        $result = self::sqlConsult($query);

        return $result;
    }

    public static function getPropertie($id)
    {
        $query = "SELECT * FROM ". static::$table ." WHERE id = ${id}";
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
            $array[] = static::createObject($register);
        }

        //Liberar la memoria
        $result->free();


        //retornar los resultados
        return $array;
    }


    protected static function createObject($register)
    {
        $object = new static;

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
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
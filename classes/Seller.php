<?php


namespace App;

class Seller extends ActiveRecord {
    protected static $table = 'sellers';
    protected static $columnsDb = ['id', 'name', 'last_name', 'phone'];

    public $id;
    public $name;
    public $last_name;
    public $phone;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->phone = $args['phone'] ?? '';
        
    }

    
}
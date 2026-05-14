<?php

namespace App;


class Propertie extends ActiveRecord
{
    protected static $table = 'properties';
    protected static $columnsDb = ['id', 'title', 'price', 'image', 'description', 'rooms', 'wc', 'parking', 'date', 'sellers_id'];


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
}

<?php

namespace models;

class Combo extends Main
{
    public static $table = 'combos';
    static $columnDB = ['id', 'name', 'description', 'price', 'active'];

    public $id;
    public $name;
    public $description;
    public $price;
    public $active;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

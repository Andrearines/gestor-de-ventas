<?php

namespace models;

class Role extends Main
{
    public static $table = 'roles';
    static $columnDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

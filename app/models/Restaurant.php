<?php

namespace models;

class Restaurant extends Main
{
    public static $table = 'restaurants';
    static $columnDB = ['id', 'name', 'contact_info'];

    public $id;
    public $name;
    public $contact_info;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }

}

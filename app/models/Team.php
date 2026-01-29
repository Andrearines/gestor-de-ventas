<?php

namespace models;

class Team extends Main
{
    public static $table = 'teams';
    static $columnDB = ['id', 'name', 'event_id', 'created_at'];

    public $id;
    public $name;
    public $event_id;
    public $created_at;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

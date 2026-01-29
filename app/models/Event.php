<?php

namespace models;

class Event extends Main
{
    public static $table = 'events';
    static $columnDB = ['id', 'name', 'code', 'school_name', 'start_date', 'end_date', 'status', 'created_at'];

    public $id;
    public $name;
    public $code;
    public $school_name;
    public $start_date;
    public $end_date;
    public $status;
    public $created_at;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

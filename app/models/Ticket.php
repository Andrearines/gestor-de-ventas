<?php

namespace models;

class Ticket extends Main
{
    public static $table = 'tickets';
    static $columnDB = ['id', 'event_id', 'number', 'status', 'assigned_to', 'created_at'];

    public $id;
    public $event_id;
    public $number;
    public $status;
    public $assigned_to;
    public $created_at;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

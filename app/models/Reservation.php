<?php

namespace models;

class Reservation extends Main
{
    public static $table = 'reservations';
    static $columnDB = ['id', 'sale_id', 'customer_name', 'status', 'created_at'];

    public $id;
    public $sale_id;
    public $customer_name;
    public $status;
    public $created_at;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

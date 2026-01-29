<?php

namespace models;

class Sale extends Main
{
    public static $table = 'sales';
    static $columnDB = ['id', 'user_id', 'event_id', 'ticket_id', 'combo_id', 'amount', 'source', 'sale_date'];

    public $id;
    public $user_id;
    public $event_id;
    public $ticket_id;
    public $combo_id;
    public $amount;
    public $source;
    public $sale_date;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

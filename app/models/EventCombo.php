<?php

namespace models;

class EventCombo extends Main
{
    public static $table = 'event_combos';
    static $columnDB = ['id', 'event_id', 'combo_id', 'price_override'];

    public $id;
    public $event_id;
    public $combo_id;
    public $price_override;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

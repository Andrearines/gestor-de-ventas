<?php

namespace models;

class EventRestaurant extends Main
{
    public static $table = 'event_restaurants';
    static $columnDB = ['id', 'event_id', 'restaurant_id'];

    public $id;
    public $event_id;
    public $restaurant_id;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }
}

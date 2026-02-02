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
    public function Validate()
    {
        self::$errors = [];
        if (!$this->event_id) {
            self::$errors["error"][] = "El evento es obligatorio";
        }
        if (!$this->restaurant_id) {
            self::$errors["error"][] = "El restaurante es obligatorio";
        }
        return self::$errors;
    }
}

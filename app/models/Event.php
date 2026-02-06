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


    public function __construct($args = [])
    {
        parent::__construct($args);
    }

    public function Validate()
    {
        self::$errors = [];
        if (!$this->name) {
            self::$errors["error"][] = 'El nombre es obligatorio';
        }
        if (!$this->code) {
            self::$errors["error"][] = 'El código es obligatorio';
        }
        if (!$this->school_name) {
            self::$errors["error"][] = 'El nombre de la escuela es obligatorio';
        }
        if (!$this->start_date) {
            self::$errors["error"][] = 'La fecha de inicio es obligatoria';
        }
        if (!$this->end_date) {
            self::$errors["error"][] = 'La fecha de fin es obligatoria';
        }
        if (!$this->status) {
            $this->status = 0;
        }
        return self::$errors;
    }

    public function getTotalTickets()
    {
        $query = "SELECT COUNT(*) as total FROM tickets WHERE event_id = ?";
        // Use direct query since SQL() returns objects of the current class
        $result = self::$db->prepare($query);
        $result->bind_param("i", $this->id);
        $result->execute();
        $res = $result->get_result()->fetch_assoc();
        return (int) ($res['total'] ?? 0);
    }

    public function getSoldTickets()
    {
        $query = "SELECT COUNT(*) as total FROM tickets WHERE event_id = ? AND status = 'sold'";
        $result = self::$db->prepare($query);
        $result->bind_param("i", $this->id);
        $result->execute();
        $res = $result->get_result()->fetch_assoc();
        return (int) ($res['total'] ?? 0);
    }
}

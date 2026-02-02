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

    public function __construct($args = [])
    {
        parent::__construct($args);
    }

    public function Validate()
    {
        $alertas = [];

        if (empty($this->event_id)) {
            $alertas["error"]["event_id"] = "El evento es obligatorio";
        }

        if (empty($this->number)) {
            $alertas["error"][] = "El número es obligatorio";
        }

        if (empty($this->status)) {
            $alertas["error"][] = "El estado es obligatorio";
        }

        if (empty($this->assigned_to)) {
            $alertas["error"][] = "El responsable es obligatorio";
        }

        return $alertas;
    }

    public static function createTickets($event_id, $total)
    {
        for ($i = 1; $i <= $total; $i++) {
            $ticket = new self([
                'event_id' => $event_id,
                'number' => $i,
                'status' => 'available', // O el estado inicial que prefieras
                'assigned_to' => null
            ]);
            $ticket->save();
        }
    }
}

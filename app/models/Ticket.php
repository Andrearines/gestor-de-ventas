<?php

namespace models;

class Ticket extends Main
{
    public static $table = 'tickets';
    static $columnDB = ['id', 'event_id', 'number', 'status', "assigned_to"];

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


        return $alertas;
    }

    public static function createTickets($event_id, $total)
    {
        for ($i = 1; $i <= $total; $i++) {
            $ticket = new self([
                'event_id' => $event_id,
                'number' => $i,
                'status' => 'available',
                'assigned_to' => null
            ]);
            $ticket->save();
        }
    }

    public static function syncTickets($event_id, $newTotal)
    {
        $currentTickets = self::findAllBy('event_id', $event_id);
        $currentTotal = count($currentTickets);

        if ($newTotal > $currentTotal) {
            // Añadir los que faltan
            for ($i = $currentTotal + 1; $i <= $newTotal; $i++) {
                $ticket = new self([
                    'event_id' => $event_id,
                    'number' => $i,
                    'status' => 'available',
                    'assigned_to' => null
                ]);
                $ticket->save();
            }
        } elseif ($newTotal < $currentTotal) {
            // Eliminar el exceso (empezando por los números más altos)
            $diff = $currentTotal - $newTotal;
            $query = "DELETE FROM tickets WHERE event_id = ? AND status = 'available' ORDER BY number DESC LIMIT ?";
            $stmt = self::$db->prepare($query);
            $stmt->bind_param("ii", $event_id, $diff);
            $stmt->execute();
        }
    }
}

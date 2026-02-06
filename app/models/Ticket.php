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
        error_log("Iniciando creación de $total tickets para evento $event_id");
        for ($i = 1; $i <= $total; $i++) {
            $ticket = new self([
                'event_id' => $event_id,
                'number' => $i,
                'status' => 'available',
                'assigned_to' => null
            ]);
            if (!$ticket->save()) {
                error_log("Fallo al guardar ticket número $i para evento $event_id");
            }
        }
    }

    public static function syncTickets($event_id, $newTotal)
    {
        error_log("Sincronizando tickets para evento $event_id. Nuevo total: $newTotal");
        $currentTickets = self::findAllBy('event_id', $event_id);
        $currentTotal = count($currentTickets);
        error_log("Total actual: $currentTotal");

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
            error_log("Eliminando $diff tickets de exceso");
            $query = "DELETE FROM tickets WHERE event_id = ? AND status = 'available' ORDER BY number DESC LIMIT ?";
            $stmt = self::$db->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ii", $event_id, $diff);
                $stmt->execute();
                $stmt->close();
            } else {
                error_log("Error al preparar DELETE en syncTickets: " . self::$db->error);
            }
        }
    }

    public static function autoAssignByEvent($eventId)
    {
        error_log("Auto-asignando tickets para el evento $eventId");

        // 1. Obtener todos los miembros de equipos asociados al evento
        $queryMembers = "SELECT DISTINCT tm.user_id FROM team_members tm 
                         JOIN teams t ON tm.team_id = t.id 
                         WHERE t.event_id = ?";
        $stmt = self::$db->prepare($queryMembers);
        $members = [];
        if ($stmt) {
            $stmt->bind_param("i", $eventId);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $members[] = $row['user_id'];
            }
            $stmt->close();
        }

        // 2. Obtener todos los tickets disponibles del evento
        $availableTickets = self::SQL("SELECT * FROM tickets WHERE event_id = ? AND status = 'available' ORDER BY number ASC", [$eventId], "i");
        $totalTickets = count($availableTickets);

        // 3. Resetear asignaciones para los tickets disponibles
        $queryReset = "UPDATE tickets SET assigned_to = NULL WHERE event_id = ? AND status = 'available'";
        $stmtReset = self::$db->prepare($queryReset);
        if ($stmtReset) {
            $stmtReset->bind_param("i", $eventId);
            $stmtReset->execute();
            $stmtReset->close();
        }

        if (empty($members)) {
            error_log("No hay miembros para el evento $eventId. Tickets desasignados.");
            return;
        }

        $numMembers = count($members);
        error_log("Asignando $totalTickets tickets a $numMembers miembros");

        // 4. Distribuir equitativamente
        $ticketsPerMember = floor($totalTickets / $numMembers);
        $remainder = $totalTickets % $numMembers;

        $currentIndex = 0;
        foreach ($members as $index => $userId) {
            $batchSize = $ticketsPerMember + ($index < $remainder ? 1 : 0);
            if ($batchSize <= 0)
                continue;

            $batch = array_slice($availableTickets, $currentIndex, $batchSize);
            $currentIndex += $batchSize;

            $ticketIds = array_map(fn($t) => $t->id, $batch);
            $placeholders = implode(',', array_fill(0, count($ticketIds), '?'));

            $queryUpdate = "UPDATE tickets SET assigned_to = ? WHERE id IN ($placeholders)";
            $stmtUpdate = self::$db->prepare($queryUpdate);
            if ($stmtUpdate) {
                $stmtUpdate->bind_param(str_repeat('i', count($ticketIds) + 1), $userId, ...$ticketIds);
                $stmtUpdate->execute();
                $stmtUpdate->close();
            }
        }
    }
    public static function unassignAllFromUser($userId)
    {
        error_log("Limpiando todas las asignaciones del usuario $userId");
        $query = "UPDATE tickets SET assigned_to = NULL WHERE assigned_to = ?";
        $stmt = self::$db->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->close();
            return true;
        }
        return false;
    }
}

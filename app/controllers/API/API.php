<?php

namespace controllers\API;

use models\Event;

class API
{
    public static function deleteEvent()
    {
        $id = json_decode(file_get_contents('php://input'))->id ?? null;

        if (!$id) {
            echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $auth = $_SESSION['rol'] ?? '';
        if ($auth !== 'admin') {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'No autorizado']);
            return;
        }

        $evento = Event::find($id);
        if (!$evento) {
            echo json_encode(['success' => false, 'error' => 'Evento no encontrado']);
            return;
        }

        // Al tener ON DELETE CASCADE en la BD, este comando 
        // borrará automáticamente tickets y relaciones.
        if ($evento->delete($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se pudo eliminar el evento']);
        }
    }

    //grupos y miembros

}
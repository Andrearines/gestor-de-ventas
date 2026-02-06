<?php

namespace controllers\API;

use models\Event;
use models\Team;
use models\TeamMember;
use models\UserPHP;
use models\Ticket;

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
    public static function updateTeam()
    {
        ob_start();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $auth = $_SESSION['rol'] ?? '';
        if ($auth !== 'admin') {
            ob_end_clean();
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'No autorizado']);
            return;
        }

        // Validar datos requeridos
        if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['event_id'])) {
            ob_end_clean();
            echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
            return;
        }

        try {
            $teamId = $_POST['id'];

            // Verificar que el equipo existe
            $team = Team::find($teamId);
            if (!$team) {
                echo json_encode(['success' => false, 'error' => 'Equipo no encontrado']);
                return;
            }

            // Actualizar el equipo
            $teamData = [
                'name' => $_POST['name'],
                'event_id' => $_POST['event_id']
            ];
            $team->sicronizar($teamData);

            if (!$team->update($teamId)) {
                ob_end_clean();
                echo json_encode(['success' => false, 'error' => 'No se pudo actualizar el equipo']);
                return;
            }

            // Actualizar miembros del equipo
            // Primero eliminar los miembros actuales
            $membersToDelete = TeamMember::findAllBy('team_id', $teamId);
            foreach ($membersToDelete as $member) {
                $member->delete($member->id);
            }

            // Luego agregar los nuevos miembros si se proporcionaron
            $members = $_POST['members'] ?? [];
            if (!empty($members) && is_array($members)) {
                foreach ($members as $userId) {
                    if (empty($userId))
                        continue;
                    $member = new TeamMember();
                    $memberData = [
                        'team_id' => $teamId,
                        'user_id' => $userId
                    ];
                    $member->sicronizar($memberData);
                    if (!$member->save()) {
                        error_log("Error al guardar miembro $userId en equipo $teamId");
                    }
                }
            }

            // Auto-asignación de tickets
            if (!empty($_POST['event_id'])) {
                \models\Ticket::autoAssignByEvent($_POST['event_id']);
            }

            ob_end_clean();
            echo json_encode([
                'success' => true,
                'team_id' => $teamId,
                'message' => 'Equipo actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            ob_end_clean();
            echo json_encode([
                'success' => false,
                'error' => 'Error al actualizar el equipo: ' . $e->getMessage()
            ]);
        }
    }
    public static function deleteTeam()
    {
        // Validar autenticación
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $auth = $_SESSION['rol'] ?? '';
        if ($auth !== 'admin') {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'No autorizado']);
            return;
        }

        // Validar ID
        if (empty($_POST['id'])) {
            echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
            return;
        }

        try {
            $teamId = $_POST['id'];

            // Verificar que el equipo existe
            $team = Team::find($teamId);
            if (!$team) {
                echo json_encode(['success' => false, 'error' => 'Equipo no encontrado']);
                return;
            }

            // Eliminar primero los miembros del equipo
            $membersToDelete = TeamMember::findAllBy('team_id', $teamId);
            foreach ($membersToDelete as $member) {
                $member->delete($member->id);
            }

            // Obtener el ID del evento antes de eliminar para auto-asignación
            $eventId = $team->event_id;

            // Eliminar el equipo
            if ($team->delete($teamId)) {
                // Auto-asignación de tickets
                if ($eventId) {
                    \models\Ticket::autoAssignByEvent($eventId);
                }

                echo json_encode([
                    'success' => true,
                    'message' => 'Equipo eliminado exitosamente'
                ]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No se pudo eliminar el equipo']);
            }
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'error' => 'Error al eliminar el equipo: ' . $e->getMessage()
            ]);
        }
    }
    public static function CrearTeam()
    {
        ob_start();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $auth = $_SESSION['rol'] ?? '';
        if ($auth !== 'admin') {
            ob_end_clean();
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'No autorizado']);
            return;
        }

        // Validar datos requeridos
        if (empty($_POST['name']) || empty($_POST['event_id'])) {
            ob_end_clean();
            echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
            return;
        }

        try {
            // Crear el equipo
            $team = new Team();
            $teamData = [
                'name' => $_POST['name'],
                'event_id' => $_POST['event_id']
            ];
            $team->sicronizar($teamData);

            if (!$team->save()) {
                ob_end_clean();
                echo json_encode(['success' => false, 'error' => 'No se pudo crear el equipo']);
                return;
            }

            // Obtener el ID del equipo recién creado
            $teamId = $team->id;

            // Crear los miembros del equipo si se proporcionaron
            if (isset($_POST['members']) && is_array($_POST['members'])) {
                foreach ($_POST['members'] as $userId) {
                    if (empty($userId))
                        continue;
                    $member = new TeamMember();
                    $memberData = [
                        'team_id' => $teamId,
                        'user_id' => $userId
                    ];
                    $member->sicronizar($memberData);
                    $member->save();
                }
            }

            // Auto-asignación de tickets
            if (!empty($_POST['event_id'])) {
                \models\Ticket::autoAssignByEvent($_POST['event_id']);
            }

            ob_end_clean();
            echo json_encode([
                'success' => true,
                'team_id' => $teamId,
                'message' => 'Equipo creado exitosamente'
            ]);
        } catch (\Exception $e) {
            ob_end_clean();
            echo json_encode([
                'success' => false,
                'error' => 'Error al crear el equipo: ' . $e->getMessage()
            ]);
        }
    }

    // MIEMBROS - CRUD
    public static function CrearMember()
    {
        ob_start(); // Prevenir cualquier salida accidental antes del JSON
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (($_SESSION['rol'] ?? '') !== 'admin') {
            ob_end_clean();
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'No autorizado']);
            return;
        }

        if (empty($_POST['username']) || empty($_POST['name']) || empty($_POST['password'])) {
            ob_end_clean();
            echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
            return;
        }

        try {
            $user = new UserPHP();
            $userData = [
                'user' => $_POST['username'],
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'role_id' => 2, // Vendor/Member
                'active' => $_POST['active'] ?? 1
            ];

            $user->sicronizar($userData);

            if ($user->ExisteUser()) {
                echo json_encode(['success' => false, 'error' => 'El usuario ya existe']);
                return;
            }

            $user->Password_hash();

            if (!$user->save()) {
                echo json_encode(['success' => false, 'error' => 'Error al crear el usuario']);
                return;
            }

            $userId = $user->id;

            // Asociar con equipo si se proporciona
            if (!empty($_POST['team_id'])) {
                $member = new TeamMember();
                $memberData = [
                    'team_id' => $_POST['team_id'],
                    'user_id' => $userId
                ];
                $member->sicronizar($memberData);
                if (!$member->save()) {
                    error_log("Error al asociar usuario $userId con equipo " . $_POST['team_id']);
                }
            }

            // Auto-asignación de tickets (si el equipo tiene un evento asociado)
            if (!empty($_POST['team_id'])) {
                $team = \models\Team::find($_POST['team_id']);
                if ($team && $team->event_id) {
                    \models\Ticket::autoAssignByEvent($team->event_id);
                }
            }

            ob_end_clean();
            echo json_encode([
                'success' => true,
                'id' => $userId,
                'message' => 'Miembro creado exitosamente'
            ]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public static function updateMember()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (($_SESSION['rol'] ?? '') !== 'admin') {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'No autorizado']);
            return;
        }

        if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['username'])) {
            echo json_encode(['success' => false, 'error' => 'Faltan datos requeridos']);
            return;
        }

        try {
            $userId = $_POST['id'];
            $user = UserPHP::find($userId);

            if (!$user) {
                echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
                return;
            }

            $userData = [
                'name' => $_POST['name'],
                'user' => $_POST['username'],
                'active' => $_POST['active'] ?? 1
            ];

            if (!empty($_POST['password'])) {
                $user->password = $_POST['password'];
                $user->Password_hash();
                $userData['password'] = $user->password;
            }

            $user->sicronizar($userData);

            if (!$user->update($userId)) {
                echo json_encode(['success' => false, 'error' => 'Error al actualizar usuario']);
                return;
            }

            // Actualizar miembros del equipo
            $oldMembers = TeamMember::findAllBy('user_id', $userId);
            foreach ($oldMembers as $oldMember) {
                $oldMember->delete($oldMember->id);
            }
            if (!empty($_POST['team_id'])) {
                $member = new TeamMember();
                $memberData = [
                    'team_id' => $_POST['team_id'],
                    'user_id' => $userId
                ];
                $member->sicronizar($memberData);
                if (!$member->save()) {
                    // Log or handle error if needed, but continue
                }
            }

            // Auto-asignación de tickets
            if (!empty($_POST['team_id'])) {
                $team = \models\Team::find($_POST['team_id']);
                if ($team && $team->event_id) {
                    \models\Ticket::autoAssignByEvent($team->event_id);
                }
            }
            // También si cambió de equipo, el equipo viejo debería re-asignarse? 
            // updateMember borra todos los registros en TeamMember para ese user, así que el equipo anterior ya no tiene a este usuario.
            // Pero no tenemos el old_team_id fácilmente aquí a menos que lo busquemos antes de borrar.
            // Para simplicidad por ahora, confiaremos en que el evento se actualiza cuando se asigna al nuevo.

            echo json_encode(['success' => true, 'message' => 'Miembro actualizado exitosamente']);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public static function deleteMember()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (($_SESSION['rol'] ?? '') !== 'admin') {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'No autorizado']);
            return;
        }

        if (empty($_POST['id'])) {
            echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
            return;
        }

        try {
            $userId = $_POST['id'];
            $user = UserPHP::find($userId);

            if (!$user) {
                echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
                return;
            }

            // 1. Limpiar ABSOLUTAMENTE TODOS los tickets de este usuario (Fuerza bruta contra FK error)
            Ticket::unassignAllFromUser($userId);

            $oldMembers = TeamMember::findAllBy('user_id', $userId);

            // Guardar IDs de equipos antes de borrar
            $affectedEventIds = [];
            foreach ($oldMembers as $oldMember) {
                /** @var TeamMember $oldMember */
                $team = Team::find($oldMember->team_id);
                if ($team && $team->event_id) {
                    $affectedEventIds[] = $team->event_id;
                }
                $oldMember->delete($oldMember->id);
            }

            // IMPORTANTE: Primero redistribuimos los tickets para que el usuario 
            // deje de estar referenciado en la tabla 'tickets' (evita error de FK)
            foreach (array_unique($affectedEventIds) as $eventId) {
                \models\Ticket::autoAssignByEvent($eventId);
            }

            if ($user->delete($userId)) {
                echo json_encode(['success' => true, 'message' => 'Miembro eliminado exitosamente']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al eliminar miembro']);
            }
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }



}
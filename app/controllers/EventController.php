<?php

namespace controllers;
use MVC\Router;
use models\Event;
use models\EventRestaurant;
use models\Restaurant;
use models\Ticket;
use models\Sale;

class EventController
{
    public static function index(Router $router)
    {
        $eventos = Event::all();
        $events = [];

        foreach ($eventos as $evento) {
            $events[] = [
                'id' => $evento->id,
                'nombre' => $evento->name,
                'fecha' => $evento->end_date,
                'ubicacion' => $evento->school_name,
                'total_boletos' => $evento->getTotalTickets(),
                'boletos_vendidos' => $evento->getSoldTickets(),
                'status' => match ($evento->status) {
                    '1', 'activo' => 'activo',
                    '0', 'inactivo' => 'inactivo',
                    default => 'inactivo'
                }
            ];
        }

        $saleStats = Sale::getStats();

        $stats = [
            'activos' => count(Event::findAllBy('status', 1)) + count(Event::findAllBy('status', 0)),
            'boletos_vendidos' => $saleStats['boletos_vendidos'],
            'ingresos' => $saleStats['ingresos']
        ];

        // Verificar si hay alertas
        $alert = [];
        if (isset($_GET['created'])) {
            $alert['success'][] = 'El evento ha sido creado correctamente.';
        } elseif (isset($_GET['deleted'])) {
            $alert['success'][] = 'El evento ha sido eliminado correctamente.';
        } elseif (isset($_GET['updated'])) {
            $alert['success'][] = 'El evento ha sido actualizado correctamente.';
        }



        $breadcrumbs = [
            ['label' => 'Admin', 'url' => '/admin/dashboard'],
            ['label' => 'Eventos']
        ];

        $router->view('admin/events/index.php', [
            'titulo' => 'Gestión de Eventos',
            'currentPage' => 'events',
            'events' => $events,
            'stats' => $stats,
            'alert' => $alert,
            'breadcrumbs' => $breadcrumbs,
            'script' => ['pages/admin/events/events']
        ], 'admin');
    }

    public static function create(Router $router)
    {
        $alertas = [];
        $restaurants = Restaurant::all();
        $Event_Restaurant = 0;
        $eventTickets = 0;

        $event = new Event();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Event_Restaurant = $_POST["restaurant_id"];
            $eventTickets = (int) $_POST["total_boletos"];

            $event->sicronizar($_POST);
            Event::clearErrors();
            $alertas = $event->Validate();

            if (empty($Event_Restaurant)) {
                $alertas["error"][] = "Seleccione un restaurante";
            }

            if ($eventTickets <= 0) {
                $alertas["error"][] = "Número de boletos no válido";
            }

            if (empty($alertas)) {
                $restaurant = Restaurant::find($Event_Restaurant);
                if (empty($restaurant)) {
                    $alertas["error"][] = "El restaurante no existe";
                } else {
                    $event_id = $event->save();
                    if ($event_id) {
                        $event_id = (int) $event_id; // Asegurar que sea entero
                        $eventRestaurant = new EventRestaurant([
                            "event_id" => $event_id,
                            "restaurant_id" => $Event_Restaurant,
                            "assigned_to" => $_SESSION['id']
                        ]);
                        $eventRestaurant->save();

                        // Crear los boletos automáticamente
                        if ($eventTickets > 0) {
                            Ticket::createTickets($event_id, $eventTickets);
                        }

                        header('Location: /admin/events?created=1');
                        exit;
                    } else {
                        $alertas["error"][] = "Error al guardar el evento";
                    }
                }
            }
        }

        $router->view('admin/events/create.php', [
            'titulo' => 'Crear Nuevo Evento',
            'currentPage' => 'events',
            'alertas' => $alertas,
            'event' => $event,
            'Event_Restaurant' => $Event_Restaurant,
            'restaurants' => $restaurants
        ], 'admin');
    }

    public static function edit(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin/events');
            exit;
        }

        $alertas = [];
        $restaurants = Restaurant::all();
        $event = Event::find($id);

        if (!$event) {
            header('Location: /admin/events');
            exit;
        }

        // Obtener datos actuales para rellenar el formulario
        $eventRestaurantRecord = EventRestaurant::findBy("event_id", $id);
        $Event_Restaurant = $eventRestaurantRecord ? $eventRestaurantRecord->restaurant_id : 0;

        $tickets = Ticket::findAllBy("event_id", $id);
        $eventTickets = count($tickets);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Event_Restaurant = $_POST["restaurant_id"];
            $eventTickets = (int) $_POST["total_boletos"];

            $event->sicronizar($_POST);
            Event::clearErrors();
            $alertas = $event->Validate();

            if (empty($Event_Restaurant)) {
                $alertas["error"][] = "Seleccione un restaurante";
            }

            if ($eventTickets <= 0) {
                $alertas["error"][] = "Número de boletos no válido";
            }

            if (empty($alertas)) {
                $restaurant = Restaurant::find($Event_Restaurant);
                if (empty($restaurant)) {
                    $alertas["error"][] = "El restaurante no existe";
                } else {
                    if ($event->update($id)) {
                        // Actualizar o crear relación con restaurante
                        if ($eventRestaurantRecord) {
                            $eventRestaurantRecord->restaurant_id = $Event_Restaurant;
                            $eventRestaurantRecord->update($eventRestaurantRecord->id);
                        } else {
                            $newER = new EventRestaurant([
                                "event_id" => $id,
                                "restaurant_id" => $Event_Restaurant
                            ]);
                            $newER->save();
                        }

                        // Sincronizar los boletos
                        Ticket::syncTickets($id, $eventTickets);

                        // Auto-asignación de tickets
                        Ticket::autoAssignByEvent($id);

                        header('Location: /admin/events?updated=1');
                        exit;
                    } else {
                        $alertas["error"][] = "Error al actualizar el evento";
                    }
                }
            }
        }

        $router->view('admin/events/edit.php', [
            'titulo' => 'Editar Evento',
            'currentPage' => 'events',
            'event' => $event,
            'alertas' => $alertas,
            'restaurants' => $restaurants,
            'Event_Restaurant' => $Event_Restaurant,
            'eventTickets' => $eventTickets,
            'script' => ['pages/admin/events/events']
        ], 'admin');
    }
}

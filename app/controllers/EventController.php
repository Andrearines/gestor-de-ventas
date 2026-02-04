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
                'status' => ($evento->status == '1' || $evento->status == 'activo') ? 'activo' : 'finalizado'
            ];
        }

        $saleStats = Sale::getStats();

        $stats = [
            'activos' => count(Event::findAllBy('status', 'activo')) + count(Event::findAllBy('status', '1')),
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

        if (empty($eventRestaurants)) {
            $alertas["error"][] = "seleccione un restaurante";
        }

        if (empty($eventTickets) || $eventTickets <= 0) {
            $alertas["error"][] = "numero de voletos no validos";
        }

        $event = new Event();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Event_Restaurant = $_POST["restaurant_id"];
            $eventTickets = $_POST["total_boletos"];
            $event->sicronizar($_POST);
            $alertas = $event->Validate();

            if ($_POST["restaurant_id"]) {
                $restaurant = Restaurant::find($_POST["restaurant_id"]);
                if (empty($restaurant)) {
                    $alertas["error"][] = "El restaurante no existe";
                } else {
                    $restaurant_id = $_POST["restaurant_id"];

                    if (empty($alertas)) {
                        $event_id = $event->save();
                        $eventRestautant = new EventRestaurant([
                            "event_id" => $event_id,
                            "restaurant_id" => $restaurant_id
                        ]);
                        $alertas = $eventRestautant->Validate();
                        if (empty($alertas)) {
                            $eventRestautant->save();

                            // Crear los boletos automáticamente
                            if (isset($eventTickets) && $eventTickets > 0) {
                                Ticket::createTickets($event_id, $eventTickets);
                            }

                            header('Location: /admin/events?created=1');
                        }
                    }
                }
            } else {
                $alertas["error"][] = "El restaurante no existe";
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

        $alertas = [];
        $restaurants = Restaurant::all();
        $Event_Restaurant = EventRestaurant::findBy("event_id", $id);
        $eventTickets = Ticket::findAllBy("event_id", $id);
        $eventTickets = count($eventTickets);

        if (empty($Event_Restaurant)) {
            $alertas["error"][] = "seleccione un restaurante";
        }

        if (empty($eventTickets) || $eventTickets <= 0) {
            $alertas["error"][] = "numero de voletos no validos";
        }

        $event = Event::find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Event_Restaurant = $_POST["restaurant_id"];
            $eventTickets = $_POST["total_boletos"];
            $event->sicronizar($_POST);
            $alertas = $event->Validate();

            if ($_POST["restaurant_id"]) {
                $restaurant = Restaurant::find($_POST["restaurant_id"]);
                if (empty($restaurant)) {
                    $alertas["error"][] = "El restaurante no existe";
                } else {
                    $restaurant_id = $_POST["restaurant_id"];

                    if (empty($alertas)) {
                        $event->update();
                        $eventRestautant = EventRestaurant::findBy("event_id", $id);
                        if ($eventRestautant) {
                            $eventRestautant->restaurant_id = $restaurant_id;
                            $eventRestautant->update();
                        } else {
                            $eventRestautant = new EventRestaurant([
                                "event_id" => $id,
                                "restaurant_id" => $restaurant_id
                            ]);
                            $eventRestautant->save();
                        }

                        // Sincronizar los boletos
                        if (isset($eventTickets) && $eventTickets >= 0) {
                            Ticket::syncTickets($id, $eventTickets);
                        }

                        header('Location: /admin/events?updated=1');
                    }
                }
            } else {
                $alertas["error"][] = "El restaurante no existe";
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

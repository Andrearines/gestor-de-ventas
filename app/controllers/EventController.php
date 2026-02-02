<?php

namespace controllers;
use MVC\Router;
use models\Event;
use models\EventRestaurant;
use models\Restaurant;
use models\Ticket;

class EventController
{
    public static function index(Router $router)
    {
        // Datos manuales de ejemplo
        $events = [
            [
                'id' => 1,
                'nombre' => 'Recaudación Escuela Norte',

                'fecha' => '2023-10-25',

                'ubicacion' => 'Auditorio Municipal',
                'total_boletos' => 500,
                'boletos_vendidos' => 350,

                'status' => 'activo'
            ],
            [
                'id' => 2,
                'nombre' => 'Festival de Jazz',

                'fecha' => '2023-11-15',

                'ubicacion' => 'Parque Central',
                'total_boletos' => 1000,
                'boletos_vendidos' => 850,

                'status' => 'activo'
            ],
            [
                'id' => 3,
                'nombre' => 'Torneo Benéfico de Fútbol',

                'fecha' => '2023-09-10',

                'ubicacion' => 'Estadio Local',
                'total_boletos' => 2000,
                'boletos_vendidos' => 2000,

                'status' => 'finalizado'
            ]
        ];

        $stats = [
            'activos' => 2,
            'boletos_vendidos' => 1200,
            'ingresos' => 119500.00
        ];

        // Verificar si hay alertas
        $alert = [];
        if (isset($_GET['created'])) {
            $alert['success'][] = 'El evento ha sido creado correctamente.';
        } elseif (isset($_GET['deleted'])) {
            $alert['success'][] = 'El evento ha sido eliminado correctamente.';
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
            'restaurants' => $restaurants
        ], 'admin');
    }

    public static function edit(Router $router)
    {
        $id = $_GET['id'] ?? null;

        // Simulamos obtener el evento de la base de datos
        $event = [
            'id' => $id,
            'nombre' => 'Recaudación Escuela Norte',
            'categoria' => 'Cultural',
            'fecha' => '2023-10-25',
            'hora' => '18:00',
            'ubicacion' => 'Auditorio Municipal',
            'total_boletos' => 500,
            'boletos_vendidos' => 350,
            'precio_boleto' => 50.00,
            'status' => 'activo'
        ];

        $breadcrumbs = [
            ['label' => 'Admin', 'url' => '/admin/dashboard'],
            ['label' => 'Eventos', 'url' => '/admin/events'],
            ['label' => 'Editar Evento']
        ];

        $router->view('admin/events/edit.php', [
            'titulo' => 'Editar Evento',
            'currentPage' => 'events',
            'event' => $event,
            'breadcrumbs' => $breadcrumbs,
            'script' => ['pages/admin/events/events']
        ], 'admin');
    }


}

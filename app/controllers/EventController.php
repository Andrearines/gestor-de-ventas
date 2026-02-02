<?php

namespace controllers;

use MVC\Router;

class EventController
{
    public static function index(Router $router)
    {
        // Datos manuales de ejemplo
        $events = [
            [
                'id' => 1,
                'nombre' => 'Recaudación Escuela Norte',
                'categoria' => 'Cultural',
                'fecha' => '2023-10-25',
                'hora' => '18:00',
                'ubicacion' => 'Auditorio Municipal',
                'total_boletos' => 500,
                'boletos_vendidos' => 350,
                'precio_boleto' => 50.00,
                'status' => 'activo'
            ],
            [
                'id' => 2,
                'nombre' => 'Festival de Jazz',
                'categoria' => 'Concierto',
                'fecha' => '2023-11-15',
                'hora' => '20:00',
                'ubicacion' => 'Parque Central',
                'total_boletos' => 1000,
                'boletos_vendidos' => 850,
                'precio_boleto' => 120.00,
                'status' => 'activo'
            ],
            [
                'id' => 3,
                'nombre' => 'Torneo Benéfico de Fútbol',
                'categoria' => 'Deportivo',
                'fecha' => '2023-09-10',
                'hora' => '10:00',
                'ubicacion' => 'Estadio Local',
                'total_boletos' => 2000,
                'boletos_vendidos' => 2000,
                'precio_boleto' => 30.00,
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
        $breadcrumbs = [
            ['label' => 'Admin', 'url' => '/admin/dashboard'],
            ['label' => 'Eventos', 'url' => '/admin/events'],
            ['label' => 'Crear Evento']
        ];

        $router->view('admin/events/create.php', [
            'titulo' => 'Crear Nuevo Evento',
            'currentPage' => 'events',
            'breadcrumbs' => $breadcrumbs
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

<?php

namespace controllers;

use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        // Variables placeholder para el dashboard
        $stats = [
            'ventas_totales' => 124500,
            'boletos_activos' => 3420,
            'combos_vendidos' => 850,
            'eventos_activos' => 12,
            'total_eventos' => 24,
            'top_sellers' => [
                ['name' => 'Ricardo Luna', 'initials' => 'RL', 'total' => '$12,450'],
                ['name' => 'Marta Martínez', 'initials' => 'MM', 'total' => '$8,960'],
                ['name' => 'Andrés Sosa', 'initials' => 'AS', 'total' => '$7,410'],
                ['name' => 'Carlos Pérez', 'initials' => 'CP', 'total' => '$5,230'],
            ],
            'recent_activity' => [
                ['type' => 'ticket', 'title' => 'Compra de Boleto #10234', 'event' => 'Concierto Coldplay', 'user' => 'Juan Perez', 'time' => 'Hace 5 min', 'amount' => '$1,200.00', 'status' => 'completed'],
                ['type' => 'combo', 'title' => 'Compra de Combo #5521', 'event' => 'Combo Pareja', 'user' => 'Maria Garcia', 'time' => 'Hace 23 min', 'amount' => '$450.00', 'status' => 'completed'],
                ['type' => 'event', 'title' => 'Actualización de Evento', 'event' => 'Festival de Jazz 2024', 'user' => 'Carlos Ruiz', 'time' => 'Hace 1 hora', 'amount' => '-', 'status' => 'pending'],
            ]
        ];

        $breadcrumbs = [
            ['label' => 'Admin'],
            ['label' => 'Dashboard']
        ];

        $router->view('admin/dashboard.php', [
            'titulo' => 'Dashboard',
            'currentPage' => 'dashboard',
            'stats' => $stats,
            'breadcrumbs' => $breadcrumbs,
            'script' => ['components/charts']
        ], 'admin');
    }

    public static function tickets(Router $router)
    {
        // Datos manuales de inventario de boletos
        $tickets = [
            ['id' => 1, 'numero' => 1001, 'evento' => 'Escuela Norte', 'vendedor' => 'Juan Pérez', 'status' => 'Vendido'],
            ['id' => 2, 'numero' => 1002, 'evento' => 'Escuela Norte', 'vendedor' => 'Juan Pérez', 'status' => 'Asignado'],
            ['id' => 3, 'numero' => 1003, 'evento' => 'Escuela Norte', 'vendedor' => 'Sin asignar', 'status' => 'Disponible'],
            ['id' => 4, 'numero' => 5001, 'evento' => 'Festival Jazz', 'vendedor' => 'Maria Garcia', 'status' => 'Perdido'],
            ['id' => 5, 'numero' => 1004, 'evento' => 'Escuela Norte', 'vendedor' => 'Ricardo Luna', 'status' => 'Vendido'],
            ['id' => 6, 'numero' => 1005, 'evento' => 'Escuela Norte', 'vendedor' => 'Ricardo Luna', 'status' => 'Asignado'],
        ];

        $stats = [
            'total' => 5000,
            'vendidos' => 1240,
            'disponibles' => 3650,
            'perdidos' => 110
        ];

        $breadcrumbs = [
            ['label' => 'Admin', 'url' => '/admin/dashboard'],
            ['label' => 'Boletos'],
            ['label' => 'Inventario']
        ];

        $router->view('admin/tickets/inventory.php', [
            'titulo' => 'Inventario de Boletos',
            'currentPage' => 'tickets',
            'tickets' => $tickets,
            'stats' => $stats,
            'breadcrumbs' => $breadcrumbs,
            'script' => ['pages/admin/tickets/inventory']
        ], 'admin');
    }

    public static function combos(Router $router)
    {
        // Datos manuales de combos
        $combos = [
            [
                'id' => 1,
                'nombre' => "Dave's Single® Combo",
                'descripcion' => 'Hamburguesa de cuarto de libra, papas medianas y refresco.',
                'precio' => 12.50,
                'stock' => 500,
                'vendidos' => 120,
                'status' => 'activo'
            ],
            [
                'id' => 2,
                'nombre' => "Combo Pareja Wendy's",
                'descripcion' => '2 Hamburguesas, 2 papas y 2 refrescos grandes.',
                'precio' => 22.00,
                'stock' => 300,
                'vendidos' => 85,
                'status' => 'activo'
            ],
            [
                'id' => 3,
                'nombre' => "Family Pack Special",
                'descripcion' => '4 Hamburguesas, nuggets, y bebida familiar.',
                'precio' => 35.00,
                'stock' => 100,
                'vendidos' => 15,
                'status' => 'inactivo'
            ]
        ];

        $breadcrumbs = [
            ['label' => 'Admin', 'url' => '/admin/dashboard'],
            ['label' => 'Productos'],
            ['label' => 'Combos']
        ];

        $router->view('admin/combos/index.php', [
            'titulo' => 'Gestión de Combos',
            'currentPage' => 'combos',
            'combos' => $combos,
            'breadcrumbs' => $breadcrumbs,
            "script" => ["pages/admin/combos/combos"]
        ], 'admin');
    }

    public static function teams(Router $router)
    {
        // Datos manuales de equipos (sin líder individual)
        $teams = [
            [
                'id' => 1,
                'nombre' => 'Equipo Alpha',
                'evento' => 'Wendy\'s Music Fest',
                'miembros' => 8,
                'ventas' => 12500.00,
                'incentivo' => 250.00,
                'status' => 'activo'
            ],
            [
                'id' => 2,
                'nombre' => 'Vendedores Centro',
                'evento' => 'Wendy\'s Music Fest',
                'miembros' => 5,
                'ventas' => 8960.00,
                'incentivo' => 150.00,
                'status' => 'activo'
            ],
            [
                'id' => 3,
                'nombre' => 'Equipo Poniente',
                'evento' => 'Cena Benéfica 2024',
                'miembros' => 4,
                'ventas' => 3200.00,
                'incentivo' => 50.00,
                'status' => 'en_pausa'
            ]
        ];

        // Lista de eventos para el modal
        $events = [
            ['id' => 1, 'nombre' => 'Wendy\'s Music Fest'],
            ['id' => 2, 'nombre' => 'Cena Benéfica 2024'],
            ['id' => 3, 'nombre' => 'Maratón Wendy\'s']
        ];

        // Lista de usuarios disponibles para ser miembros
        $members = [
            ['id' => 1, 'nombre' => 'Andrés Sosa'],
            ['id' => 2, 'nombre' => 'Marta Martínez'],
            ['id' => 3, 'nombre' => 'Carlos Pérez'],
            ['id' => 4, 'nombre' => 'Sofía López'],
            ['id' => 5, 'nombre' => 'Juan Rivas'],
            ['id' => 6, 'nombre' => 'Elena Giraldo'],
            ['id' => 7, 'nombre' => 'Ricardo Luna'],
            ['id' => 8, 'nombre' => 'Lucía Ferrán'],
            ['id' => 9, 'nombre' => 'Mateo Valencia'],
            ['id' => 10, 'nombre' => 'Daniela Castro'],
            ['id' => 11, 'nombre' => 'Roberto Gómez'],
            ['id' => 12, 'nombre' => 'Verónica Salas']
        ];

        $breadcrumbs = [
            ['label' => 'Admin', 'url' => '/admin/dashboard'],
            ['label' => 'Ventas'],
            ['label' => 'Equipos']
        ];

        $router->view('admin/teams/index.php', [
            'titulo' => 'Gestión de Equipos',
            'currentPage' => 'teams',
            'teams' => $teams,
            'events' => $events,
            'members' => $members,
            'breadcrumbs' => $breadcrumbs,
            "script" => ["pages/admin/teams/teams"]
        ], 'admin');
    }


    public static function sales(Router $router)
    {
        // Datos manuales de ventas globales (Admin)
        $sales = [
            ['id' => 1, 'vendedor' => 'Juan Pérez', 'evento' => 'Escuela Norte', 'monto' => 1200.00, 'fecha' => '2024-10-28'],
            ['id' => 2, 'vendedor' => 'Maria Garcia', 'evento' => 'Festival Jazz', 'monto' => 450.00, 'fecha' => '2024-10-28'],
            ['id' => 3, 'vendedor' => 'Ricardo Luna', 'evento' => 'Escuela Norte', 'monto' => 750.00, 'fecha' => '2024-10-27'],
        ];

        $breadcrumbs = [
            ['label' => 'Admin', 'url' => '/admin/dashboard'],
            ['label' => 'Ventas']
        ];

        $router->view('admin/sales/index.php', [
            'titulo' => 'Reporte de Ventas',
            'currentPage' => 'sales',
            'sales' => $sales,
            'breadcrumbs' => $breadcrumbs
        ], 'admin');
    }

    public static function reservations(Router $router)
    {
        // Datos manuales de todas las reservas
        $reservations = [
            ['id' => 1, 'vendedor' => 'Juan Pérez', 'cliente' => 'Carlos Mendez', 'boletos' => 4, 'status' => 'pendiente'],
            ['id' => 2, 'vendedor' => 'Marta Martínez', 'cliente' => 'Elena Rodriguez', 'boletos' => 2, 'status' => 'confirmada'],
        ];

        $breadcrumbs = [
            ['label' => 'Admin', 'url' => '/admin/dashboard'],
            ['label' => 'Reservas']
        ];

        $router->view('admin/reservations/index.php', [
            'breadcrumbs' => $breadcrumbs,
            'script' => ['pages/admin/events/events']
        ], 'admin');
    }
}


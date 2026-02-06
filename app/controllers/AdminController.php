<?php

namespace controllers;

use MVC\Router;
use models\Event;
use models\UserPHP;
use models\Team;
use models\TeamMember;
use models\Sale;
class AdminController
{
    public static function index(Router $router)
    {

        if (isset($_GET["register"])) {
            if ($_GET["register"] == "success") {
                $alertas["success"][] = "hola de nuevo";
            }
        }

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
            'alertas' => $alertas,
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

                'vendidos' => 120,

            ],
            [
                'id' => 2,
                'nombre' => "Combo Pareja Wendy's",
                'descripcion' => '2 Hamburguesas, 2 papas y 2 refrescos grandes.',
                'precio' => 22.00,

                'vendidos' => 85,

            ],
            [
                'id' => 3,
                'nombre' => "Family Pack Special",
                'descripcion' => '4 Hamburguesas, nuggets, y bebida familiar.',
                'precio' => 35.00,

                'vendidos' => 15,

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
        // Lista de eventos para el modal
        $events = Event::all();

        // Obtener equipos de la base de datos
        $teams = Team::all();

        // Obtener todas las ventas para calcular por equipo
        $sales = Sale::all();

        // Calcular ventas por equipo
        $teamSales = [];
        foreach ($sales as $sale) {
            // Buscar a qué equipo pertenece el usuario que hizo la venta
            $teamMember = TeamMember::findBy('user_id', $sale->user_id);
            if ($teamMember) {
                if (!isset($teamSales[$teamMember->team_id])) {
                    $teamSales[$teamMember->team_id] = 0;
                }
                $teamSales[$teamMember->team_id] += $sale->amount;
            }
        }

        // Agregar propiedades adicionales a los equipos
        foreach ($teams as $team) {
            // Contar miembros del equipo
            $teamMembers = TeamMember::findAllBy('team_id', $team->id);
            $team->members = count($teamMembers);

            // Agregar ventas del equipo
            $team->sales = $teamSales[$team->id] ?? 0;
        }

        // Lista de usuarios con rol de vendedor
        $users = UserPHP::findAllBy("role_id", 2);

        // Obtener todas las relaciones teams <-> users
        $allMemberships = TeamMember::all();

        // Mapear nombres de equipos por ID para acceso rápido
        $teamNamesById = [];
        foreach ($teams as $team) {
            $teamNamesById[$team->id] = $team->name;
        }

        // Agrupar nombres de equipos por usuario y IDs de usuarios por equipo
        $userTeamsMap = [];
        $team_membres = [];

        foreach ($allMemberships as $membership) {
            // Para el listado de miembros (User -> [TeamNames])
            if (!isset($userTeamsMap[$membership->user_id])) {
                $userTeamsMap[$membership->user_id] = [];
            }
            if (isset($teamNamesById[$membership->team_id])) {
                $userTeamsMap[$membership->user_id][] = $teamNamesById[$membership->team_id];
            }

            // Para el modal de equipos (Team -> [UserIDs])
            if (!isset($team_membres[$membership->team_id])) {
                $team_membres[$membership->team_id] = [];
            }
            $team_membres[$membership->team_id][] = $membership->user_id;
        }

        // Asignar nombres de equipos concatenados a cada usuario
        foreach ($users as $user) {
            if (isset($userTeamsMap[$user->id])) {
                $user->team_names_string = implode(', ', $userTeamsMap[$user->id]);
            } else {
                $user->team_names_string = 'Sin equipo';
            }
        }

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
            'users' => $users,
            'team_membres' => $team_membres,
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


<?php

namespace controllers;

use MVC\Router;

class VendorController
{
    public static function index(Router $router)
    {
        // Variables placeholder para el dashboard de vendedor
        $vendor_stats = [
            'asignados' => 100,
            'vendidos' => 45,
            'disponibles' => 55,
            'recent_sales' => [
                ['ticket' => '#045', 'customer' => 'Maria Gonzalez', 'event' => "Wendy's Fest", 'date' => '12 Oct, 14:30', 'amount' => '$350.00'],
                ['ticket' => '#044', 'customer' => 'Juan Perez', 'event' => "Wendy's Fest", 'date' => '12 Oct, 13:15', 'amount' => '$350.00'],
                ['ticket' => '#043', 'customer' => 'Ana Soto', 'event' => "Wendy's Fest", 'date' => '11 Oct, 18:45', 'amount' => '$350.00'],
            ]
        ];

        $breadcrumbs = [
            ['label' => 'Vendor'],
            ['label' => 'Dashboard']
        ];

        $router->view('vendor/dashboard.php', [
            'titulo' => 'Mi Dashboard',
            'currentPage' => 'dashboard',
            'vendor_stats' => $vendor_stats,
            'breadcrumbs' => $breadcrumbs
        ], 'vendor');
    }

    public static function sales(Router $router)
    {
        // Datos manuales para la venta
        $combos = [
            ['id' => 1, 'nombre' => "Dave's Single® Combo", 'precio' => 8.50],
            ['id' => 2, 'nombre' => "10 Pc. Chicken Nuggets Combo", 'precio' => 7.25],
            ['id' => 3, 'nombre' => "Spicy Chicken Sandwich Combo", 'precio' => 9.00],
        ];

        $boletos_asignados = [
            ['id' => 101, 'numero' => 1001],
            ['id' => 102, 'numero' => 1002],
            ['id' => 103, 'numero' => 1003],
        ];

        $breadcrumbs = [
            ['label' => 'Vendor', 'url' => '/vendor/dashboard'],
            ['label' => 'Ventas']
        ];

        $router->view('vendor/sales.php', [
            'titulo' => 'Registro de Ventas',
            'currentPage' => 'sales',
            'combos' => $combos,
            'boletos' => $boletos_asignados,
            'breadcrumbs' => $breadcrumbs
        ], 'vendor');
    }

    public static function reservations(Router $router)
    {
        // Datos manuales de reservas
        $reservations = [
            [
                'id' => 1,
                'cliente' => 'Carlos Mendez',
                'boletos' => 4,
                'evento' => "Wendy's Fest",
                'expira' => '24 Oct, 18:00',
                'status' => 'pendiente'
            ],
            [
                'id' => 2,
                'cliente' => 'Elena Rodriguez',
                'boletos' => 2,
                'evento' => "Concierto Rock",
                'expira' => '25 Oct, 12:00',
                'status' => 'confirmada'
            ],
            [
                'id' => 3,
                'cliente' => 'Roberto Goméz',
                'boletos' => 6,
                'evento' => "Wendy's Fest",
                'expira' => '23 Oct, 10:00',
                'status' => 'expirada'
            ]
        ];

        $breadcrumbs = [
            ['label' => 'Vendor', 'url' => '/vendor/dashboard'],
            ['label' => 'Reservas']
        ];

        $router->view('vendor/reservations.php', [
            'titulo' => 'Mis Reservas',
            'currentPage' => 'reservations',
            'reservations' => $reservations,
            'breadcrumbs' => $breadcrumbs
        ], 'vendor');
    }

    public static function tickets(Router $router)
    {
        // Datos manuales de boletos asignados al vendedor
        $tickets = [
            ['id' => 1, 'numero' => 1001, 'evento' => 'Escuela Norte', 'status' => 'disponible'],
            ['id' => 2, 'numero' => 1002, 'evento' => 'Escuela Norte', 'status' => 'vendido'],
        ];

        $breadcrumbs = [
            ['label' => 'Vendor', 'url' => '/vendor/dashboard'],
            ['label' => 'Mis Boletos']
        ];

        $router->view('vendor/tickets.php', [
            'titulo' => 'Mis Boletos Asignados',
            'currentPage' => 'tickets',
            'tickets' => $tickets,
            'breadcrumbs' => $breadcrumbs
        ], 'vendor');
    }

    public static function stats(Router $router)
    {
        $breadcrumbs = [
            ['label' => 'Vendor', 'url' => '/vendor/dashboard'],
            ['label' => 'Estadísticas']
        ];

        $router->view('vendor/stats.php', [
            'titulo' => 'Mis Estadísticas',
            'currentPage' => 'stats',
            'breadcrumbs' => $breadcrumbs
        ], 'vendor');
    }

    public static function export(Router $router)
    {
        $breadcrumbs = [
            ['label' => 'Vendor', 'url' => '/vendor/dashboard'],
            ['label' => 'Exportar']
        ];

        $router->view('vendor/export.php', [
            'titulo' => 'Exportar Datos',
            'currentPage' => 'export',
            'breadcrumbs' => $breadcrumbs
        ], 'vendor');
    }
}

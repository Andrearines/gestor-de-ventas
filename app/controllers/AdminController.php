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
            'breadcrumbs' => $breadcrumbs
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
        ];

        $router->view('admin/tickets/inventory.php', [
            'titulo' => 'Inventario de Boletos',
            'tickets' => $tickets
        ], 'admin');
    }
}

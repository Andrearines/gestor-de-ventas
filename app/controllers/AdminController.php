<?php

namespace controllers;

use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        // Datos manuales de ejemplo (KPIs)
        $stats = [
            'ventas_totales' => 124500,
            'boletos_activos' => 3420,
            'combos_vendidos' => 850,
            'crecimiento_ventas' => 12.5
        ];

        $router->view('admin/dashboard.php', [
            'titulo' => 'Dashboard Administrador',
            'stats' => $stats
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

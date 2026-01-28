<?php

namespace controllers;

use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        // Datos manuales de ejemplo (KPIs)
        $kpis = [
            'ventas_totales' => 124500,
            'boletos_vendidos' => 3420,
            'ingresos_hoy' => 1250.50,
            'eventos_activos' => 5
        ];

        // Datos para gráficos (simulados)
        $data = [
            'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
            'sales' => [12000, 19000, 3000, 5000, 2000, 3000]
        ];

        $router->view('admin/dashboard.php', [
            'titulo' => 'Dashboard Administrador',
            'kpis' => $kpis,
            'data' => $data
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

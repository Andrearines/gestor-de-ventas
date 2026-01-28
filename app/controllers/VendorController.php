<?php

namespace controllers;

use MVC\Router;

class VendorController
{
    public static function index(Router $router)
    {
        $stats = [
            'mis_ventas' => 4500,
            'boletos_pendientes' => 15,
            'reservas_activas' => 5
        ];

        $router->view('vendor/dashboard.php', [
            'titulo' => 'Dashboard Vendedor',
            'stats' => $stats
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

        $router->view('vendor/sales.php', [
            'titulo' => 'Registro de Ventas',
            'combos' => $combos,
            'boletos' => $boletos_asignados
        ], 'vendor');
    }
}

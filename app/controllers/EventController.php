<?php

namespace controllers;

use MVC\Router;

class EventController
{
    public static function index(Router $router)
    {
        // Datos manuales de ejemplo
        $eventos = [
            ['id' => 1, 'nombre' => 'Recaudación Escuela Norte', 'codigo' => 'WND-001', 'fecha' => '2023-10-25', 'status' => 'Activo'],
            ['id' => 2, 'nombre' => 'Festival de Jazz', 'codigo' => 'WND-002', 'fecha' => '2023-11-15', 'status' => 'Pendiente']
        ];

        $router->view('admin/events/index.php', [
            'titulo' => 'Gestión de Eventos',
            'eventos' => $eventos
        ], 'admin');
    }

    public static function create(Router $router)
    {
        $router->view('admin/events/create.php', [
            'titulo' => 'Crear Nuevo Evento'
        ], 'admin');
    }

    public static function detail(Router $router)
    {
        $id = $_GET['id'] ?? null;

        $router->view('admin/events/detail.php', [
            'titulo' => 'Detalle del Evento',
            'id' => $id
        ], 'admin');
    }
}

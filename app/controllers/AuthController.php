<?php

namespace controllers;

use MVC\Router;

class AuthController
{
    public static function login(Router $router)
    {
        // Datos manuales para la vista
        $alertas = [];

        $router->view('auth/login.php', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ], 'auth');
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /auth/login');
    }
}

<?php

namespace controllers;

use MVC\Router;
use models\UserPHP;
class AuthController
{
    public static function login(Router $router)
    {
        // Datos manuales para la vista
        $alertas = [];
        $user = new UserPHP();

        if (isset($_GET["register"])) {
            if ($_GET["register"] == "success") {
                $alertas["success"][] = "Usuario creado correctamente";
            }
        }

        $router->view('auth/login.php', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas,
            'user' => $user
        ], );
    }

    public static function register(Router $router)
    {
        // Datos manuales para la vista
        $alertas = [];
        $user = new UserPHP();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->sicronizar($_POST);
            $alertas = $user->Validate_Register();
            if (empty($alertas)) {
                $user->Password_hash();
                $user->role_id = 1;
                $user->active = 1;
                $user->save();
                header('Location: /auth/login?register=success');
            }
        }

        $router->view('auth/register.php', [
            'titulo' => 'unirse',
            'alertas' => $alertas,
            'user' => $user
        ], );
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /auth/login');
    }
}

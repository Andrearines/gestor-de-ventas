<?php

namespace controllers;

use MVC\Router;
use models\UserPHP;
class AuthController
{
    public static function login(Router $router)
    {

        $alertas = [];
        $user = new UserPHP();

        if (isset($_GET["register"])) {
            if ($_GET["register"] == "success") {
                $alertas["success"][] = "Usuario creado correctamente";
            }
            if ($_GET["register"] == "error") {
                $alertas["error"][] = "Ya existe un usuario admin";
            }
            if ($_GET["register"] == "errorActivate") {
                $alertas["error"][] = "Usuario no activado";
            }
        }
        $user = new UserPHP();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user->sicronizar($_POST);

            $alertas = $user->Validate_Login();
            $data = UserPHP::findBy("user", $user->user);
            if (!empty($data)) {
                if ($user->Verify_password($data->password, $user->password)) {
                    $alertas["success"][] = "bienvenido";
                    session_start();
                    $_SESSION = [
                        "id" => $data->id,
                        "nombre" => $data->name,
                        "user" => $data->user,
                        "rol" => ($data->role_id == 1) ? "admin" : "vendor"

                    ];
                    if ($data->active == 0) {
                        header('Location: /auth/login?register=errorActivate');
                        exit;
                    }
                    if ($data->role_id == 1) {
                        header('Location: /admin/dashboard?register=success');
                        exit;
                    }
                    header('Location: /vendor/dashboard?register=success');
                    exit;
                } else {
                    $alertas["error"][] = "contraseña incorecta";
                }
            } else {

                $alertas["error"][] = "no existe el nombre user";
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
        if (UserPHP::findAllBy("role_id", 1)) {
            header('Location: /auth/login?register=error');
            exit;
        }
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

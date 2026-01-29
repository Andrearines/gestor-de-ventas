<?php

namespace models;

class UserPHP extends Main
{
    public static $table = 'users';
    static $columnDB = ['id', 'name', 'email', 'password', 'role_id', 'active', 'created_at', 'updated_at'];

    public $id;
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $active;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        parent::__construct($args);
    }


    public function create_token()
    {
        $token = bin2hex(random_bytes(5));
        $this->token = $token;
        return $token;
    }

    public function Validate_Forget()
    {
        static::$errors = [];

        if (!$this->email) {
            static::$errors["error"][] = "El email es obligatorio";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            static::$errors["error"][] = "El email no es válido";
        }
        return static::$errors;
    }

    public function Validate_reset()
    {
        static::$errors = [];

        $r = self::findBy("token", $this->token);

        if (!$r) {
            static::$errors["error"][] = "no es valido el token";
        }
        if (!$this->password || $this->password == "") {
            static::$errors["error"][] = "La contraseña es obligatoria";
        } elseif (strlen($this->password) < 6) {
            static::$errors["error"][] = "La contraseña debe tener al menos 6 caracteres";
        }

        if ($this->password !== $this->password_c) {
            static::$errors["error"][] = "Las contraseñas no coinciden";
        }

        return self::$errors;
    }

    public function Validate_Login()
    {
        static::$errors = [];

        if (!$this->email || $this->email == "") {
            static::$errors["error"][] = "El email es obligatorio";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            static::$errors["error"][] = "El email no es válido";
        }

        if (!$this->password || $this->password == "") {
            static::$errors["error"][] = "La contraseña es obligatoria";
        } elseif (strlen($this->password) < 6) {
            static::$errors["error"][] = "La contraseña debe tener al menos 6 caracteres";
        }
        return static::$errors;
    }

    public function Validate_Register()
    {
        static::$errors = [];

        if (!$this->nombre || !$this->apellido) {
            static::$errors["error"][] = "El nombre y apellido es obligatorio";
        }

        if (!$this->email) {
            static::$errors["error"][] = "El email es obligatorio";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            static::$errors["error"][] = "El email no es válido";
        }

        if (!$this->password) {
            static::$errors["error"][] = "La contraseña es obligatoria";
        } elseif (strlen($this->password) < 6) {
            static::$errors["error"][] = "La contraseña debe tener al menos 6 caracteres";
        }

        if (!$this->password_c) {
            static::$errors["error"][] = "La confirmación de contraseña es obligatoria";
        } elseif ($this->password !== $this->password_c) {
            static::$errors["error"][] = "Las contraseñas no coinciden";
        }
        if ($this->existeUser()) {
            static::$errors["error"][] = "El email ya está registrado. Por favor, inicia sesión.";
        }
        return static::$errors;
    }

    public function Verify_password($hash, $password)
    {
        return password_verify($password, $hash);
    }

    public function Password_hash($password = null)
    {
        $password = $password ?? $this->password;
        $this->password = password_hash($password, PASSWORD_ARGON2ID);
    }

    public function ExisteUser()
    {
        $r = self::findAllBy("email", $this->email, ["email"]);
        if ($r) {
            return true;
        } else {
            return false;
        }
    }
}

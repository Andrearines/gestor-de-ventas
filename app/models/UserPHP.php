<?php

namespace models;

class UserPHP extends Main
{
    public static $table = 'users';
    static $columnDB = ['id', 'name', 'user', 'password', 'role_id', 'active'];

    public $id;
    public $name;
    public $user;
    public $password;
    public $password_c;
    public $role_id;
    public $active;


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

        if (!$this->user) {
            static::$errors["error"][] = "El usuario es obligatorio";
        } elseif (!filter_var($this->user, FILTER_VALIDATE_EMAIL)) {
            static::$errors["error"][] = "El usuario no es válido";
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

        if (!$this->user || $this->user == "") {
            static::$errors["error"][] = "El usuario es obligatorio";
        } elseif (!filter_var($this->user, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9_]{6,15}$/")))) {
            static::$errors["error"][] = "El usuario no es válido";
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

        if (!$this->name) {
            static::$errors["error"][] = "El nombre es obligatorio";
        }

        if (!$this->user) {
            static::$errors["error"][] = "El usuario es obligatorio";
        } elseif (!filter_var($this->user, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9_]{6,15}$/")))) {
            static::$errors["error"][] = "El usuario no es válido";
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
            static::$errors["error"][] = "El usuario ya está registrado. Por favor, inicia sesión.";
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
        $r = self::findAllBy("user", $this->user, ["user"]);
        if ($r) {
            return true;
        } else {
            return false;
        }
    }
}

<?php

namespace Model;

use Model\ActiveRecord;

class Usuario extends ActiveRecord
{

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $admin;
    public $confirmado;
    public $token;


    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }
    //Validar Datos 
    public function validarDatos()
    {
        // Validar Campos
        if (empty($this->nombre)) {
            self::$alertas['error'][] = "El Nombre del Cliente es Obligatorio";
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = "El Apellido del Cliente es Obligatorio";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "El Email del Cliente es Obligatorio";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "El Password del Cliente es Obligatorio";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "El Password debe contener al menos 6 caracteres";
        }


        // Validar Campos
        return self::$alertas;
    }


    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El Email del Cliente es Obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "El Email del Cliente debe ser válido";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "El Password del Cliente es Obligatorio";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "El Password debe contener al menos 6 caracteres";
        }
        // Validar Campos
        return self::$alertas;
    }


    public function hashPassword()
    {
        if (!empty($this->password)) {
            $this->password =  password_hash($this->password, PASSWORD_BCRYPT);
        }
    }

    public function comprobarPassword($passwordHash)
    {

        $auth = password_verify($this->password, $passwordHash);
        if (!$auth) {
            self::$alertas['error'][] = 'El Password es incorrecto';
        }

        return $auth;
    }

    public function crearToken()
    {
        $this->token = md5(uniqid());
    }


    public function usuarioExiste()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = static::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = "El Usuario ya esta registrado";
        }
        return $resultado;
    }

    public function redireccionar(string $url)
    {

        header('Location:' . $url);
    }
}

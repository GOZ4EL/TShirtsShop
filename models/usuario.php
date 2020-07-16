<?php
class Usuario {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;
    
    function __construct() {
        $this->db = Database::connect();
    }

    function getNombe(): string {
        return $this->nombre;
    }

    function getApellidos(): string {
        return $this->apellidos;
    }

    function getEmail(): string {
        return $this->email;
    }

    function getPassword(): string {
        return $this->password;
    }

    function getRol(): string {
        return $this->rol;
    }

    function getImagen(): string {
        return $this->imagen;
    }

    function setNombre($nombre): void {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos): void {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email): void {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password): void {
        $this->password = password_hash($this->db->real_escape_string($password), 
                PASSWORD_BCRYPT, ["cost" => 4]);
    }

    function setRol($rol): void {
        $this->rol = $rol;
    }

    function setImagen($imagen): void {
        $this->imagen = $imagen;
    }
    
    public function save(): bool {
        if(!$this->validateData())
            return false;

        $sql = "INSERT INTO usuarios VALUES("
                . "NULL, "
                . "'{$this->getNombe()}', "
                . "'{$this->getApellidos()}', "
                . "'{$this->getEmail()}', "
                . "'{$this->getPassword()}', "
                . "'user', "
                . "'NULL'"
            . ");"
        ;
                
        $this->db->query($sql);
        
        return true;
    }
    
    private function validateData(): bool {
        $result = true;
        
        if(is_numeric($this->getNombe()) || preg_match("/[0-9]/", $this->getNombe()))
            $result = false;
        
        if(is_numeric($this->getApellidos()) || preg_match("/[0-9]/", $this->getApellidos()))
            $result = false;
        
        if(!filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL))
            $result = false;
        
        return $result;
    }
    
    public function login($email, $password) {
        $result = false;
        
        $sql = "SELECT * FROM usuarios WHERE email = '$email';";
        $login = $this->db->query($sql);
        
        if(!$login || $login->num_rows != 1) 
            return $result;
        
        $usuario = $login->fetch_object();
        
        $verify = password_verify($password, $usuario->password);
        
        if($verify)
            $result = $usuario;
        
        return $result;
    }
}


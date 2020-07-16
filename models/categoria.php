<?php
class Categoria {
    private $id;
    private $nombre;
    private $db;
    
    function __construct() {
        $this->db = Database::connect();
    }

    function getNombre() {
        return $this->nombre;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
    }
    
    public function getOne() {
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id = {$this->id};");
        return $categoria->fetch_object();
    }

    public function save(): bool {
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
        
        if(!$save) 
            return false;
        
        return true;
        
    }
} 


<?php
class Producto {
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;
    
    function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM productos ORDER BY id DESC;");
    } 
    
    public function getAllFromOneCategory() {
        return $this->db->query(
                "SELECT p.*, c.nombre AS 'nombre_categoria' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoria_id()} "
                . "ORDER BY id DESC;"
            )
        ;
    }
    
    public function getRandom($limit) {
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit;";
        return $this->db->query($sql);
    }
    
    public function getOne() {
        $result = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()};");
        return $result->fetch_object();
    }
    
    public function save(): bool {   
        if(!$this->isTheDataValid()) 
            return false;
        
        $imageUploaded = $this->uploadImageFile();
        
        if(!$imageUploaded)
            return false;
        
        $sql = "INSERT INTO productos VALUES("
                . "NULL, "
                . "{$this->getCategoria_id()}, "
                . "'{$this->getNombre()}', "
                . "'{$this->getDescripcion()}', "
                . "{$this->getPrecio()}, "
                . "{$this->getStock()}, "
                . "NULL, "
                . "CURDATE(), "
                . "'{$this->getImagen()}'"
                . ");";
        $save = $this->db->query($sql);
        
        if(!$save)
           return false;
        
        return true;     
    }  
    
    public function edit(): bool {
        if(!$this->isTheDataValid()) 
            return false;
        
        $imageUploaded = $this->uploadImageFile();
        
        $sql = "UPDATE productos SET "
                . "categoria_id = {$this->getCategoria_id()}, "
                . "nombre = '{$this->getNombre()}', "
                . "descripcion = '{$this->getDescripcion()}', "
                . "precio = {$this->getPrecio()}, "
                . "stock = {$this->getStock()}"
        ;
         
        if($imageUploaded)
            $sql .= ", imagen = '{$this->getImagen()}'";
        
        $sql .= " WHERE id = {$this->getId()};";
        
        $save = $this->db->query($sql);
        
        if(!$save)
           return false;
        
        return true;
    }
    
    private function isTheDataValid(): bool {
        $result = true;
        
        if(is_numeric($this->getNombre()) || preg_match("/[0-9]/", $this->getNombre())
                || !$this->getNombre()) {
            $result = false;
        }
            
        if(!$this->getDescripcion())
            $result = false;
        
        if(!is_numeric($this->getPrecio()) || !preg_match("/[0-9]/", $this->getPrecio())
                || !$this->getPrecio()) {
            $result = false;
        }    
        
        if(!is_numeric($this->getStock()) || !preg_match("/[0-9]/", $this->getStock())
                || !$this->getStock()) {
            $result = false;
        }
        
        if(!$this->getCategoria_id())
            $result = false;
        
        return $result;
    }
    
    private function uploadImageFile(): bool {
        if(!isset($this->imagen))
            return false;
        
        $file = $this->getImagen();
        $filename = $file["name"];
        $mimetype = $file["type"];
            
        if($mimetype != "image/jpg" && $mimetype != "image/jpeg"
                && $mimetype != "image/png" && $mimetype != "image/gift") {
            
            return false;
        }
            
        if(!is_dir("uploads/images")) 
            mkdir("uploads/images", 0777, true);

        $this->setImagen($filename);
        move_uploaded_file($file["tmp_name"], "uploads/images/$filename");

        return true;      
    }
    
    public function delete($id): void {
        $this->db->query("DELETE FROM productos WHERE id = $id;");
    }
}
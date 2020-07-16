<?php
require_once "models/producto.php";

class ProductoController {
    public function index(): void {
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        
        require_once("views/producto/destacados.php");
    }
    
    public function show() {
        if(!$_GET["id"])
            header("Location: ".base_url);
                
        $producto = new Producto();
        $producto->setId($_GET["id"]);
        $pro = $producto->getOne();
        
        require_once 'views/producto/ver.php';
    }
    
    public function gestion(): void {
        $producto = new Producto();
        $productos = $producto->getAll();
        
        require_once("views/producto/gestion.php");
    }
    
    public function crear(): void {
        require_once("views/producto/crear.php");
    }
    
    public function save(): void {
        Utils::verifyIfTheUserIsAdmin();
        
        if(!$_POST)
            $this->setProductSessionAndRedirect(false);
        
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
        $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
        $precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
        $stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
        $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : false;
        $imagen = $_FILES["imagen"];
        
        $producto = new Producto();
        $producto->setNombre($nombre);
        $producto->setDescripcion($descripcion);
        $producto->setPrecio($precio);
        $producto->setStock($stock);
        $producto->setCategoria_id($categoria);
        $producto->setImagen($imagen);
        
        if($_GET["id"]){
            $producto->setId($_GET["id"]);
            $save = $producto->edit();
        }
        else
            $save = $producto->save();

        if(!$save)
            $this->setProductSessionAndRedirect(false); 
        
        $this->setProductSessionAndRedirect(true);
    }
    
    public function edit(): void {
        if(!$_GET["id"])
            header("Location: ".base_url);
        
        $edit = true;
        
        $producto = new Producto();
        $producto->setId($_GET["id"]);
        $pro = $producto->getOne();
        
        require_once "views/producto/crear.php";
    }
    
    public function delete(): void {
        if(!$_GET["id"])
            header("Location: ".base_url);
        $producto = new Producto();
        $producto->delete($_GET["id"]);
        header("Location: ".base_url."producto/gestion");
    }
    
    private function setProductSessionAndRedirect(bool $validation): void {
        $_SESSION["producto"] = $validation;
        header("Location: ".base_url."producto/gestion");
        exit();
    }
            
}

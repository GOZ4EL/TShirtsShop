<?php
require_once "models/categoria.php";
require_once "models/producto.php";

class CategoriaController {
    public function index(): void {
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once "views/categoria/index.php";
    }
    
    public function show() {
        if(!isset($_GET["id"]))
            header("Location: ".base_url);
        
        $categoria = new Categoria();
        $categoria->setId($_GET["id"]);
        $categoria = $categoria->getOne();
        
        $producto = new Producto();
        $producto->setCategoria_id($_GET["id"]);
        $productos = $producto->getAllFromOneCategory();
        
        require_once "views/categoria/ver.php";
    }
    
    public function crear(): void {
        require_once 'views/categoria/crear.php';
    }
    
    public function save(): void {
        Utils::verifyIfTheUserIsAdmin();
        
        $categoria = new Categoria();
        $categoria->setNombre($_POST["nombre"]);
        $categoria->save();
        
        header("Location: ".base_url."categoria/index");
    }
}


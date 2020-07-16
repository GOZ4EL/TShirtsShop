<?php
class Utils {
    public static function showNotFoundError() {
        $error = new ErrorController();
        $error->notFound();
    }
    
    public static function showLoginError() {
        $error = new ErrorController();
        $error->login();
    }
    
    public static function verifyIsTheUserIsLoggedIn(): void {
        if(!isset($_SESSION["identity"])) {
            header("Location: ".base_url);
        }
    }

    public static function verifyIfTheUserIsAdmin(): void {
        if(!isset($_SESSION["admin"])) {
            header("Location: ".base_url);
        }
    }
    
    public static function showCategorias() {
        require_once "models/categoria.php";
        $categoria = new Categoria();
        return $categoria->getAll();
    }
    
    public static function getCarritoStats(): array {
        $stats = array(
            "count" => 0,
            "total" => 0
        );
        
        if(isset($_SESSION["carrito"])) {
            $stats["count"] = count($_SESSION["carrito"]);
            
            foreach($_SESSION["carrito"] as $producto) {
                $stats["total"] += $producto["precio"] * $producto["unidades"];
            }
        }
        
        return $stats;
    }
    
    public static function showStatus($status): string {
        $value = "Pendiente";
        
        switch ($status) {
            case "confirmed": 
                $value = "Pendiente";
                break;
            case "preparation": 
                $value = "En preparación";
                break;
            case "ready": 
                $value = "Preparado para enviar";
                break;
            case "sent": 
                $value = "Enviado";
                break;
        }
        
        return $value;
    }
}




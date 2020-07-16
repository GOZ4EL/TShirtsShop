<?php
require_once "models/pedido.php";

class PedidoController {
    public function index(): void {
        require_once "views/pedido/hacer.php";
    }
    
    public function add() {
        Utils::verifyIsTheUserIsLoggedIn();
        
        $usuario_id = $_SESSION["identity"]->id;
        $provincia = $_POST["provincia"] ? $_POST["provincia"] : false;
        $localidad = $_POST["localidad"] ? $_POST["localidad"] : false;
        $direccion = $_POST["direccion"] ? $_POST["direccion"] : false;  
        
        $stats = Utils::getCarritoStats();
        
        if(!$provincia || !$localidad || !$direccion) {
            header("Location: ".base_url);
            $_SESSION["pedido"] = "failed";
        }
        
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $pedido->setProvincia($provincia);
        $pedido->setLocalidad($localidad);
        $pedido->setDireccion($direccion);
        $pedido->setCoste($stats["total"]);
        
        $save = $pedido->save();
        
        $save_linea = $pedido->save_linea();
        
        if($save && $save_linea)
            $_SESSION["pedido"] = "complete";
        else
            $_SESSION["pedido"] = "failed";
        
        header("Location: ".base_url."pedido/confirmado");
    }
    
    public function confirmado(): void {
        Utils::verifyIsTheUserIsLoggedIn();
        
        $identity = $_SESSION["identity"];
        
        $pedido = new Pedido();
        $pedido->setUsuario_id($identity->id);
        
        $pedido = $pedido->getOnePedidoByUser();
        
        $pedido_productos = new Pedido();
        $productos = $pedido_productos->getProductosByPedido($pedido->id);
        
        require_once "views/pedido/confirmado.php";
    }
    
    public function mis_pedidos(): void {
        Utils::verifyIsTheUserIsLoggedIn();
        
        $usuario_id = $_SESSION["identity"]->id;
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllPedidosByUser();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function detalle(): void {
        Utils::verifyIsTheUserIsLoggedIn();
        
        if(!isset($_GET["id"]))
            header ("Location: ".base_url."pedido/mis_pedidos");
        
        $id = $_GET["id"];
        
        $pedido = new Pedido();
        $pedido->setId($id);
        
        $pedido = $pedido->getOne();
        
        $pedido_productos = new Pedido();
        $productos = $pedido_productos->getProductosByPedido($id);
        
        require_once "views/pedido/detalle.php";
    }
    
    public function gestion(): void {
        Utils::verifyIfTheUserIsAdmin();
        $gestion = true;
        
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        
        require_once "views/pedido/mis_pedidos.php";
    }
    
    public function estado(): void {
        Utils::verifyIfTheUserIsAdmin();
        
        if(!isset($_POST["pedido_id"]) || !isset($_POST["estado"]))
            header ("Location: ".base_url);
        
        $pedido = new Pedido();
        $pedido->setId($_POST["pedido_id"]);
        $pedido->setEstado($_POST["estado"]);
        
        $pedido->edit();
        
        header("Location: ".base_url."pedido/detalle&id={$_POST["pedido_id"]}");
        
    }
}

<?php
ob_start();
?>
<?php
require_once "models/producto.php";

class CarritoController{
    public function index(): void {
        $carrito = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : false;
        
        require_once "views/carrito/index.php";
    } 
    
    public function add(): void {
        if(!$_GET["id"])
            header ("Location: ".base_url);
        
        $product_id = $_GET["id"];
        
        if(isset($_SESSION["carrito"])){
            $productIsInCarrito = $this->incrementUnidadesOfProduct($product_id);
        }
        
        if(!isset($_SESSION["carrito"]) || !$productIsInCarrito) {
            $this->addProductToCarritoSession($product_id);
        }
        header("Location: ".base_url."carrito/index");
    }
    
    private function incrementUnidadesOfProduct($product_id): bool {
        $result = false;
            
        foreach ($_SESSION["carrito"] as $indice => $elemento){
            if($elemento["id_producto"] == $product_id){
                $_SESSION["carrito"][$indice]["unidades"]++;
                $result = true;
            }
        }
        
        return $result;
    }


    private function addProductToCarritoSession($product_id): void {
        $producto = new Producto();
        $producto->setId($product_id);
        $pro = $producto->getOne();

        if(!is_object($pro))
            header ("Location: ".base_url);

        $_SESSION["carrito"][] = array(
            "id_producto" => $pro->id,
            "precio" => $pro->precio,
            "unidades" => 1,
            "producto" => $pro
        );
    }
    
    public function remove() {
        
    }
    
    public function delete_all() {
        unset($_SESSION["carrito"]);
        header("Location: ".base_url);
    }
}

ob_end_flush();

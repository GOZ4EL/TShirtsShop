<?php $stats = Utils::getCarritoStats();?>
<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) >= 1): ?>
    <table>
        <tr>
            <th>Imágen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Acciones</th>
        </tr>
        <?php 
        foreach($carrito as $indice => $elemento): 
            $producto = $elemento["producto"];
        ?>
            <tr>
                <td>
                    <?php if($producto->imagen == null): ?>
                        <img src="<?=base_url."assets/img/camiseta.png"?>" 
                             class="img_carrito">
                    <?php else: ?>
                         <img src="<?=base_url."uploads/images/{$producto->imagen}"?>"
                              class="img_carrito">   
                    <?php endif; ?>
                </td>
                <td>
                    <a class="link" href="<?=base_url."producto/show&id={$producto->id}"?>">
                            <?=$producto->nombre?>
                    </a>
                </td>
                <td>
                    <?=$producto->precio?>
                </td>
                <td>
                    <?=$elemento["unidades"]?>
                </td>
                <td>
                    <a class="button button-delete" 
                       href="<?=base_url?>carrito/delete&index=<?=$indice?>">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <div class="button-delete-container">
        <a href="<?=base_url."carrito/delete_all"?>" class="button button-delete">
            Vaciar Carrito
        </a>
    </div>


    <div class="total-carrito">
        <h3>
            El total es: <span class="digits"><?=$stats["total"]?></span> 
            <span class="dollar">$</span>
        </h3>
        <a href="<?=base_url."pedido/index"?>" class="button button-pedido">Hacer pedido</a>
    </div>

<?php endif;
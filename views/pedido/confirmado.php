<?php Utils::verifyIsTheUserIsLoggedIn(); ?>

<?php if (isset($_SESSION["pedido"]) && $_SESSION["pedido"] == "complete"): ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido uardado con éxito, una vez que realices la transferencia 
        bancaria a la cuenta 0513497030ADD con el coste del pedido será 
        procesado y enviado.
    </p>
    <br>
    <hr>
    <br>
    <?php if (isset($pedido)): ?>
        <h3>Datos del pedido. </h3>
        <br>
        Número del pedido: <?= $pedido->id ?> <br>
        Total a pagar: <?= $pedido->coste ?> $ <br>
        Productos:  

        <table>
            <tr>
                <th>Imágen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php while ($producto = $productos->fetch_object()): ?>
                <tr>
                    <td>
                        <?php if ($producto->imagen == null): ?>
                            <img src="<?= base_url . "assets/img/camiseta.png" ?>" 
                                 class="img_carrito">
                             <?php else: ?>
                            <img src="<?= base_url."uploads/images/{$producto->imagen}" ?>"
                                 class="img_carrito">   
                             <?php endif; ?>
                    </td>
                    <td>
                        <a class="link" href="<?= base_url . "producto/show&id={$producto->id}" ?>">
                            <?= $producto->nombre ?>
                        </a>
                    </td>
                    <td>
                        <?= $producto->precio ?>
                    </td>
                    <td>
                        <?= $producto->unidades ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>


    <?php endif; ?>

<?php else: ?>
    <h1>Pedido fallido</h1>
    <p>
        Ha ocurrido un error al momento de confirmar tu pedido. 
        Por favor intentalo de nuevo.
    </p>
<?php endif;


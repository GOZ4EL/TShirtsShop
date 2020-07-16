<?php if(!$categoria): ?>
    <?php Utils::showNotFoundError(); ?>
<?php else: ?>
    <h1><?=$categoria->nombre?></h1>
    
    <?php while($product = $productos->fetch_object()): ?>
        <div class="product">
            <a href="<?=base_url."producto/show&id=$product->id"?>">
               <?php if($product->imagen == null): ?>
                    <img src="<?=base_url."assets/img/camiseta.png"?>">
                <?php else: ?>
                    <img src="<?=base_url."uploads/images/".$product->imagen?>">
                <?php endif; ?>

            <h2><?=$product->nombre?></h2> 
        </a>
            <p><?=$product->precio?></p>
            <a href="<?=base_url."carrito/add&id={$product->id}"?>" class="button">Comprar</a>
        </div>
    <?php endwhile; ?> 
<?php endif; 



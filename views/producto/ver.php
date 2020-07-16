<?php if(!$pro): ?>
    <?php Utils::showNotFoundError(); ?>
<?php else: ?>
    <h1><?=$pro->nombre?></h1>
    
    <div class="detail-product">
        <?php if($pro->imagen == null): ?>
            <img src="<?=base_url."assets/img/camiseta.png"?>">
        <?php else: ?>
             <img src="<?=base_url."uploads/images/{$pro->imagen}"?>">   
        <?php endif; ?>

        <div class="data">
            <p class="description"><?=$pro->descripcion?></p>
            <p class="price"><?=$pro->precio?> $</p>
            <a href="<?=base_url."carrito/add&id={$pro->id}"?>" class="button">Comprar</a>
        </div>
    </div>
    
    
<?php endif; 
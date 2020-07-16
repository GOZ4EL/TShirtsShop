<?php Utils::verifyIfTheUserIsAdmin(); ?>

<?php if($edit && isset($pro) && is_object($pro)): ?>
    <h1>Editar producto <?=$pro->nombre?></h1>
    
    <?php
        $url_action = base_url."producto/save&id={$pro->id}";
    ?>
<?php else: ?>
    <h1>Crear un nuevo producto</h1>
    
    <?php
        $url_action = base_url."producto/save";
    ?>
<?php endif; ?>

<form class="product-form" action="<?=$url_action?>" 
      method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" 
           value="<?=isset($pro) ? $pro->nombre : ""; ?>" required>
    
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" required>
        <?=isset($pro) ? $pro->descripcion : ""; ?>
    </textarea>
    
    <label for="precio">Precio</label>
    <input type="text" name="precio" 
           value="<?=isset($pro) ? $pro->precio : ""; ?>" required>
    
    <label for="stock">Stock</label>
    <input type="number" name="stock" 
           value="<?=isset($pro) ? $pro->stock : ""; ?>" required>
    
    <label for="categoria">Categoria</label>
    <?php $categorias = Utils::showCategorias()?>
    <select name="categoria" required>
        <?php while($categoria = $categorias->fetch_object()): ?>
            <option value="<?=$categoria->id?>"
                    <?=isset($pro) && $categoria->id == $pro->categoria_id? "selected" : ""; ?>>
                
                <?=$categoria->nombre?>
            </option>
        <?php endwhile; ?>
        
    </select>
    
    <label for="imagen">Imágen</label>
    <?php if(isset($pro) && !empty($pro->imagen)): ?>
        <img src="<?=base_url."uploads/images/{$pro->imagen}"?>" class="thumb">
    <?php endif; ?>
    <input type="file" name="imagen">
    
    <input type="submit" value="Guardar">  
</form>



<?php Utils::verifyIfTheUserIsAdmin(); ?>

<h1>Gestión de Productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">
    Crear producto
</a>

<?php if(isset($_SESSION["producto"]) && $_SESSION["producto"]): ?>
    <strong class="alert_green"> 
        El producto se ha añadido satisfactoriamente.
    </strong>
<?php elseif(isset($_SESSION["producto"]) && !$_SESSION["producto"]): ?> 
    <strong class="alert_red">
        El producto no se ha añadido satisfactoriamente.
    </strong>
<?php endif; ?>
<?php unset($_SESSION["producto"]); ?>
 
<table>
    <th>ID</th>
    <th>NOMBRE</th>
    <th>PRECIO</th>
    <th>STOCK</th>
    <th>ACCIONES</th>
    
    <?php while($pro = $productos->fetch_object()): ?>
        <tr>
            <td><?=$pro->id?></td>
            <td><?=$pro->nombre?></td>   
            <td><?=$pro->precio?></td>
            <td><?=$pro->stock?></td> 
            <td>
                <a class="button button-edit" 
                   href="<?=base_url?>producto/edit&id=<?=$pro->id?>">
                    Editar
                </a>
                <a class="button button-delete" 
                   href="<?=base_url?>producto/delete&id=<?=$pro->id?>">
                    Eliminar
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

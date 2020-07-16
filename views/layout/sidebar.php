<?php
ob_start();
?>
<?php $stats = Utils::getCarritoStats();?>
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$current_url = "http://" . $host . $url;
?>
<aside id="sidebar">
    
    <div class="block_aside">
        <h3>Mi Carrito</h3>
        
        <ul class="carrito_list">
            <li>Productos(<?=$stats["count"]?>)</li>
            <li>Total: <?=$stats["total"]?> $</li>
            <li>
                <a href="<?=base_url."carrito/index"?>">Ver el Carrito</a>
            </li>
        </ul>
        
    </div>

    <div id="login" class="block_aside">

        <?php if(!isset($_SESSION["identity"])):?>
            <h3>Entrar a la web</h3>
            <form action="<?=base_url?>usuario/login" method="POST">

                <label for="email">Email</label>
                <input type="email" name="email" required>

                <label for="password">Contraseña</label>
                <input type="password" name="password" required>

                <input type="submit" value="Iniciar sesión">
            </form>
            
            <?php if(isset($_SESSION["login_error"])): ?>
                <br>
                <?php 
                    Utils::showLoginError();
                    session_destroy();
                ?>
            <?php endif; ?>
        
            <?php if($current_url != base_url."usuario/registro"): ?>
                <br>
                <hr>
                <br>

                <p>¿No tienes una cuenta? 
                    <a href="<?=base_url?>usuario/registro">Regístrate</a>
                </p>
            <?php endif; ?>
        
        <?php else: ?>
            <h3><?=$_SESSION["identity"]->nombre?></h3>
        
        <ul>
            <li><a href="<?=base_url."pedido/mis_pedidos"?>">Mis pedidos</a></li>
        <?php endif; ?>    
                
            <?php if(isset($_SESSION["admin"])): ?>
                <li>
                    <a href="<?=base_url?>categoria/index">
                        Gestionar Categorías
                    </a>
                </li>
                <li><a href="<?=base_url?>producto/gestion">Gestionar Productos</a></li>
                <li><a href="<?=base_url."pedido/gestion"?>">Gestionar Pedidos</a></li>
                
            <?php endif; ?>
            
            <?php if(isset($_SESSION["identity"])): ?>
                <li><a href="<?=base_url?>usuario/logout">Cerrar Sesión</a></li>
            <?php endif;?>
        </ul>                          
    </div>
</aside>
<div id="central">
<?php
ob_end_flush();
?>
<?php Utils::verifyIsTheUserIsLoggedIn(); ?>
<h1>Hacer Pedido</h1>

<h3>Dirección para el envío</h3>
<form action="<?=base_url."pedido/add"?>" method="POST">
    <label for="provincia">Provincia</label> 
    <input type="text" name="provincia" required>
    
    <label for="localidad">Localidad</label> 
    <input type="text" name="localidad" required>
    
    <label for="direccion">Dirección</label> 
    <input type="text" name="direccion" required>
    
    <input type="submit" value="confirmar pedido">
</form>

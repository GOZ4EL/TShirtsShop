<?php 
    if(isset($_SESSION["identity"])) 
        header("Location: ".base_url);        
?>

<h1>Registrarse</h1>

<?php
if(isset($_SESSION["register"]) && $_SESSION["register"]):?>
    <strong class="alert_green">Registro completado correctamente.</strong>
<?php elseif(isset($_SESSION["register"]) && !$_SESSION["register"]):?>
    <strong class="alert_red">Registro fallido, introduce los datos correctamente.</strong>
<?php 
    endif;
    session_destroy();
?>

<form action="<?=base_url?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required>
    
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" required>
    
    <label for="email">Email</label>
    <input type="email" name="email" required>
    
    <label for="password">Password</label>
    <input type="password" name="password" required>
    
    <input type="submit" value="Registrarse">
</form>


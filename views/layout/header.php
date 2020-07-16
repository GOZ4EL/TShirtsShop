<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Tienda de Camisetas</title>

        <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    </head>
    <body>

        <div id="container">
            <header id="header">
                <div id="logo">
                    <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta-logo">
                    <a href="index.php">
                        <h1>Tienda de Camisetas</h1>
                    </a>
                </div>
            </header>

            <?php $categorias = Utils::showCategorias(); ?>
            <nav id="menu">
                <ul>
                    <li> <a href="<?=base_url?>">Inicio</a> </li>
                    
                    <?php while($categoria = $categorias->fetch_object()): ?>
                        <li> 
                            <a href="<?=base_url."categoria/show&id={$categoria->id}"?>">
                            <?=$categoria->nombre?>
                            </a> 
                        </li>
                    <?php endwhile; ?>
                </ul>
            </nav>

            <div id="content">
                

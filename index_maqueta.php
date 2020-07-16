<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Tienda de Camisetas</title>

        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>

        <div id="container">

            <header id="header">
                <div id="logo">
                    <img src="assets/img/camiseta.png" alt="Camiseta-logo">
                    <a href="index.php">
                        <h1>Tienda de Camisetas</h1>
                    </a>
                </div>
            </header>

            <nav id="menu">
                <ul>
                    <li> <a href="#">Inicio</a> </li>
                    <li> <a href="#">Categoría 1</a> </li>
                    <li> <a href="#">Categoría 2</a> </li>
                    <li> <a href="#">Categoría 3</a> </li>
                    <li> <a href="#">Categoría 4</a> </li>
                    <li> <a href="#">Categoría 5</a> </li>
                </ul>
            </nav>

            <div id="content">

                <aside id="sidebar">

                    <div id="login" class="block_aside">
                        
                        <h3>Entrar a la web</h3>
                        <form action="" method="POST">
                            
                            <label for="email">Email</label>
                            <input type="email" name="email">
                            
                            <label for="password">Contraseña</label>
                            <input type="password" name="password">

                            <input type="submit" value="enviar">
                        </form>

                        <ul>
                            <li><a href="#">Mis pedidos</a></li>
                            <li><a href="#">Gestionar pedidos</a></li>
                            <li><a href="#">Gestionar Categorías</a></li>
                        </ul>                          
                    </div>
                </aside>

                <div id="central">

                    <h1>Productos Destacados</h1>
                    
                    <div class="product">
                        <img src="assets/img/camiseta.png">
                        <h2>Camiseta Azul Holgada</h2>
                        <p>30 euros</p>
                        <a href="#" class="button">Comprar</a>
                    </div>

                    <div class="product">
                        <img src="assets/img/camiseta.png">
                        <h2>Camiseta Azul Holgada</h2>
                        <p>30 euros</p>
                        <a href="#" class="button">Comprar</a>
                    </div>

                    <div class="product">
                        <img src="assets/img/camiseta.png">
                        <h2>Camiseta Azul Holgada</h2>
                        <p>30 euros</p>
                        <a href="#" class="button">Comprar</a>
                    </div>                    
                </div>                
            </div>            
        </div>

        <footer id="footer">
            <p>Desarrollado por GOZAEL &copy; <?= date('Y') ?></p>
        </footer>

    </body>
</html>


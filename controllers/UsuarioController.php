<?php
require_once "models/usuario.php";

class UsuarioController {
    public function registro(): void {
        require_once "views/usuario/registro.php";
    }
    
    public function save(): void {       
        $usuario = new Usuario();
        $usuario->setNombre($_POST["nombre"]);
        $usuario->setApellidos($_POST["apellidos"]);
        $usuario->setEmail($_POST["email"]);
        $usuario->setPassword($_POST["password"]);

        $saved = $usuario->save();
        
        $_SESSION["register"] = $saved;
        header("Location: ".base_url."usuario/registro");
    }
    
    public function login(): void {        
        $usuario = new Usuario();
        
        $identity = $usuario->login($_POST["email"], $_POST["password"]);
        
        if(!$identity) {
            $_SESSION["login_error"] = true;
            header("Location: ".base_url);
            exit();
        }

        $_SESSION["identity"] = $identity;
        
        if($identity->rol == "admin")
            $_SESSION["admin"] = true;
        
        header("Location: ".base_url);
    }
    
    public function logout() {
        if(isset($_SESSION["identity"])) {
            session_destroy();
            header("Location: ".base_url);
        }
    }
}


<?php
class ErrorController {
    public function notFound(): void {
        echo "<h1>La página que buscas no existe</h1>"
        . "<br>"
        . "<p>Para volver a la página de inicio clica "
           . "<a href='".base_url."producto/index'>"
                . "aquí"
           . "</a>"
        . "</p>";
    }
    
    public function login(): void {
        echo "<span class='alert_red'>"
                . "Datos inválidos."
            . "</span>"
        ;
    }
}

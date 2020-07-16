<?php
session_start();
require_once "autoload.php";
require_once "config/db.php";
require_once "config/parameters.php";
require_once "helpers/utils.php";
require_once "views/layout/header.php";
require_once "views/layout/sidebar.php";

if(!isset($_GET["controller"]) && !isset($_GET["action"])) {
    $controller_name = default_controller;
    $default = default_action;
    $controller = new $controller_name();
    $controller->$default();   
    exit();
}

if(!isset($_GET["controller"])) {
    Utils::showNotFoundError();
    exit();    
}

$controller_name = $_GET["controller"]."Controller";

if(!class_exists($controller_name)) {
    Utils::showNotFoundError();
    exit();
}

$controller = new $controller_name();

if(!isset($_GET["action"]) || !method_exists($controller, $_GET["action"])) {
    Utils::showNotFoundError();
    exit();
}

$action = $_GET["action"];

$controller->$action();
    
require_once("views/layout/footer.php");
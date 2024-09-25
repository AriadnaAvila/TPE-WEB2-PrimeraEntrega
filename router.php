<?php
require_once 'app/controllers/products.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// Leemos la acción que viene por parámetro
$action = 'home'; // Acción por defecto

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

// Determina qué camino seguir según la acción
switch ($params[0]) {
    case 'categories':
        $productsController = new productsController();
        $productsController->showProducts();
        break;
    default:
        echo '404 page not found';
        break;
}

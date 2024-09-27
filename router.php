<?php
require_once 'app/controllers/products.controller.php';
require_once 'app/controllers/categories.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// Leemos la acción que viene por parámetro
$action = 'home'; // Acción por defecto

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

// Determina qué camino seguir según la acción
switch ($params[0]) {
    case 'products':
        $productsController = new productsController();
        $productsController->showProducts();
        break;
    case 'categories':
        $categoriesController = new categoriesController();
        $categoriesController->showCategories();
        break;
    case 'details':
        $productsController = new productsController();
        $id_producto = $params[1];
        $productsController->showProductById($id_producto);
        break;
    case 'categorieById': 
        $categoriesController = new categoriesController();
        $id_categoria = $params[1];
        $categoriesController->showCategorieById($id_categoria);
        break;
    case 'addCategorie':
        $categoriesController = new categoriesController();
        $categoriesController->addCategorie();
        break;
    case 'deleteCategory':
        $categoriesController = new categoriesController();
        $id_categoria = $params[1];
        $categoriesController->deleteCategory($id_categoria);
        break;
    default:
        echo '404 page not found';
        break;
}

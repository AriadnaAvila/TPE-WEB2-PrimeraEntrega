<?php
session_start();  // Iniciar la sesión

require_once 'app/controllers/products.controller.php';
require_once 'app/controllers/categories.controller.php';
require_once 'app/controllers/auth.controller.php';  // Añadimos el AuthController

// Definimos la URL base
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// Acción por defecto es 'home'
$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

// Proteger rutas que requieren autenticación
$publicRoutes = ['home', 'login', 'logout'];  // Rutas públicas

// Si el usuario intenta acceder a login y ya está logueado, redirigir al home
if ($params[0] === 'login' && isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'home');
    exit();
}

if (!in_array($params[0], $publicRoutes) && !isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'home');  // Redirigir al login si no está autenticado
    exit();
}


// Rutas
switch ($params[0]) {
    case 'home':  
        require 'templates/home.phtml';  // Cargar el template home.phtml
        break;
    case 'login':  
        $authController = new AuthController();
        $authController->login();
        break;
    case 'logout':  // Ruta para cerrar sesión
        $authController = new AuthController();
        $authController->logout();
        break;
    case 'products':
        $productsController = new productsController();
        $productsController->showProducts();
        break;
    case 'product':  // Cambio aquí
        if (isset($params[1])) {
            $productsController = new productsController();
            $productsController->showProductByID($params[1]); 
        } else {
            // Manejo de error si no hay ID
            echo '404 Product Not Found';
        }
        break;
    case 'categories':
        $categoriesController = new categoriesController();
        $categoriesController->showCategories();
        break;
    case 'categorie':  // Cambio aquí
        if (isset($params[1])) {
            $categoriesController = new categoriesController();
            $categoriesController->showCategorieById($params[1]);
        } else {
            // Manejo de error si no hay ID
            echo '404 Category Not Found';
        }
        break;
    case 'addCategorie':
        $categoriesController = new categoriesController();
        $categoriesController->addCategorie();
        break;
    case 'deleteCategorie':
        $categoriesController = new categoriesController();
        $id_categoria = $params[1];
        $categoriesController->deleteCategory($id_categoria);
        break;
    case 'editCategory':
        $categoriesController = new categoriesController();
        $id_categoria = $params[0]; // Suponiendo que el ID se pasa como parámetro
        $categoriesController->editCategory($id_categoria);
        break;
    case 'updateCategory':
        $categoriesController = new categoriesController();
        $categoriesController->updateCategory();
        break;
    default:
        echo '404 page not found';
        break;
}

<?php
session_start();  // Iniciar la sesión

require_once 'app/controllers/products.controller.php';
require_once 'app/controllers/categories.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/home.controller.php';

// Definir URL base
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// Acción por defecto es 'home'
$action = $_GET['action'] ?? 'home';
$params = explode('/', $action);

// Rutas públicas
$publicRoutes = ['home', 'login', 'logout', 'categories', 'categorie', 'products', 'product', 'info'];  

// Si el usuario ya está logueado, redirigir al home al intentar acceder al login
if ($params[0] === 'login' && isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'home');
    exit();
}

// Redirigir al home si intenta acceder a una ruta protegida sin estar autenticado
if (!in_array($params[0], $publicRoutes) && !isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'home');
    exit();
}

// Instanciar controladores solo una vez
$homeController = new homeController();
$authController = new AuthController();
$productsController = new productsController();
$categoriesController = new categoriesController();

// Rutas principales
switch ($params[0]) {
    case 'home':
        $homeController->showHome();
        break;

    case 'login':
        $authController->login();
        break;

    case 'logout':  
        $authController->logout();
        break;

    case 'products':
        $order = $_GET['order'] ?? 'asc';  // Orden por defecto 'asc'
        $productsController->showProducts($order === 'desc' ? 'desc' : 'asc');
        break;

    case 'product':
    case 'info':
        if (isset($params[1])) {
            $method = $params[0] === 'product' ? 'showProductByID' : 'showInformationByID';
            $productsController->$method($params[1]);
        } else {
            echo '404 Product Not Found';
        }
        break;

    case 'categories':
        $categoriesController->showCategories();
        break;

    case 'categorie':
        if (isset($params[1])) {
            $categoriesController->showCategorieById($params[1]);
        } else {
            echo '404 Category Not Found';
        }
        break;

    // Rutas protegidas (requieren autenticación)
    case 'addCategorie':
    case 'addProduct':
    case 'deleteCategorie':
    case 'deleteProduct':
    case 'editCategory':
    case 'editProduct':
    case 'updateCategory':
    case 'updateProduct':
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "login");
            exit();
        }

        $id = $params[1] ?? null;
        $controller = in_array($params[0], ['addProduct', 'deleteProduct', 'editProduct', 'updateProduct']) ? $productsController : $categoriesController;
        $method = str_replace(['Categorie', 'Product'], ['Category', 'Product'], $params[0]);

        if (method_exists($controller, $method)) {
            $controller->$method($id);
        } else {
            echo '404 Action Not Found';
        }
        break;

    default:
        echo '404 page not found';
        break;
}

<?php
session_start();  // Iniciar la sesión

require_once 'app/controllers/products.controller.php';
require_once 'app/controllers/categories.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/home.controller.php';

// Definimos la URL base
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// Acción por defecto es 'home'
$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

// Proteger rutas que requieren autenticación
$publicRoutes = ['home', 'login', 'logout', 'categories', 'categorie', 'products', 'product', 'info'];  // Rutas públicas

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
        $homeController = new homeController();
        $homeController->showHome();
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
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $productsController->showProducts($page);
        break;        
    case 'info':
        $productsController = new productsController();
        $id_producto = $params[1];
        $productsController->showInformationByID($id_producto);
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
        // Rutas protegidas (requieren autenticación)
    case 'addCategorie':
    case 'addProduct':
    case 'deleteCategorie':
    case 'deleteProduct':
    case 'editCategory':
    case 'editProduct':
    case 'updateCategory':
    case 'updateProduct':
        if (isset($_SESSION['user'])) {
            $categoriesController = new categoriesController();
            $id_categoria = isset($params[1]) ? $params[1] : null;
            switch ($params[0]) {
                case 'addCategorie':
                    $categoriesController->addCategorie();
                    break;
                case 'addProduct':
                    $productsController = new productsController();
                    $productsController->addProduct();
                    break;
                case 'deleteCategorie':
                    $categoriesController->deleteCategory($id_categoria);
                    break;
                case 'deleteProduct':
                    $id_producto = isset($params[1]) ? $params[1] : null;
                    $productsController = new productsController();
                    $productsController->deleteProductById($id_producto);
                    break;
                case 'editCategory':
                    $categoriesController->editCategory($id_categoria);
                    break;
                case 'editProduct':
                    $id_producto = isset($params[1]) ? $params[1] : null;
                    $productsController = new productsController();
                    $productsController->editProductById($id_producto);
                    break;
                case 'updateProduct':
                    $id_producto = isset($params[1]) ? $params[1] : null;
                    $productsController = new productsController();
                    $productsController->updateProduct($id_producto);
                    break;
                case 'updateCategory':
                    $categoriesController->updateCategory($id_categoria);
                    break;
            }
        } else {
            header("Location: " . BASE_URL . "login");
            exit();
        }
        break;
    default:
        echo '404 page not found';
        break;
}

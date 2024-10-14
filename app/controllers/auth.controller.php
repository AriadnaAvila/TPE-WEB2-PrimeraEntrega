<?php
require_once 'config.php';

class AuthController {
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }

    public function showLoginForm(){
        // Si el usuario ya está logueado, redirigir a otra parte (por ejemplo, al home)
        if (isset($_SESSION['USER_EMAIL'])) {
            header("Location: " . BASE_URL . "home");
            die(); // Evita que el resto del código se ejecute
        }

        // Mostrar el formulario de login si no está logueado
        require './templates/login.phtml';
    }

    public function login(){
        // Captura los datos del formulario
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        // Validar y autenticar al usuario (simulación)
        if ($usuario === 'webadmin' && $password === 'admin') {
            $_SESSION['user'] = $usuario;  // Guardamos el email en la sesión
            header('Location: ' . BASE_URL . 'products');  // Redirige a la página de productos
        } else {
            // Si falla la autenticación, redirige de nuevo al home
            header('Location: ' . BASE_URL . 'home');
        }
    }

    public function logout(){
        session_start();
        session_destroy();  // Destruir la sesión
        header('Location: ' . BASE_URL . 'home');  // Redirigir al home después del logout
    }
}

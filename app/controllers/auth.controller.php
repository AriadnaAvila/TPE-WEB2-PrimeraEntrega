<?php
require_once 'config.php';

class AuthController {

    public function showLoginForm() {
        // Si el usuario ya está logueado, redirigir a otra parte (por ejemplo, al home)
        if (isset($_SESSION['USER_EMAIL'])) {
            header("Location: " . BASE_URL . "home");
            die(); // Evita que el resto del código se ejecute
        }
        
        // Mostrar el formulario de login si no está logueado
        require './templates/login.phtml';
    }

    public function login() {
        // Captura los datos del formulario
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validar y autenticar al usuario (simulación)
        if ($email === 'admin@example.com' && $password === 'password') {
            $_SESSION['user'] = $email;  // Guardamos el email en la sesión
            header('Location: ' . BASE_URL . 'products');  // Redirige a la página de productos
        } else {
            // Si falla la autenticación, redirige de nuevo al home
            header('Location: ' . BASE_URL . 'home');
        }
    }

    public function logout() {
        session_start();
        session_destroy();  // Destruir la sesión
        header('Location: ' . BASE_URL . 'home');  // Redirigir al home después del logout
    }
}

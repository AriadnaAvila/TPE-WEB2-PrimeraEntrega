<?php
require_once 'config.php';
require_once 'app/models/auth.model.php';
require_once 'app/helpers/auth.help.php';

class AuthController {
    protected $db;
    private $model;
    private $helper;

    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->model = new AuthModel();
        $this->helper = new AuthHelper();
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

    
        $usuarioDB = $this->model->getByEmail($usuario);

        if($usuarioDB){
            // Validar y autenticar al usuario (simulación)
            if (password_verify($password, $usuarioDB->password)) {

                authHelper::login($usuarioDB);
               
                header('Location: ' . BASE_URL . 'products');  // Redirige a la página de productos
            } else {
                // Si falla la autenticación, redirige de nuevo al home
                header('Location: ' . BASE_URL . 'home');
            }
        }
    }

    public function logout(){
        session_start();
        session_destroy();  // Destruir la sesión
        header('Location: ' . BASE_URL . 'home');  // Redirigir al home después del logout
    }
}

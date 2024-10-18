<?php
require_once 'config.php';

class authModel {

    protected $db;

    public function __construct(){
        // Conectar a la base de datos
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        //$this->_deploy(); // Llamar a la función _deploy() al construir el modelo
    }

    public function getByEmail($user) {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}
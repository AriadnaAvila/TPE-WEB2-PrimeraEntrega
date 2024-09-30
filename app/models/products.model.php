<?php
require_once 'config.php';

class productsModel{
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }

    function getProducts(){
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;

    }

    function getProductById($id_producto){
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto=?');
        $query->execute([$id_producto]);

        $productById = $query->fetch(PDO::FETCH_OBJ);
        return $productById;

    }

    // Nueva función para obtener productos por categoría
    function getProductsByCategory($id_categoria) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_categoria = ?');
        $query->execute([$id_categoria]);

        $productsByCategory = $query->fetchAll(PDO::FETCH_OBJ);
        return $productsByCategory;
    }
    

}

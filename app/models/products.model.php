<?php

class productsModel{

    private $db;

    public function __construct() {
        $this->db=new PDO('mysql:host=localhost;'.'dbname=db_tienda_ropa;charset=utf8','root','');
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
    

}

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
    

}

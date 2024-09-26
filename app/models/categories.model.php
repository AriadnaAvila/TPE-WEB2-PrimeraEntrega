<?php

class categoriesModel{
    private $db;

    public function __construct() {
        $this->db=new PDO('mysql:host=localhost;'.'dbname=db_tienda_ropa;charset=utf8','root','');
    }

    function getCategories(){
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();

        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;

    }
}
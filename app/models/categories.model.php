<?php
require_once 'config.php';

class categoriesModel{
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }


    function getCategories(){
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();

        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    function getCategorieById($id_categoria){
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria=?');
        $query->execute([$id_categoria]);
    
        $categorieById = $query->fetch(PDO::FETCH_OBJ); // Devuelve un solo objeto
    
        // Si no se encuentra la categoría, devuelve null o maneja el error
        if (!$categorieById) {
            return null; // o lanzar una excepción
        }
    
        return $categorieById;
    }

    function insertCategorie($nombre_categoria){
        $query = $this->db->prepare('INSERT INTO categorias (nombre_categoria) VALUES (?)');
        $query->execute([$nombre_categoria]);

        return $this->db->lastInsertId();
    }

    // Función para eliminar una categoría
    public function deleteCategoryById($id_categoria) {
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
    }

    public function updateCategory($id_categoria, $nombre_categoria) {
        $query = $this->db->prepare('UPDATE categorias SET nombre_categoria = ? WHERE id_categoria = ?');
        $query->execute([$nombre_categoria, $id_categoria]);
    }
    
}
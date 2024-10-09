<?php
require_once 'config.php';

class productsModel
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }

    function getProducts()
    {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function getProductById($id_producto)
    {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto=?');
        $query->execute([$id_producto]);

        $productById = $query->fetch(PDO::FETCH_OBJ);
        return $productById;
    }

    // Nueva función para obtener productos por categoría
    function getProductsByCategory($id_categoria)
    {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_categoria = ?');
        $query->execute([$id_categoria]);

        $productsByCategory = $query->fetchAll(PDO::FETCH_OBJ);
        return $productsByCategory;
    }

    function getProductDetailsById($id_producto)
    {
        $query = $this->db->prepare(
            'SELECT p.*, i.talle, i.color, i.stock, c.nombre_categoria
            FROM productos p
            JOIN informacion i ON p.id_producto = i.id_producto
            JOIN categorias c ON p.id_categoria = c.id_categoria
            WHERE p.id_producto = ?'
        );
        $query->execute([$id_producto]);

        $information = $query->fetch(PDO::FETCH_OBJ);
        return $information;  // Retorna un solo producto con su categoría
    }

    function insertProduct($tipo, $precio, $id_categoria)
    {
        $query = $this->db->prepare('INSERT INTO productos (tipo, precio, id_categoria) VALUES (?, ?, ?)');
        $query->execute([$tipo, $precio, $id_categoria]);

        return $this->db->lastInsertId();
    }

    public function deleteProductById($id_producto)
    {
        $queryProduct = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $queryProduct->execute([$id_producto]);

    }
}

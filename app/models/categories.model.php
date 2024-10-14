<?php
require_once 'config.php';

class categoriesModel{
    protected $db;

    public function __construct(){
        // Conectar a la base de datos
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->_deploy(); // Llamar a la función _deploy() al construir el modelo
    }

    // Función para verificar y crear las tablas si no existen
    private function _deploy(){
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();

        // Si no existen tablas, crear las necesarias
        if (count($tables) == 0) {
            $sql =<<<END
                CREATE TABLE IF NOT EXISTS `categorias` (
                `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
                `nombre_categoria` varchar(100) NOT NULL,
                PRIMARY KEY (`id_categoria`)
                );

                CREATE TABLE IF NOT EXISTS `productos` (
                `id_producto` int(11) NOT NULL AUTO_INCREMENT,
                `nombre_producto` varchar(100) NOT NULL,
                `precio` decimal(10,2) NOT NULL,
                `id_categoria` int(11) NOT NULL,
                PRIMARY KEY (`id_producto`),
                FOREIGN KEY (`id_categoria`) REFERENCES `categorias`(`id_categoria`)
                );

                -- Añade más tablas aquí si lo necesitas
                END;

            // Ejecutar el SQL para crear las tablas
            $this->db->exec($sql);
            echo "Base de datos desplegada correctamente.\n";
        }
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

        $categorieById = $query->fetch(PDO::FETCH_OBJ);
        if (!$categorieById) {
            return null;
        }

        return $categorieById;
    }

    function insertCategorie($nombre_categoria){
        $query = $this->db->prepare('INSERT INTO categorias (nombre_categoria) VALUES (?)');
        $query->execute([$nombre_categoria]);

        return $this->db->lastInsertId();
    }

    public function deleteCategoryById($id_categoria){
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
    }

    public function updateCategory($id_categoria, $nombre_categoria){
        $query = $this->db->prepare('UPDATE categorias SET nombre_categoria = ? WHERE id_categoria = ?');
        $query->execute([$nombre_categoria, $id_categoria]);
    }
}
?>

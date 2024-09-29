<?php
require_once 'app/views/categories.view.php';
require_once 'app/models/categories.model.php';
require_once 'app/models/products.model.php';

class categoriesController {
    private $productsModel;
    private $categoriesModel;
    private $view;

    public function __construct() {
        $this->productsModel = new productsModel();
        $this->categoriesModel = new categoriesModel();
        $this->view = new categoriesView();
    }

    public function showCategories(){
        $categories=$this->categoriesModel->getCategories();
        $this->view->showCategories($categories);
    }

    public function showCategorieById($id_categoria) {
        $categorieById = $this->categoriesModel->getCategorieById($id_categoria);
        if (!$categorieById) {
            header('Location: ' . BASE_URL . 'categories');
            exit();
        }
    
        $productsbycategorie = $this->productsModel->getProductsByCategory($id_categoria);
        $this->view->showCategorieById($categorieById, $productsbycategorie);
    }
    

    function addCategorie() {
        $nombre_categoria = $_POST['nombre_categoria'];

        $this->categoriesModel->insertCategorie($nombre_categoria);
        header("Location: " . BASE_URL. "categories");
        exit();
    }

    public function deleteCategory($id_categoria) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->categoriesModel->deleteCategoryById($id_categoria);
            header("Location: " . BASE_URL . "categories");
            exit();
        }
    }

    // Función para mostrar el formulario de edición
    public function editCategory($id_categoria) {
        // Asegúrate de que estás recuperando la categoría correctamente
        $categorie = $this->categoriesModel->getCategorieById($id_categoria);
        
        // Verifica que la categoría exista
        if (!$categorie) {
            // Si no existe, puedes redirigir o mostrar un mensaje
            header("Location: " . BASE_URL . "categories");
            exit();
        }
    
        // Pasa el objeto a la vista
        $this->view->showEditCategoryForm($categorie);
    }

    public function updateCategory($id_categoria) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_categoria = filter_var($_POST['id_categoria'], FILTER_SANITIZE_NUMBER_INT);
            $nombre_categoria = filter_var($_POST['nombre_categoria'], FILTER_SANITIZE_STRING);
            
            if ($id_categoria && $nombre_categoria) {
                $this->categoriesModel->updateCategory($id_categoria, $nombre_categoria);
                header("Location: " . BASE_URL . "categories");
                exit();
            }
        }
        // Opcional: redirigir si no es POST
        header("Location: " . BASE_URL . "categories");
        exit();
    }

}
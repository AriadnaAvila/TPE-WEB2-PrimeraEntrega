<?php
require_once 'config.php';
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

    public function editCategory($id_categoria) {
        $categorie = $this->categoriesModel->getCategorieById($id_categoria);
        
        if (!$categorie) {
            header("Location: " . BASE_URL . "categories");
            exit();
        }
        $this->view->showEditCategoryForm($categorie);
    }

    public function updateCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_categoria = $_POST['id_categoria'];
            $nombre_categoria = $_POST['nombre_categoria'];
            
            if ($id_categoria && $nombre_categoria) {
                $this->categoriesModel->updateCategory($id_categoria, $nombre_categoria);
                header("Location: " . BASE_URL . "categories");
                exit();
            }
        }
        header("Location: " . BASE_URL . "categories");
        exit();
    }

}
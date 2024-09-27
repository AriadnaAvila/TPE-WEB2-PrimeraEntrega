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

    public function showCategorieById($id_categoria){
        // Obtiene los detalles de la categoría
        $categorieById = $this->categoriesModel->getCategorieById($id_categoria);
    
        // Obtiene los productos de la categoría seleccionada
        $productsbycategorie = $this->productsModel->getProductsByCategory($id_categoria);
    
        // Pasa tanto la categoría como los productos a la vista
        $this->view->showCategorieById($categorieById, $productsbycategorie);
    }
    

    function addCategorie() {
        // validar entrada de datos
        // authHelper::verify();
        $nombre_categoria = $_POST['nombre_categoria'];

        $this->categoriesModel->insertCategorie($nombre_categoria);
        header("Location: " . BASE_URL. "categories"); 
    }

    // Función para eliminar una categoría
    public function deleteCategory($id_categoria) {
        // Llama al modelo para eliminar la categoría
        $this->categoriesModel->deleteCategoryById($id_categoria);
        // Redirige a la lista de categorías
        header("Location: " . BASE_URL . "categories");
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

    // Función para procesar la actualización de la categoría
    public function updateCategory() {
        $id_categoria = $_POST['id_categoria'];
        $nombre_categoria = $_POST['nombre_categoria'];
        $this->categoriesModel->updateCategory($id_categoria, $nombre_categoria);
        header("Location: " . BASE_URL . "categories");
    }

}
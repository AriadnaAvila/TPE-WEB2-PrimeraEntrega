<?php
require_once 'app/views/categories.view.php';
require_once 'app/models/categories.model.php';

class categoriesController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new categoriesModel();
        $this->view = new categoriesView();
    }

    public function showCategories(){
        $categories=$this->model->getCategories();
        $this->view->showCategories($categories);
    }

    public function showCategorieById($id_categoria){
        $categorieById=$this->model->getCategorieById($id_categoria);
        $this->view->showCategorieById($categorieById);
    }
}
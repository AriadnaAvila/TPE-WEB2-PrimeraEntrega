<?php
require_once 'app/views/products.view.php';
require_once 'app/models/products.model.php';

class productsController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new productsModel();
        $this->view = new productsView();
    }

    public function showProducts(){
        $products=$this->model->getProducts();
        $this->view->showProducts($products);
    }

    public function showProductByID($id_producto){
        $productById = $this->model->getProductById($id_producto);
        $this->view->showProductByID($productById);
    }

}
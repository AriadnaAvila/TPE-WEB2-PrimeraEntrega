    <?php
    require_once 'config.php';
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

        public function showProductByID($id_producto) {
            $productById = $this->model->getProductById($id_producto);
            if (!$productById) {
                // Redirigir a una página de error o mostrar un mensaje
                header('Location: ' . BASE_URL . 'error'); 
                exit();
            }
            $this->view->showProductById($productById);
        }

        public function showInformationByID($id_informacion) {
            $informationById = $this->model->getinformationById($id_informacion);
            if (!$informationById) {
                
                header('Location: ' . BASE_URL . 'error'); 
                exit();
            }
            $this->view->showInformationById($informationById);
        }

    }
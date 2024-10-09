    <?php
    require_once 'config.php';
    require_once 'app/views/products.view.php';
    require_once 'app/models/products.model.php';
    require_once 'app/models/categories.model.php';

    class productsController
    {
        private $model;
        private $cmodel;
        private $view;

        public function __construct()
        {
            $this->cmodel = new categoriesModel();
            $this->model = new productsModel();
            $this->view = new productsView();
        }

        public function showAddProductForm()
        {
            $categorias = $this->cmodel->getCategories();
            $this->view->showSelect($categorias);
        }

        public function showProducts()
        {
            $products = $this->model->getProducts();
            $this->view->showProducts($products);
        }

        public function showProductByID($id_producto)
        {
            $productById = $this->model->getProductById($id_producto);
            if (!$productById) {
                // Redirigir a una página de error o mostrar un mensaje
                header('Location: ' . BASE_URL . 'products');
            }
            $this->view->showProductById($productById);
        }

        public function showInformationByID($id_producto)
        {
            $information = $this->model->getProductDetailsById($id_producto);
            if (!$information) {
                header('Location: ' . BASE_URL . 'products');
            }
            $this->view->showInformationById($information);
        }

        function addProduct()
        {
            $tipo = $_POST['tipo'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['id_categoria'];

            $this->model->insertProduct($tipo, $precio, $id_categoria);
            header("Location: " . BASE_URL . "products");
        }

        public function deleteProductById($id_producto)
        {
            $this->model->deleteProductById($id_producto);
            header("Location: " . BASE_URL . "products");
        }
    }

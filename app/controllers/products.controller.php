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

        public function editProductById($id_producto)
        {
            $product = $this->model->getProductById($id_producto);

            if (!$product) {
                header("Location: " . BASE_URL . "puducts");
                var_dump($product);
                exit();
            }

            // Obtener las categorías para mostrar en el formulario
            $categories = $this->cmodel->getCategories();

            // Obtener la información adicional del producto (talle, color, stock)
            $info = $this->model->getProductDetailsById($id_producto);

            // Mostrar el formulario de edición con el producto, sus categorías e información adicional
            $this->view->showEditProductForm($product, $categories, $info);
        }

        public function updateProduct()
        {
            // Suponiendo que los datos vienen de un formulario POST
            $id_producto = $_POST['id_producto'];
            $tipo = $_POST['tipo'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['id_categoria'];
            $talle = $_POST['talle'];
            $color = $_POST['color'];
            $stock = $_POST['stock'];

            // Llamar al modelo para actualizar el producto
            $this->model->updateProduct($id_producto, $tipo, $precio, $id_categoria, $talle, $color, $stock);

            // Redirigir después de la actualización, por ejemplo, a la lista de productos
            header("Location: " . BASE_URL . "products");
            
        }
    }

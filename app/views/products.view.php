<?php

class productsView{

    public function showProducts($products){
        require './templates/products.phtml';
    }

    function showProductById($productById){
        require './templates/productbyid.phtml';
    }

    function showInformationById($information){
        require './templates/infobyid.phtml';
    }

    function showSelect($categorias){
        require './templates/formAddProduct.phtml';
    }

    function showEditProductForm($product, $categories, $info){
        require './templates/editProductById.phtml';
        
    }
}

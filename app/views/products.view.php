<?php

class productsView{

    public function showProducts($products, $order,$categories){
        require './templates/products.phtml';
    }

    function showProductById($productById){
        require './templates/productbyid.phtml';
    }

    function showInformationById($information, $product){
        require './templates/infobyid.phtml';
    }

    function showSelect($categories){
        require './templates/formAddProduct.phtml';
    }

    function showEditProductForm($product, $categories, $info){
        require './templates/editProductById.phtml';
        
    }
}

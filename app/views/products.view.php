<?php

class productsView{

    public function showProducts($products){
        require './templates/products.phtml';
    }

    function showProductById($productById){
        require './templates/productbyid.phtml';
    }

}
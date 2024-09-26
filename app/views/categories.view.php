<?php

class categoriesView{

    public function showCategories($categories){
        require './templates/categories.phtml';  // Muestra lista de categorías
    }

    function showCategorieById($categorieById){
        require './templates/categoriebyid.phtml';  // Muestra detalles de una categoría
    }
}

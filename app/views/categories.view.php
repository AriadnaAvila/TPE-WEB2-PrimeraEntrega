<?php

class categoriesView{

    public function showCategories($categories){
        require './templates/categories.phtml';  // Muestra lista de categorías
    }

    public function showCategorieById($categorieById, $productsbycategorie) {
        require './templates/categoriebyid.phtml';  // Muestra detalles de la categoría y los productos
    }

    // Nueva función para mostrar el formulario de edición de una categoría
    public function showEditCategoryForm($categorie) {
        require './templates/editCategory.phtml';  // Muestra el formulario de edición
    }

}

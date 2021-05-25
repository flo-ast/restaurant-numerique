<?php

require 'libraries/models/menuModel.php';


/* gère les categories du navigateur de menu */ 

//variable appelle la fonction findAllCategories retourne toutes les catégories
$categories = findAllCategories($pdo);


/* gère les categories */

//affichage ou modification des categories
if (isset($_GET['task']) && $_GET['task'] === 'updateCategories')
{
    $adminCategories = 'updateCategories.phtml';
}
else
{
    $adminCategories = 'validateCategories.phtml';
}



/* gère le produit */

//variable appelle la fonction findAllProd retourne tous les produits
$products = findAllProd($pdo);



/* gère les allergènes */

//variable appelle la fonction findAllAllergens retourne tous les allergenes des produits
$allergens = findAllAllergens($pdo);

//variable appelle la fonction findAllAllergenAndProduct retourne tous les allergenes de tous les produits
$allergensAndProducts = findAllAllergenAndProduct($pdo);



/* affichages */

//affichage de la navigation du menu
$menuNav = 'menuNav.phtml';

//affichage liste ou affichage modification
if (isset($_GET['task']) && $_GET['task'] === 'updateProducts')
{
    $adminProducts = 'updateProducts.phtml';
}
elseif (isset($_GET['task']) && $_GET['task'] === 'newProducts')
{
    $adminProducts = 'newProduct.phtml';
}
else
{
    $adminProducts = 'validateProducts.phtml';
}

//affichage du menu
$template = 'admin/admin.phtml';

//affiche le template
require 'views/template.phtml';
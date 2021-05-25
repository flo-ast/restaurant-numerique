<?php

require 'libraries/models/menuModel.php';


/* gère les categories */

//variable appelle la fonction findAllCategories retourne toutes les catégories
$categories = findAllCategories($pdo);



/* gère le produit */

//variable défini l'id du produit
$idProduct = $_GET['id'];

//variable appelle la fonction findOneProduct retourne un produit par son id
$product = findOneProduct($pdo, $idProduct);

//test si le produit n'existe pas dans la base de données
if(!$product) 
{
    addFlash('error', 'Vous ne pouvez pas voir ce produit, il n\'existe pas');
    header('Location: menu');
    exit(); 
}

//variable appelle la fonction findAllAllergens retourne tous les allergenes d'un produit par son id
$allergens = findAllAllergensByIdProduct($pdo, $idProduct);



/* affichages */ 

//affichage de la navigation du menu
$menuNav = 'admin/menuNav.phtml';

//affichage du menu
$template = 'product.phtml';

//affiche le template
require 'views/template.phtml';
<?php

require 'libraries/models/menuModel.php';


/* gère les categories */

//variable appelle la fonction findAllCategories retourne toutes les catégories
$categories = findAllCategories($pdo);


//variable défini l'id de la categorie est 1
$idCategory = 1;


//conditions qui permettent boucler sur les catégories 
if (!isset($_GET['id']))
{
    $categories[0]["selected"] = 1;
}
else 
{
    $idCategory = $_GET['id'];

   

    for ($i = 0; $i < count($categories); $i++)
    {
        
        if ($_GET['id'] === $categories[$i]['OrderMenu'])
        {
            $categories[$i]["selected"] = 1;
        }    
    }  
}



/* gère les produits */

//variable appelle la fonction findAllProducts retourne tous les produits par leur id de categories
$products = findAllProducts($pdo, $idCategory);

//test si la categorie n'existe pas dans la base de données
if (!$products)
{
    addFlash('error', 'Vous ne pouvez pas accéder a cette catégorie, elle n\'existe pas');
    header('Location: menu');
    exit();
}



/* affichages */

//affichage de la navigation du menu
$menuNav = 'admin/menuNav.phtml';

//affichage du menu
$template = 'menu.phtml';
 
//affiche le template
require 'views/template.phtml';
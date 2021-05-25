<?php

require 'libraries/models/menuModel.php';
require 'libraries/models/cartModel.php';


//affichage du panier en tableaux pour chaque produit
$chunkCart = array_chunk($_SESSION['cart'], 4);

//nombre de produits contenu dans le panier
$numberProduct = count($chunkCart);

//prix total du panier
$priceTotal = updateTotalPriceProductsInCart();


//declare l'id du produit du panier en $_GET
if (isset($_GET['id']))
{

    //recherche un produit par son id
    $product = findOneProduct($pdo, intval($_GET['id']));

    //test si le produit n'existe pas dans la base de données
    if(!$product) 
    {
        addFlash('error', 'Vous ne pouvez pas ajouter ce produit, il n\'existe pas');
        header('Location: menu');
        exit(); 
    }


    //diminuer et ajouter une quantité a un produit grace a action

    $error = false;
    
    //declare les actions en $_GET
    $action = isset($_GET['action']) ? $_GET['action'] : null;


    //si une action
    if ($action !== null)
    {
        //recherche la valeur retournée  par le $_GET : action
        if (!in_array($action, array('decrease', 'increase')))
        {
            $error = true;
        }

        //si y a une action
        if (!$error)
        {
            //switch sur les actions diminue ou augmente la quantité de produit dans le panier
            switch($action)
            {
                //diminue la quantité de produit dans le panier, si la quantité = 0 efface le produit
                case 'decrease':
                    if(intval($_SESSION['cart']['Quantity'.intval($product['Id'])]) > 1)
                    {
                        decreaseProductInCart(intval($_GET['id']));
                        header('Location: cartPage');
                        exit();
                    }
                    else
                    {
                        removeProductInCart(intval($_GET['id']));
                        header('Location: cartPage');
                        exit();
                    }
                    break;
                    

                //augmente la quantité de produit dans le panier si la quantité en stock le permet
                case 'increase':
                    if ($_SESSION['cart']['Quantity'.intval($product['Id'])] < intval($product['QuantityInStock']))
                    {
                        increaseProductInCart(intval($_GET['id']));
                        header('Location: cartPage');
                        exit();
                    }
                    break;

                default; 
            }
        }
    }

}

//declare les actions en $_GET
$action = isset($_GET['action']) ? $_GET['action'] : null;


//efface tout le panier
if (in_array($action, array('delete')))
{
    deleteCart();
}

//affichage du menu
$template = 'cartPage.phtml';
    
        
//affichage du template       
require 'views/template.phtml'; 
<?php

require 'libraries/models/menuModel.php';


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
    
    //si le panier est vide , crée en un, sinon crée un panier tampon
    if (empty($_SESSION['cart']))
    {
        //mise en place de la variable SESSION
        $_SESSION['cart'] = [
            'Id'.intval($product['Id']) => intval($product['Id']),
            'Name'.intval($product['Id'])=> htmlspecialchars($product['Name']),
            'Quantity'.intval($product['Id']) => 1,
            'Price'.intval($product['Id']) => floatval($product['Price'])
        ];
        

        //si la quantité de produit en stock ne le permet pas, supprime le produit du panier et ecrit une erreur
        if (intval($product['QuantityInStock']) <= 0)
        {
            $_SESSION['cart'] = [];
            addFlash('error', 'Victime de son succès, ce produit est en rupture de stock');
        }

    }
    else
    {
        $_SESSION['tampon'] = [
            'Id'.intval($product['Id']) => intval($product['Id']),
            'Name'.intval($product['Id'])=> htmlspecialchars($product['Name']),
            'Quantity'.intval($product['Id']) => 1,
            'Price'.intval($product['Id']) => floatval($product['Price'])
        ];
        
        //si l'id existe deja et la quantité de produit le permet, incremente la quantité du produit du panier, sinon si la quantite le permet, ajoute le tampon au panier
        if (array_key_exists('Id'.intval($product['Id']), $_SESSION['cart']) && intval($product['QuantityInStock']) > 0 && $_SESSION['cart']['Quantity'.intval($product['Id'])] <= intval($product['QuantityInStock']))
        {
            $_SESSION['cart']['Quantity'.intval($product['Id'])] += 1;
        }
        elseif(intval($product['QuantityInStock']) > 0 && $_SESSION['tampon']['Quantity'.intval($product['Id'])] <= intval($product['QuantityInStock']))
        {
            $_SESSION['cart'] += $_SESSION['tampon'];
        }
     
    }

    header('Location: menu?id='.intval($product['OrderMenu']));
    exit();

}

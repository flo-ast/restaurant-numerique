<?php

require 'libraries/models/menuModel.php';
require 'libraries/models/cartModel.php';



//Test si traitement du formulaire
if (isset($_POST)) 
{
    //si le champ numero de table n'est pas rempli, affiche une erreur
    if (empty($_POST['tableNumber']))
    {
        addFlash('error', 'Vous avez oublié de renseigner le numéro de la table');
        header('Location: cartPage');
        exit();
    }
    
    //si le champ numero de table n'est pas un chiffre, affiche une erreur
    if (intval($_POST['tableNumber']) === 0)
    {
        addFlash('error', 'Veuillez renseigner un numéro de la table');
        header('Location: cartPage');
        exit();
    }



    //affichage du panier en tableaux pour chaque produit
    $chunkCart = array_chunk($_POST, 2);

    //numero de la table
    $numberTable = array_pop($chunkCart);

    //nombre de produits contenu dans le panier
    $numberProduct = count($chunkCart);
    
    //creation du ticket de commande en bdd
    $idOrder = addOrder($pdo, intval($_SESSION['users']['Id']), intval($numberTable[0]));

    //boucle pour chaque produit du panier
    for ($i = 0; $i < $numberProduct; $i++)
    {
        //recherche un produit par son id dans la bdd
        $product = findOneProduct($pdo, intval($chunkCart[$i][0]));
        
        //recherche si la quantité du produit est en bdd est plus petite
        if ($_SESSION['cart']['Quantity'.intval($product['Id'])] > intval($product['QuantityInStock']))
        {
            if (intval($product['QuantityInStock']) === 0)
            {
                addFlash('error', 'Désolé, ce produit est victime de son succès');
                removeProductInCart(intval($chunkCart[$i][0]));
                header('Location: cartPage');
                exit();
            }
            else
            {
                addFlash('error', 'Vous avez dépassé la quantité autorisée, veuillez diminuer');
                header('Location: cartPage');
                exit();
            }
        }
        
        //recherche si la quantité du produit est en bdd est = 0, efface le
        if (intval($product['QuantityInStock']) === 0)
        {
            addFlash('error', 'Désolé, ce produit est victime de son succès');
            removeProductInCart(intval($chunkCart[$i][0]));
            header('Location: cartPage');
            exit();
        }

        //calcul de la nouvelle quantité de produit restant
        $newquantityProduct = intval($product['QuantityInStock']) - intval($chunkCart[$i][1]);

        //mise a jour de la quantité dans la bdd
        updateQuantityProduct($pdo, intval($chunkCart[$i][0]), $newquantityProduct);

        //creation de chaque ligne de commandes
        addOrderDetails($pdo, intval($idOrder), intval($chunkCart[$i][0]), intval($chunkCart[$i][1]));
        
    }
    
    //vide le panier
    $_SESSION['cart'] = [];

    
    // redirection
    header('Location: paiement');
    exit();

}

// redirection
header('Location: cartPage');
exit();
<?php

//déclaration des functions


//message d'erreur


/**
 * Permet d'ajouter un message Flash
 *
 * @param string $type
 * @param string $message
 * @return void
 */
function addFlash(string $type, string $message)
{
    if (empty($_SESSION['messages'])) {
        $_SESSION['messages'] = [
            'error' => [],
            'success' => [],
        ];
    }
    $_SESSION['messages'][$type][] = $message;
}



/**
 * Permet de récupérer tout en supprimant les messages d'un certain type
 *
 * @param string $type
 * @return array
 */
function getFlashes(string $type): array
{
    if (empty($_SESSION['messages'])) {
        return [];
    }

    $messages = $_SESSION['messages'][$type];

    $_SESSION['messages'][$type] = [];

    return $messages;
}



/**
 * Permet de savoir s'il existe des messages d'un certain type
 *
 * @param string $type
 * @return boolean
 */
function hasFlashes(string $type): bool
{
    if (empty($_SESSION['messages'])) {
        return false;
    }

    return !empty($_SESSION['messages'][$type]);
}





//mot de passe

/**
 * Permet de retourner le mot de passe encrypté, passé en argument
 *
 * @param string $pass
 * @return string
 */
function cryptPassword($pass) 
{
    //hasher le mot de passe
    return openssl_encrypt($pass, "AES-128-ECB", SECRETKEY);
}



/**
 * Permet de comparer un mot passe en clair avec un mot de passe crypté
 *
 * @param string $pass
 * @param string $passHash
 * @return boolean
 */
function verifPassword($pass, $passHash) 
{
    //vérifier le mot de passe
    if ($pass === openssl_decrypt($passHash, "AES-128-ECB", SECRETKEY)) {
        return true;
    }
    
    return false;

}




//Panier


/**
 * Permet de diminuer la quantité d'un produit du panier
 *
 * @param integer $id
 * @return void
 */
function decreaseProductInCart(int $id)
{
    $_SESSION['cart']['Quantity'.$id] -= 1;  
}



/**
 * Permet d'augmenter la quantité d'un produit du panier
 *
 * @param integer $id
 * @return void
 */
function increaseProductInCart($id)
{
    $_SESSION['cart']['Quantity'.$id] += 1; 
}



/**
 * Permet de calculer le prix total de tous les produits du panier
 *
 * @return float
 */
function updateTotalPriceProductsInCart()
{
    $total = 0;
    //affichage du panier en tableaux pour chaque produit
    $chunkCart = array_chunk($_SESSION['cart'], 4);

    //nombre de produits contenu dans le panier
    $numberProduct = count($chunkCart);

    for ($i = 0; $i < $numberProduct; $i++)
    {
        $total += $chunkCart[$i][2] * $chunkCart[$i][3];
    }

    return $total;

}



/**
 * Permet d'effacer un produit du panier
 *
 * @param integer $id
 * @return void
 */
function removeProductInCart(int $id)
{
    unset($_SESSION['cart']['Id'.$id]);
    unset($_SESSION['cart']['Name'.$id]);
    unset($_SESSION['cart']['Quantity'.$id]);
    unset($_SESSION['cart']['Price'.$id]);
}



/**
 * Permet d'effacer le panier
 *
 * @return void
 */
function deleteCart()
{
    $_SESSION['cart'] = [];
}
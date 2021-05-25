<?php


//déclaration des functions


/**
 * Permet de créer une commande en bdd
 *
 * @param PDO $pdo
 * @param integer $user
 * @param integer $numberTable
 * @return array
 */
function addOrder(PDO $pdo, int $user, int $numberTable)
{
    //prepare la requete
    $query = $pdo->prepare('
    INSERT INTO orders (UserId, TableId)
    VALUES (?, ?)');
    
    //execute la requete
    $query->execute([$user, $numberTable]);

    return $pdo->lastInsertId();
}



/**
 * Permet de créer une ligne de commande en bdd
 *
 * @param PDO $pdo
 * @param integer $idOrder
 * @param integer $idProduct
 * @param integer $quantity
 * @return void
 */
function addOrderDetails(PDO $pdo, int $idOrder, int $idProduct, int $quantity)
{
    //prepare la requete
    $query = $pdo->prepare('
    INSERT INTO orderdetails (OrderId, ProductId, Quantity)
    VALUES (?, ?, ?)');

    //execute la requete
    $query->execute([$idOrder, $idProduct, $quantity]);
}
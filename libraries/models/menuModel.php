<?php


//déclaration des functions
 

/**
 * Permet de selectionner les catégories dans la base de données
 *
 * @param PDO $pdo
 * @return array
 */
function findAllCategories(PDO $pdo) 
{
    //prepare la requete
    $query = $pdo->prepare('
    SELECT * 
    FROM categories
    ORDER BY OrderMenu');
      
    //execute la requete
    $query->execute();
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Permet d'ajouter une catégorie dans la base de données
 *
 * @param PDO $pdo
 * @return void
 */
function addOneCategory(PDO $pdo) 
{
    //prepare la requete
    $query = $pdo->prepare('
    INSERT INTO `categories` (Id, Name, Status, OrderMenu) 
    VALUES (NULL, ?, 0');

    //execute la requete
    $query->execute();
    
    $query->fetch(PDO::FETCH_ASSOC);
}



/**
 * Permet de mettre a jour des catégories dans la base de données
 *
 * @param PDO $pdo
 * @param string $name
 * @param string $status
 * @param int $id
 * @return void
 */
function updateCategories(PDO $pdo, string $name, string $status, int $id) 
{
    //prepare la requete
    $query = $pdo->prepare('
    UPDATE categories
    SET Name = ?, Status = ?
    WHERE Id = ?');

    //execute la requete
    $query->execute([$name, $status, $id]);

}



/**
 * Permet de mettre a jour l'ordre d'une catégorie dans la base de données
 *
 * @param PDO $pdo
 * @param integer $order
 * @param string $name
 * @return void
 */
function updatePlaceCategories(PDO $pdo, int $order, string $name)
{
    //prepare la requete
    $query = $pdo->prepare('
    UPDATE categories
    SET OrderMenu = ?
    WHERE Name = ?');
    
    //execute la requete
    $query->execute([$order, $name]);
}



/**
 * Permet de selectionner les produits et leurs categories dans la base de données
 *
 * @param PDO $pdo
 * @return array
 */
function findAllProd(PDO $pdo) 
{
    //prepare la requete
    $query = $pdo->prepare('
    SELECT products.Id, CategoryId, products.Name, Photo, AltPhoto, Description, Price, QuantityInStock, products.Status, categories.Name AS Categories
    FROM products
    INNER JOIN categories ON products.CategoryId = categories.Id');
      
    //execute la requete
    $query->execute();
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
}



/**
 *  Permet de selectionner les produits et leurs allergenes dans la base de données
 *a effacer
 * @param PDO $pdo
 * @return array
 */
function findAllAllergenAndProduct(PDO $pdo) 
{
    //prepare la requete
    $query = $pdo->prepare('
    SELECT Id, allergenId, ProductId
    FROM products
    INNER JOIN allergendetails ON products.Id = allergendetails.ProductId');
      
    //execute la requete
    $query->execute();
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Permet de selectionner les produits dans la base de données en fonction de leur categorie
 *
 * @param PDO $pdo
 * @param string $categorie
 * @return array
 */
function findAllProducts(PDO $pdo, int $categorie) 
{
    //prepare la requete
    $query = $pdo->prepare('
    SELECT products.Id, products.Name, Photo, AltPhoto, Description, Price, QuantityInStock, CategoryId, products.Status 
    FROM products 
    INNER JOIN categories ON products.CategoryId = categories.Id 
    WHERE OrderMenu = ?');
      
    //execute la requete
    $query->execute([$categorie]);
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Permet de selectionner un produit dans la base de données en fonction de son id
 *
 * @param PDO $pdo
 * @param int $id
 * @return array
 */
function findOneProduct(PDO $pdo, int $id) 
{
    //prepare la requete
    $query = $pdo->prepare('
    SELECT products.Id, products.Name, Photo, AltPhoto, Description, Price, QuantityInStock, CategoryId, OrderMenu
    FROM products
    INNER JOIN categories ON products.CategoryId = categories.Id
    WHERE products.Id=?');
      
    //execute la requete
    $query->execute([$id]);
    
    return $query->fetch(PDO::FETCH_ASSOC);
}



/**
 * Permet d'ajouter un produit dans la base de données
 *
 * @param PDO $pdo
 * @param string $name
 * @param string $description
 * @param float $price
 * @param integer $quantity
 * @param string $status
 * @param integer $category
 * @return string
 */
function addNewProduct(PDO $pdo, string $name, string $description, float $price, int $quantity, string $status, int $category)
{
    //prepare la requete
    $query = $pdo->prepare('
    INSERT INTO products (Name, Description, Price, QuantityInStock, Status, CategoryId)
    VALUES (?, ?, ?, ?, ?, ?)');

    //execute la requete
    $query->execute([$name, $description, $price, $quantity, $status, $category]);

    return $pdo->lastInsertId();
}



/**
 * Permet de mettre a jour un produit dans la base de données
 *
 * @param PDO $pdo
 * @param string $name
 * @param string $description
 * @param float $price
 * @param integer $quantity
 * @param string $status
 * @param integer $category
 * @param integer $id
 * @return void
 */
function updateProduct(PDO $pdo, string $name,string $description, float $price, int $quantity, string $status, int $category, int $id) 
{
    //prepare la requete
    $query = $pdo->prepare('
    UPDATE products
    SET Name = ? , Description = ? , Price = ? , QuantityInStock = ? , Status = ? , CategoryId = ?
    WHERE Id = ? ');

    //execute la requete
    $query->execute([$name, $description, $price, $quantity, $status, $category, $id]);

}



/**
 * Permet de mettre a jour la quantité d'un produit dans la base de données
 *
 * @param PDO $pdo
 * @param integer $idProduct
 * @param integer $quantityProduct
 * @return void
 */
function updateQuantityProduct(PDO $pdo, int $id, int $quantity)
{
    //prepare la requete
    $query = $pdo->prepare('
    UPDATE products
    SET QuantityInStock = ?
    WHERE Id = ? ');

    //execute la requete
    $query->execute([$quantity, $id]);
}



/**
 * Permet d'effacer un produit de la base de données
 *
 * @param PDO $pdo
 * @param integer $id
 * @return void
 */
function deleteProduct(PDO $pdo, int $id)
{
    //prepare la requete
    $query = $pdo->prepare('
    DELETE 
    FROM products
    WHERE Id = ?
    LIMIT 1');

    //execute la requete
    $query->execute([$id]);
}



/**
 * Permet de mettre a jour la photo d'un produit dans la base de données
 *
 * @param PDO $pdo
 * @param string $photo
 * @param integer $id
 * @return void
 */
function updatePhoto(PDO $pdo, string $photo, int $id)
{
    //prepare la requete
    $query = $pdo->prepare('
    UPDATE products
    SET Photo = ?
    WHERE Id = ? ');

    //execute la requete
    $query->execute([$photo, $id]);
}



/**
 * Permet de supprimer les allergenes d'un produit dans la base de données
 *
 * @param PDO $pdo
 * @param integer $id
 * @return void
 */
function deleteAllergenDetails(PDO $pdo, int $id)
{
    //prepare la requete
    $query = $pdo->prepare('
    DELETE 
    FROM allergendetails 
    WHERE ProductId = ?');
    
    //execute la requete
    $query->execute([$id]);
}



/**
 * Permet d'insérer un nouvel allergene
 *
 * @param PDO $pdo
 * @param integer $idProduct
 * @param integer $idAllergen
 * @return void
 */
function insertAllergenDetails (PDO $pdo, int $idProduct, int $idAllergen)
{
    //prepare la requete
    $query = $pdo->prepare('
    INSERT INTO allergendetails
    SET ProductId = ? , AllergenId = ? ');

    //execute la requete
    $query->execute([$idProduct, $idAllergen]);
}



/**
 * Permet de selectionner des allergènes dans la base de données en fonction de l'id du produit
 *
 * @param PDO $pdo
 * @param integer $id
 * @return array
 */
function findAllAllergensByIdProduct(PDO $pdo, int $id)
{
    //prepare la requete
    $query = $pdo->prepare('
    SELECT Id, Name, productId
    FROM allergens
    INNER JOIN allergendetails ON allergens.Id = allergendetails.allergenId
    WHERE ProductId = ?');

    //execute la requete
    $query->execute([$id]);
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Permet de selectionner des allergènes dans la base de données
 *
 * @param PDO $pdo
 * @return array
 */
function findAllAllergens(PDO $pdo)
{
    //prepare la requete
    $query = $pdo->prepare('
    SELECT Id, Name
    FROM allergens');

    //execute la requete
    $query->execute();
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
<?php


//déclaration des functions


/**
 * Permet d'insérer un utilisateur dans la table users
 *
 * @param PDO $pdo
 * @param string $email
 * @param string $password
 * @return array
 */
function insertUser(PDO $pdo, string $email, string $password) {
    //prepare la requete
    $query = $pdo->prepare('
    INSERT INTO users (Email, Password)
    VALUES (?, ?)');
  
    //execute la requete
    $query->execute([$email,$password]);
}



/**
 * Permet de selectionner un utilisateur dans la base de données en fonction d'un email
 *
 * @param PDO $pdo
 * @param string $email
 * @return array|false
 */
function getUserFromEmail(PDO $pdo, string $email) 
{
    //prepare la requete
    $query = $pdo->prepare('
    SELECT Id, Email, Password, Admin  
    FROM users 
    WHERE Email = ? LIMIT 1');
      
    //execute la requete
    $query->execute([$email]);
    
    return $query->fetch(PDO::FETCH_ASSOC);
}



/**
 * Permet de mettre à jour la date de dernière connexion dans la base de données
 *
 * @param PDO $pdo
 * @param int $userId
 * @return array
 */
function updateLoginDate(PDO $pdo, int $userId) 
{
    //prepare la requete
    $query = $pdo->prepare('
    UPDATE users SET LastLogin = NOW() 
    WHERE Id = ?');
    
    //execute la requete
    $query->execute([$userId]);
}
<?php

require 'libraries/models/user.php';


//test si traitement du formulaire
if (!empty($_POST)) 
{
    //test si les champs $_POST existent
     if (empty($_POST['userMail']) || empty($_POST['userPassword'])) 
    {
        addFlash('error', 'Veuillez renseigner les champs');
        header('Location: login');
        exit();
    }

    //test du format de l'email
    if (!filter_var($_POST['userMail'], FILTER_VALIDATE_EMAIL)) 
    {
        addFlash('error', 'Veuillez renseigner un email');
        header('Location: login');
        exit();
    }
    
    //chercher un user qui possède l'email
    $user = getUserFromEmail($pdo, $_POST['userMail']);
    
    //test si l'email n'existe pas dans la base de données
    if(!$user) 
    {
        addFlash('error', 'Erreur d\'email ou de mot de passe');
        header('Location: login');
        exit(); 
    }
    
    //test si le mot de passe n'est pas le bon 
    if(!verifPassword($_POST['userPassword'], $user['Password'])) 
    {
        addFlash('error', 'Erreur d\'email ou de mot de passe');
        header('Location: login');
        exit();  
    }
    

    //identification correcte
    
    //mise en place de la variable SESSION user
    $_SESSION['users'] = [
        'Id' => intVal($user['Id']),
        'Email' => htmlspecialchars($user['Email']),
        'Password' => htmlspecialchars($user['Password']),
        'Admin' => intVal($user['Admin'])
    ];

    //mise en place de la variable SESSION du panier
    $_SESSION['cart'] = [];
    
    //mise à jour de la date de login
    updateLoginDate($pdo, intVal($user['Id']));
    
    //redirection si admin
    if ($_SESSION['users']['Admin'] == 1)
    {
        header('Location: admin');
        exit();    
    }

    //redirection user
    header('Location: menu');
    exit();    

}


//affichage du formulaire
$template = 'login.phtml';
    
    
//affiche le template
require 'views/template.phtml';



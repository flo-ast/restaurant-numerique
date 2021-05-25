<?php

require 'libraries/models/user.php';


//Test si traitement du formulaire
if (!empty($_POST)) 
{
    //test si les champs $_POST existent
     if (empty($_POST['userMail']) || empty($_POST['userPassword']) || empty($_POST['userPassword2'])) 
    {
        addFlash('error', 'Veuillez renseigner les champs');
        header('Location: account');
        exit();
    }
    
    // test si les 2 mots de passe ont la même valeur
    if ($_POST['userPassword'] != $_POST['userPassword2']) 
    {
        addFlash('error', 'Veuillez mettre le même mot de passe');
        header('Location: account');
        exit();
    }
    
    //test du format de l'email
    if (!filter_var($_POST['userMail'], FILTER_VALIDATE_EMAIL)) 
    {
        addFlash('error', 'Veuillez renseigner un email');
        header('Location: account');
        exit();
    }

    //chercher un user qui possède l'email
    $user = getUserFromEmail($pdo, $_POST['userMail']);
    
    //test si l'email existe dans la base de données
    if($user) 
    {
        addFlash('error', 'Ce compte existe déjà');
        header('Location: login');
        exit(); 
    }
    
    //encrypter le mot de passe
    $passwordCrypted = cryptPassword($_POST['userPassword']);

    
    //insertion du user dans la bdd
    insertUser($pdo, $_POST['userMail'], $passwordCrypted);
    
    //recupere dans la bdd le user
    $infoUser = getUserFromEmail($pdo, $_POST['userMail']);
    
    //identification correcte
    
    //mise en place de la variable SESSION user
    $_SESSION['users'] = [
        'Id' => intVal($infoUser['Id']),
        'Email' => htmlspecialchars($infoUser['Email']),
        'Password' => htmlspecialchars($infoUser['Password']),
        'Admin' => intVal($infoUser['Admin'])
    ];

    //mise en place de la variable SESSION du panier
    $_SESSION['cart'] = [];
    
    //mise à jour de la date de login
    updateLoginDate($pdo, intVal($infoUser['Id']));
    
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



//affiche le formulaire
$template = 'account.phtml';

//affiche le template
require 'views/template.phtml';
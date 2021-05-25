<?php
//ouverture de session
session_start();


require 'bdconnect.php';
require 'functions.php';


//ROOT contient le chemin vers index.php 
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

//mise en place du routeur 
if (isset($_GET['p']) && !empty($_GET['p'])) 
{    
    //séparation des paramètres par des / et mis dans le tableau $param 
    $param = explode('?', $_GET['p']);

    //Si au moins 1 paramètre existe
    if ($param[0] !== "") 
    {    
        //sauvegarde le 1er paramètre dans $controller     
        $controller = $param[0];
        $controllers = [
            'notConnected' => ['homePage', 'account', 'login'],
            'connectedUser' => ['menu', 'product', 'logout', 'cartPage', 'addCart', 'validateCart', 'paiement'],
            'connectedAdmin' => ['menu', 'product', 'logout', 'cartPage', 'addCart', 'validateCart', 'paiement', 'admin', 'updateCategory', 'updateOrderCategories', 'updateProduct', 'newProduct', 'deleteProduct']
        ];


        //construction du chemin à appeler pour charger le 1er et le 2eme controller
        //pas connecté    
        if (!isset($_SESSION['users']) && in_array($controller, $controllers['notConnected'])) 
        {             
            require(ROOT . 'libraries/controllers/' . $controller . '.php');
        }
        //connecté en user
        elseif (isset($_SESSION['users']) && in_array($controller, $controllers['connectedUser']))
        {
            require(ROOT . 'libraries/controllers/' . $controller . '.php');
        } 
        //connecté en admin
        elseif (isset($_SESSION['users']) && in_array($controller, $controllers['connectedAdmin']) && $_SESSION['users']['Admin'] == 1)
        {
            require(ROOT . 'libraries/controllers/' . $controller . '.php');
        }
        else 
        {             
            require(ROOT . 'error404.php');       
            exit();         
        }     
    } 
}
else
{    
    //non connecté, redirection vers la page homePage
    if(!isset($_SESSION['users'])) 
    {
        header('Location: homePage');             
        exit();
    }
    //connecté, charge le modèle menu
    else
    {
        header('Location: menu');             
        exit();
    }
}
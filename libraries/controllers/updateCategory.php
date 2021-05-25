<?php

require 'libraries/models/menuModel.php';


//Test si traitement du formulaire
if (isset($_POST) && !empty($_POST)) 
{  
    //test si les champs $_POST sont vides
    if (empty($_POST['nameCategory']) || empty($_POST['statusCategory'])) 
    {
        addFlash('error', 'Veuillez renseigner les champs');
        header('Location: admin?task=updateCategories');
        exit();
    }


    //modifier la categorie dans la bdd
    updateCategories($pdo, ucfirst($_POST['nameCategory']), ucfirst($_POST['statusCategory']), intval($_GET['id']));
    

    // redirection
    header('Location: admin');
    exit();
}

// redirection
header('Location: admin');
exit();
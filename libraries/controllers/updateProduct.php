<?php

$filename = '';

require 'libraries/models/menuModel.php';


//Test si traitement du formulaire
if (isset($_POST)) 
{  
    //test si les champs $_POST sont vides
    if (empty($_POST['nameUpdateProduct']) 
    || empty($_POST['descriptionUpdateProduct']) 
    || empty($_POST['statusUpdateProduct'])
    || empty($_POST['priceUpdateProduct'])
    || empty($_POST['categoryUpdateProduct'])) 
    {
        addFlash('error', 'Veuillez renseigner les champs');
        header('Location: admin?task=updateProducts');
        exit();
    }


    
    //test de l'upload de l'image
    if ($_FILES['imageUpdateProduct']['name'] !== '') 
    {
        //efface l'upload s'il existe deja
        if (empty($_FILES['imageUpdateProduct']['name']))
        {
            unlink('upload/'.$_POST['photoProduct']);
        }
        
        //extensions autorisées png et jpeg
        $allowed_file_types = ['image/png', 'image/jpeg'];
        
        //test du type
        if (in_array(mime_content_type($_FILES['imageUpdateProduct']['tmp_name']), $allowed_file_types)) 
        {
            //le type est bon, chemin
            switch(mime_content_type($_FILES['imageUpdateProduct']['tmp_name'])) 
            {
                case 'image/png':
                    $filename = $_GET['id'].'.png';
                    break;
                
                case 'image/jpeg':
                    $filename = $_GET['id'].'.jpg';
                    break;
            }

            //deplacer le fichier temporaire vers ./upload
            $resultMoveFile = move_uploaded_file($_FILES['imageUpdateProduct']['tmp_name'],"upload/".$filename);
            
            //tester si le fichier est bien arrivé dans le fichier upload
            if ($resultMoveFile) 
            {
                $queryFile = ', Photo = ?';
            }
        }


        //modifie la photo du produit
        updatePhoto($pdo, $filename, intval($_GET['id']));
    }

    //modifie les données du produit dans la bdd
    updateProduct($pdo, ucfirst($_POST['nameUpdateProduct']), ucfirst($_POST['descriptionUpdateProduct']), floatval($_POST['priceUpdateProduct']), intval($_POST['quantityUpdateProduct']), ucfirst($_POST['statusUpdateProduct']), intval($_POST['categoryUpdateProduct']), intval($_GET['id']));
    
    //efface les allergenes
    deleteAllergenDetails($pdo, intval($_GET['id']));

    //insere les nouveaux allergenes
    $allergens = array_filter($_POST, function (string $key){
        return strpos($key, 'allergensUpdate', 0) !== false;
    }, ARRAY_FILTER_USE_KEY);
    
    foreach($allergens as $allergen)
    {
        insertAllergenDetails($pdo, intval($_GET['id']), $allergen);
    }

    
    // redirection
    header('Location: admin');
    exit();
}

// redirection
header('Location: admin');
exit();
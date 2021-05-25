<?php

require 'libraries/models/menuModel.php';


//Test si traitement du formulaire
if (isset($_POST)) 
{  
    //test si les champs $_POST sont vides
    if (empty($_POST['categoryProduct']) 
    || empty($_POST['nameProduct']) 
    || empty($_POST['descriptionProduct']) 
    || empty($_POST['statusProduct'])
    || empty($_POST['quantityProduct'])
    || empty($_POST['priceProduct'])) 
    {
        addFlash('error', 'Veuillez renseigner les champs');
        header('Location: admin?task=newProduct');
        exit();
    }


    //ajoute un produit dans la bdd
    $addProduct = intval(addNewProduct($pdo, ucfirst($_POST['nameProduct']), ucfirst($_POST['descriptionProduct']), floatval($_POST['priceProduct']), intval($_POST['quantityProduct']), ucfirst($_POST['statusProduct']), intval($_POST['categoryProduct'])));

    
    //test de l'upload de l'image
    if ($_FILES['imageProduct']['name'] !== '') 
    {        
        //extensions autorisées png et jpeg
        $allowed_file_types = ['image/png', 'image/jpeg'];
        
        //test du type
        if (in_array(mime_content_type($_FILES['imageProduct']['tmp_name']), $allowed_file_types)) 
        {
            //le type est bon, chemin
            switch(mime_content_type($_FILES['imageProduct']['tmp_name'])) 
            {
                case 'image/png':
                    $filename = $addProduct.'.png';
                    break;
                
                case 'image/jpeg':
                    $filename = $addProduct.'.jpg';
                    break;
            }

            //deplacer le fichier temporaire vers ./upload
            $resultMoveFile = move_uploaded_file($_FILES['imageProduct']['tmp_name'],"upload/".$filename);
            
            //tester si le fichier est bien arrivé dans le fichier upload
            if ($resultMoveFile) {
                $queryFile = ', Photo = ?';
            }
        }

        //modifie la photo du produit
        updatePhoto($pdo, $filename, $addProduct);
    }

    

    //insere les nouveaux allergenes
    $allergens = array_filter($_POST, function (string $key){
        return strpos($key, 'allergens', 0) !== false;
    }, ARRAY_FILTER_USE_KEY);
    
    foreach($allergens as $allergen)
    {
        insertAllergenDetails($pdo, $addProduct, $allergen);
    }

    
    // redirection
    header('Location: admin');
    exit();
}

// redirection
header('Location: admin');
exit();
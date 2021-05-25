<?php

require 'libraries/models/menuModel.php';


if (isset($_POST)) 
{
    //decode JSON en array
    $data = json_decode($_POST['data'], true);
    
    //modifie le déplacement du drag and drop dans la bdd
    updatePlaceCategories($pdo, intval($data[0]['position']), htmlspecialchars($data[0]['name']));
    updatePlaceCategories($pdo, intval($data[1]['position']), htmlspecialchars($data[1]['name']));

}
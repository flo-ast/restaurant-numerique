<?php

require 'libraries/models/menuModel.php';


//efface le produit par son id
deleteProduct($pdo, intval($_GET['id']));


// redirection
header('Location: admin');
exit();
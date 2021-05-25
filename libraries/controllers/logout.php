<?php

//vide le tableau $_SESSION
$_SESSION = [];

//destruction de la session
session_destroy();

//redirige l'utilisateur vers login.php
header('Location: login');
exit();
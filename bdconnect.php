<?php

//configuration de la base de données
const HOST = 'db.3wa.io';
const DBNAME = 'florenceast_restaurant-numerique';
const LOGIN = 'florenceast';
const PASSWORD = '36f8183a01926de895dd1a4fdccd60bf';

//configuration clé sécurité
const SECRETKEY = 'mysecretkey1234';


//connexion a la base de données
$pdo = new PDO ('mysql:host='.HOST.';dbname='.DBNAME.';charset=UTF8', LOGIN,PASSWORD);
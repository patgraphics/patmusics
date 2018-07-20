<?php
session_start();

var_dump($_SESSION['idClient']);
echo"<br>";
var_dump($_SESSION['pseudo']);
echo"<br>";
var_dump($_SESSION['time']);
echo"<br>";

require 'Requete.class.php';
$r=Requete::selectForTab('Commande', 'numCde', 'idClient', $_SESSION['idClient']);
var_dump($r);
$p=$r[0]['numCde'];
echo"<br>$p";
echo"<br>";

echo"<br>";
var_dump($_SESSION['cde']);
echo"<br>";
Requete::confCommande('163');
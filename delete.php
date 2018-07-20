<?php
session_start();
require('Requete.class.php');
Requete::annulCommande($_SESSION['idClient']);
die ("<br><a href='index.php?action=acc'><button>Retour</button></a>");


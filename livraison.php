<?php

//modification etat commande de 1 panier vers 2 confirmee
Requete::confCommande($_SESSION['cde']);


//je recupere le montant de ma commande dans la variable $m
$montantCde = Requete::getMontant($_SESSION['idClient']);
$m = $montantCde[0]['montant'];

//je dis merci
echo"<h2>Merci ".$_SESSION['pseudo']." pour votre confiance, veuillez vérifier vos informations de livraison : </h2>";

//requete select infos client
$infosClient = Requete::selectFromWhere('Client', 'nom, prenom, adresse, numero, adresse, codePostal, ville', 'idClient', $_SESSION['idClient']);
//print_r($infosClient);

//affichage pour validation du client
foreach ($infosClient as $value) {
    echo "<div id='bloc'><h4>Vous êtes :</h4><div class='box'>".$value->prenom." ".$value->nom."</div><br><br><h4>Votre adresse :</h4><div class='box'>".$value->numero." ".$value->adresse."<br>".$value->codePostal."<br>".$value->ville."</div></div>";
}

   die("<br><a href='index.php?action=end'><button>Confimer et être redirigé vers un site sécurisé pour le règlement</button></a> ou <a href='index.php?action=mod'><button>Modifier l'adresse</button></a>");

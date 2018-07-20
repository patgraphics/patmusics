<?php

if (isset ($_SESSION['cde'])){

        //je recupere les articles de la commande dans la variable $a
        $a = Requete::getPanier($_SESSION['cde']);
        
        //print_r($a); // ceci est un test unitaire merci de ne ne pas effacer
        
        $q = 0; $total = 0;//initialisation des variables locales
        //affichage des articles $a obtenus sous forme objet avec le fetchall(PDO::FETCH_OBJ)
        echo "<table><th>Ref</th><th>Support</th><th>Titre</th><th>Auteur</th><th>Prix</th><th>Qté</th><th>Montant</th>";
            //calcul des valeurs dans la boucle et rendu de l ensemble sous forme de tableau html
            foreach ($a as $a){
                //affichage de chaque ligne avec calcul dans le traitement foreach
                echo  "<tr><td>".$a->refArticle."</td><td>".$a->type."</td><td>".$a->titre."</td><td>".$a->auteur."</td>"
                        . "<td>".$a->prixUnitaire."</td><td>".$a->qteArtCde."</td><td>".$a->qteArtCde * $a->prixUnitaire."</td></tr>";
                $montant = $a->qteArtCde * $a->prixUnitaire;//calcul du montant de chaque ligne
                $q += $a->qteArtCde;//cummul des lignes quantites
                $total += $montant;//cummul des lignes montants
            }
        echo "<tr><td></td><td></td><td></td><td></td><td></td><td>".$q."</td><td>".$total."</td></tr>";
        echo "</table>";
        
        //affectation du montant de la commande dans la table Commande pour le paiement
        Requete::setMontantCommande($_SESSION['cde'],$total);
        
        //message pour le client pour le prevenir que sa commande va paser en mode validation
        echo "<br>Merci ".$_SESSION['pseudo']." vous êtes sur le point de confirmer votre commande ".$_SESSION['cde']." pour un total de ".$total ;
   
   die("<br>  <a href='index.php?action=del'><button>Annuler</button></a> ou "
           . "<a href='index.php?action=pan'><button>Ajouter d'autres articles</button></a> ou"
           . "<a href='index.php?action=pay'><button>Confimer et payer</button></a>");
   
}else{
    die('Erreur : commande inexistante, veuillez vous connecter à nouveau pour faire un panier');
}






/*
   $mc = Requete::getMontant($_SESSION['idClient']);//je recupere sous forme de tableau le resultat de ma requete  
   print_r($mc);
   $montantCde = $mc[0]['montant'];//je recupere le montant de ma commande dans la variable $montantCde
*/
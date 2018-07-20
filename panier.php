<?php
echo "<h1>Etat de Commande</h1>";

if (isset ($_SESSION['pseudo'])){

    if (isset ($_SESSION['cde'])){
        $g = $_SESSION['cde'];
        
        echo "Merci ".$_SESSION['pseudo']." :  détail de votre panier n° $g";
        
        $a = Requete::getPanier($g); //je recupere le contenu du panier dans la variable $a
        //print_r($a); // test unitaire affichage de mon objet PDO ne pas effacer
        
        //affichage des elements du panier $a obtenu sous forme objet par fetchall(PDO::FETCH_OBJ)
        $q=0; $total=0; //initialisation des variables locales
        echo "<table><th>Support</th><th>Photo</th><th>Titre</th><th>Auteur</th><th>Prix</th><th>Qté</th><th>Montant</th>";
        foreach ($a as $a){
            $montant = $a->qteArtCde * $a->prixUnitaire;
            echo "<tr><td>".$a->type."</td><td><img src='img/".$a->refArticle.".png' width='50px'></td><td>".$a->titre."</td><td>".$a->auteur."</td><td>".$a->prixUnitaire."</td><td>".$a->qteArtCde."</td><td>".$montant."</td></tr>";
            $q += $a->qteArtCde;
            $total += $montant;
        }
        
        echo "<tr><td></td><td></td><td></td><td></td><td></td><td>".$q."</td><td>".$total."</td></tr>";
        echo "</table>";
        echo("<br>"); 
        die("<br><a href='index.php?action=cnf'><button>Valider la commande</button></a> ou <a href='index.php?action=pan'><button>Ajouter d'autres articles</button></a>");        


      
    }else{
        echo "Attention ".$_SESSION['pseudo'].", veuillez faire un <a href='index.php?action=pan'>panier</a> pour commander";
    }
}else{
    echo "veuillez vous <a href='index.php?action=cnx'>connecter</a> pour faire un panier et commander";

}



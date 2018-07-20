<?php
session_start();
require 'Requete.class.php';

if(isset ($_SESSION['pseudo'])){
    
    if (isset($_GET['refArticle'])){
        $product = Requete::selectFromWhere('`article`', 'refArticle, type, titre, auteur, prixUnitaire', '`refArticle`', $_GET['refArticle']);
        // print_r($product);  // test unitaire affichage de mon objet PDO ne pas effacer
        $qte=1;//initialisation de la variable locale
        //
        // affichage des details du produit choisi et saisie de la quantite
        foreach ($product as $prod){
        echo " Ajouter ce ".$prod->type." à votre panier<br><img src='img/".$prod->refArticle.".png'><br> Titre : ".$prod->titre."<br> Auteur : ".$prod->auteur."<br> Prix : ".number_format($prod->prixUnitaire,2);
        ?><form method="POST"><label for="qte">Quantité </label><input name="qte" type="number" min="1" max="5" step="1" value="1" style="width:30px"> <button type="submit">Ok</button></form><?php
            if (isset($_POST['qte'])){
                $qte=$_POST['qte'];//mise a jour de la quantite saisie par le client
                echo "<br>$qte";
            }
        }
            //initialisatin des variables pour ma requete
            $cli=$_SESSION['idClient'];
            $dat=date('Y-m-d');
            $eta='1';


            if(!isset($_SESSION['cde'])){
                //dans ce cas je cree d abord une nouvelle commande dans la table Commande
                Requete::addCommande($cli, $dat, $eta);
             

                //je retrouve le numero unique de la commande que je viens d inserer et je le balance dans $panier
                $pan = Requete::selectForTab('Commande', 'numCde', 'idClient', $_SESSION['idClient']);
                $panier=$pan[0]['numCde'];
                $_SESSION['cde'] = $panier;
                echo"<br><div class='msg'><em>panier créé avec le numéro </em> $panier</div>";

                //je met ensuite l article de ma selection dans la ligne de commande
                Requete::addLigne($prod->refArticle, $_SESSION['cde'], $qte);
                    //echo"<br>ligne de commande enregistrée ".$prod->type." : ".$prod->titre." dans le panier ".$_SESSION['cde'];
                //affecte la quantite de ce produit dans la ligne de commande correspondante
                Requete::SetQteLigneCommande($qte, $_SESSION['cde'], $_GET['refArticle']);
            }else{
                //je met directement l article de ma selection dans la ligne de commande sans creer de nouvelle commande
                Requete::addLigne($prod->refArticle, $_SESSION['cde'], $qte);
                    //echo"<br>ligne de commande enregistrée avec ".$qte." ".$prod->type." : ".$prod->titre." dans le panier ".$_SESSION['cde'];
                //affecte la quantite de ce produit dans la ligne de commande correspondante
                Requete::SetQteLigneCommande($qte, $_SESSION['cde'], $_GET['refArticle']);
                
                /*echo'<br>test<br>';
                $s= Requete::selectFromWhere('ligneCde', '*', 'refArticle', $_GET['refArticle']);
                print_r($s);
                */
            }
        }else{
            die("erreur : aucun produit sélectionné ! ");
        }
        echo "<br><h4>maintenant ".$_SESSION['pseudo'].", vous pouvez :</h4>";        
        echo("<br> <a href='javascript:history.back()'><button class='bt2'>commander un autre article</button></a> ");
        die(" ou  <a href='index.php?action=cde'><button>voir votre panier</button> </a>");
}else{
    die("Veuillez vous <a href='index.php?action=cnx'>connecter</a> pour faire un panier svp");
}







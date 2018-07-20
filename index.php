<?php

session_start();

require ("controller.php");

include 'header.php';

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "ins":
            if(isset($_POST['nom'])&& isset($_POST['prenom'])&& isset($_POST['pseudo'])&& isset($_POST['email'])&& isset($_POST['numero']) && isset($_POST['adresse']) && isset($_POST['codePostal']) && isset($_POST['ville']) && isset($_POST['motPass1'])&& isset($_POST['motPass2'])){
                inscription($_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['email'], $_POST['numero'], $_POST['adresse'], $_POST['codePostal'], $_POST['ville'], $_POST['motPass1'], $_POST['motPass2'])  ;
            }
            else{
                ins();
            }
            break;
        case "cnx":
            if(isset($_POST['motdepasse'])&& isset($_POST['pseudo']) ){
                connection($_POST['motdepasse'], $_POST['pseudo']);
            }
            else{
                cnx();
            }
            break;
        case "dcx":
            deconnection();
            echo"vous êtes désormais déconnecté(e) merci de votre visite et à bientôt sur Patmusics <a href='index.php?action=acc'>retour à l'accueil</a>";
            break;
        case "new":
            echo "Administrateur : ajouter un nouvel article<br>";
            if(isset($_POST['type']) && isset($_POST['idCategorie']) && isset($_POST['prixUnitaire']) && isset($_POST['titre']) && isset( $_POST['auteur']) && isset($_POST['editeur'])){
                if(($_POST['type'])!="" && ($_POST['idCategorie'])!="" && ($_POST['prixUnitaire'])!="" && ($_POST['titre'])!="" && ( $_POST['auteur'])!="" && ($_POST['editeur'])!=""){
                    addArticle($_POST['type'], $_POST['idCategorie'], $_POST['prixUnitaire'], $_POST['titre'], $_POST['auteur'], $_POST['editeur']); 
                }else{
                    add();
                }
            } else {
                add();
            }
            break;
        case "acc":
            include 'accueil.php';
            break;
        case "pan":
            include 'catalog.php';
            break;
        case "cde":
            include 'panier.php';
            break;
        case "cnf":
            include 'confirmation.php';
            break; 
        case "pay":
            include 'livraison.php';
            break;   
        case "del":
            include 'annulation.php';
            break;   
        
        case "cnt":
            include 'contact.view.php';
            break;
        default :
             include 'accueil.php';
    }
 
} 
else {
      include 'accueil.php'; 
    }
            
include 'footer.php';
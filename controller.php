<?php

require_once('Connection.php');
require_once('Inscription.php');


function connection($motpass = "", $pseudo = "") {

    if ($pseudo && $motpass) {
        $connection = new Connection($motpass, $pseudo);

        if ($connection->conn()) {

            //creation des variables de session 
            $_SESSION['idClient'] = $connection->getIdClient();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['time'] = time();          
            require ('index.php');
        } else {
            $error = $connection->getError();

            cnx();
        }
    } else {

        cnx();
        
    }
}
function cnx(){
    require ('connexion.view.php');
}

function deconnection() {
    if (isset($_SESSION)) {
        $speudo = $_SESSION['pseudo'];
        session_destroy();
        $_SESSION = NULL;
        require ('accueil.php');
    } else {
        require ('accueil.php');
    }
}

function inscription($nom, $prenom, $pseudo, $email, $numero, $adresse, $codePostal, $ville, $motPass1, $motPass2) {

    $syntaxe = '<^[A-Za-z0-9]*$>';
    if ($nom && $prenom && $pseudo && $email && $motPass1 && $motPass2) {

        if (preg_match($syntaxe, $nom) && preg_match($syntaxe, $prenom) && preg_match($syntaxe, $pseudo)) {
            $inscription = new Inscription($nom, $prenom, $pseudo, $email, $numero, $adresse, $codePostal, $ville, $motPass1, $motPass2);
            $resultat = $inscription->inscription();
            if ($resultat) {
                echo "<p>votre inscription a bien été prise en compte, pensez maintenant à vous connecter svp</p>";
                require ('accueil.php');
            } else {
                $error = $inscription->getError();
                ins();
            }
        } else {
            $error = "<h4>Attention ! pas de caractere speciaux, veuillez recommencer SVP</h4>";
            echo ($error);
            ins();
        }
    } else {
        ins();
    }
}
function ins(){
    require ('inscription.view.php');
}
function contact(){
    require("contact.view.php");
}
function add(){
    echo "Attention : veuillez renseigner tous les champs svp";
    require("new.view.php");
}
function addArticle($type, $idCategorie, $prixUnitaire, $titre, $auteur, $editeur){
    Requete::addArticle($type, $idCategorie, $prixUnitaire, $titre, $auteur, $editeur);
    echo "your new article have been well inserted";
    require("index.php");
}
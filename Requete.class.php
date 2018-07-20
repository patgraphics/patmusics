<?php
require("ConDataBase.php");

class Requete {
    
    private static $erreur;
    
    function __construct() {
        
    }
    /**
     * fonction principale pour recuperer les donnees en objet
     * @param  $query est le contenu de la requete SQL
     * @return $res sous forme OBJET ou null si pas de reponse
     */
    public static function getDatas($query){
        $res = NULL; //initialisation de la variable a null au cas ou 
        if (isset($query) && $query != "") { //je teste validite de ma requete
            //je me connecte en creant une instance de ma classe CnxDB
            $bdb = ConDataBase::getInstance(); // demande de connection
            $reponse = $bdb->query($query); //execution de la requete
            if ($reponse) { // je teste l existence de la reponse
                $reponse->setFetchMode(PDO::FETCH_ASSOC); //envoi dans tableau
                $res = $reponse->fetchall(PDO::FETCH_OBJ); //renvoi un objet PDO dans la variable $res
                $reponse = NULL; //je remets a zero pour la prochaine execution
            } else {
                self::$erreur = $bdb->errorInfo();
            }
            //je referme ma connexion en fin de requete
            ConDataBase::close(); 
            return $res;
        }
        //je referme ma connexion en precisant que  $query est vide 
        CnxDB::close(); 
        die('requete invalide !');
    }
    /**
     * fonction principale pour recuperer les donnees en tableau
     * @param  $query est le contenu de la requete SQL
     * @return $res sous forme de tableau ou null si pas de reponse
     */
    public static function getResTab($query){
        $res = NULL; //initialisation de la variable a null au cas ou 
        if (isset($query) && $query != "") { //je teste validite de ma requete
            //je me connecte en creant une instance de ma classe CnxDB
            $bdb = ConDataBase::getInstance(); // demande de connection
            $reponse = $bdb->query($query); //execution de la requete
            if ($reponse) { // je teste l existence de la reponse
                $reponse->setFetchMode(PDO::FETCH_ASSOC); //envoi dans tableau
                $res = $reponse->fetchall(); //renvoi dans la variable $res
                $reponse = NULL; //je remets a zero pour la prochaine execution
            } else {
                self::$erreur = $bdb->errorInfo();
            }
            //je referme ma connexion en fin de requete
            ConDataBase::close(); 
            return $res;
        }
        //dans ce cas $query est vide 
        echo('requete invalide !');
        ConDataBase::close(); 
        
    }
    /**
     * fonction principale pour ajouter les donnees dans la base
     * @param  $query est le contenu de la requete SQL
     * @return $bool vrai si tout fonctionne bien
     */
    public static function addDatas($query) {
        $bool = FALSE;
        $bdd = ConDataBase::getInstance();
        $bdd->beginTransaction();
        if ($bdd->exec($query)) {
            $bdd->commit();
            $bool = TRUE;
        } else {
            self::$erreur = $bdd->errorInfo();
        }
        ConDataBase::close();
        return $bool;
    }
 
    /**
     * getter qui renvoie la valeur de la variable $erreur
     * @return type erreur si existe sinon NULL
     */
    public static function getErreur() {
        $erreur = NULL;
        if (isset(self::$erreur)) {
            $erreur = self::$erreur;
        }
        self::$erreur = NULL;
        return $erreur;
    }
    
    //-------------------fonctions secondaires pour effectuer les requetes------
    
    public static function selectFrom($from, $select){
        $sql = "SELECT " .$select. " FROM " .$from;
        return self::getDatas($sql);
    }
    public static function selectAllTab($from, $select){
        $sql = "SELECT " .$select. " FROM " .$from;
        return self::getResTab($sql);
    }
    
    public static function selectFromWhere($from, $select, $col, $param){
        $sql = "SELECT " .$select. " FROM " .$from. " WHERE " .$col. " = '".$param."'";
        return self::getDatas($sql);
    }
    public static function selectForTab($from, $select, $col, $param){
        $sql = "SELECT " .$select. " FROM " .$from. " WHERE " .$col. " = '".$param."'";
        return self::getResTab($sql);
    }

    public static function selecType($saisie){
        $sql = "SELECT *  FROM `Article` WHERE `type` = ".$saisie."";
        return self::getDatas($sql);
    }
    
    
    public static function addClient($nom,$prenom,$numero,$adresse,$codePostal,$ville,$email,$pseudo,$password){
        $sql = "INSERT INTO `Client` (`idClient`, `nom`, `prenom`, `numero`, `adresse`, `codePostal`, `ville`, `email`, `pseudo`, `password`) VALUES (NULL,'".$nom."','".$prenom."', '".$numero."', '".$adresse."', '".$codePostal."', '".$ville."', '".$email."','".$pseudo."','".$password."')";
        self::addDatas($sql); 
    }
    
    public static function addLigne($refArticle,$numCde,$qteArtCde){
        $sql = "INSERT INTO `ligneCde` (`refArticle`,`numCde`,`qteArtCde`) VALUES ('".$refArticle."','".$numCde."','".$qteArtCde."')";
        self::addDatas($sql);
    }
    
    public static function SetQteLigneCommande($qte, $nc, $ra){
        $sql = "UPDATE `ligneCde` SET `qteArtCde` = '".$qte."' WHERE `numCde` = '".$nc."' AND `refArticle` = '".$ra."'";
        self::addDatas($sql);
    }

    public static function setMontantCommande($numCde, $montant){
        $sql = "UPDATE `commande` SET `montant` = '".$montant."' WHERE `commande`.`numCde` = '".$numCde."'";
    }

    public static function addCommande($idClient, $dateCde, $etatCde){
        $sql = "INSERT INTO `Commande` (`idClient`,`dateCde`,`etatCde`) VALUES ('".$idClient."','".$dateCde."','".$etatCde."')";
        print_r($sql);
        self::addDatas($sql);
    }
    
    public static function confCommande ($numCde){
        $sql = "UPDATE `commande` SET `etatCde` = '2' WHERE `commande`.`numCde` = '".$numCde."'";
        self::addDatas($sql);
    }
   
    public static function annulCommande($idClient){
        $sql ="DELETE FROM `Commande` WHERE `Commande`.`idClient` = '".$idClient."' ";
        self::addDatas($sql);
        echo"<div class='msg'><em>Votre commande a bien été annulée, nous espérons vous revoir bientôt sur </em> Patmusics, un site de Patgraphics &copy;</div>";
    }

        public static function getMontant ($idClient){
        $sql = "SELECT numCde, montant FROM Commande WHERE idClient = '".$idClient."'";
        return self::getResTab($sql);
    }
    
    public static function getDownOnIt($numCde){
               $sql = "SELECT ligneCde.refArticle, ligneCde.qteArtCde, Article.type, Article.titre, Article.auteur, Article.prixUnitaire FROM `ligneCde` \n"
    . "INNER JOIN Article ON ligneCde.refArticle = Article.refArticle\n"
    . "WHERE `numCde` = '".$numCde."'";
        return self::getResTab($sql);
    }

    public static function getPanier ($numCde){
        $sql = "SELECT ligneCde.refArticle, ligneCde.qteArtCde, Article.type, Article.titre, Article.auteur, Article.prixUnitaire FROM `ligneCde` \n"
    . "INNER JOIN Article ON ligneCde.refArticle = Article.refArticle\n"
    . "WHERE `numCde` = '".$numCde."'";
        return self::getDatas($sql);
    }
    
    
}

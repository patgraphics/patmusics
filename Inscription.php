<?php

require_once('Requete.class.php');

class Inscription {

    
    private $prenom;
    private $pseudo;
    private $email;
    private $numero;
    private $adresse;
    private $codePostal;
    private $ville;
    private $motPass1;
    private $motPass2;
    private $password;
    private $error;
    private $resultat;
    private $idClient;
    private $nom;

    public function __construct($nom, $prenom, $pseudo, $email, $numero, $adresse, $codePostal, $ville, $motPass1, $motPass2) {
        $this->nom = trim($nom);
        $this->prenom = trim($prenom);
        $this->pseudo = trim($pseudo);
        $this->email = trim($email);
        $this->numero = trim($numero);
        $this->adresse = trim($adresse);
        $this->codePostal = trim($codePostal);
        $this->ville = trim($ville);
        $this->motPass1 = $motPass1;
        $this->motPass2 = $motPass2;
    }

    
    /**
     * savoir si un pseudo existe ou pas
     * @return boolean vrais si ca existe
     */
    public function isPseudoClient() {
        $result = FALSE;
        $res = Requete::selectFromWhere('Client', 'idClient', "pseudo",$this->pseudo);
        if ($res) {
            $result = TRUE;
            $this->idClient = $res[0]['idClient'];
        }
        return $result;
    }

    /**
     * verification des condition pour inscription du client dans la base
     * @return $tes boolean vrai si inscription sinon faux
     */
    public function verifInscription() {
        $tes = FALSE;
        if (strlen($this->nom) <= 30 && strlen($this->prenom) <= 30 && strlen($this->pseudo) <= 20 && strlen($this->pseudo) >= 2) { //verification de nom et prenom et pseudo
            $syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
            if (preg_match($syntaxe, $this->email)) { //verification de l'email
                if (strlen($this->motPass1) > 7 && $this->motPass1 == $this->motPass2) { //verification du mot de pass
                    if (!$this->isPseudoClient()) { //verification si pseudo deja existant
                        $tes = TRUE;
                        $this->password = password_hash($this->motPass1, PASSWORD_DEFAULT);
                        $this->motPass1 = NULL;
                        $this->motPass2 = NULL;
                    } else { $this->error = "Désolé, ce pseudo existe dejà, trouvez-en un autre svp"; }
                } else { $this->error = "Attention, les mots de passe ne correspondent pas ou sont trop courts"; }
            } else { $this->error = "Attention, si vous voulez recevoir un mail : format tonprenom@chez.toi"; }
        } else { $this->error = "longueur nom ou prénom : 1 à 30 caractères, longueur pseudo : 2 a 20 caractères"; }
        return $tes;
    }

    /**
     * cette methode valide inscription apres verifications
     * des mots de passe identiques et des saisies correctes
     * @return $result TRUE si inscription bien passee sinon FALSE
     */
    public function inscription() {
        $result = FALSE;
        if ($this->verifInscription()) {

                    Requete::addClient($this->nom, $this->prenom, $this->numero, $this->adresse, $this->codePostal, $this->ville, $this->email, $this->pseudo, $this->password) ;
                    $result = TRUE;
                    $this->resultat = "<p>Bienvenue ".$this->pseudo." parmi nos fidèles clients, bénéficiez dès maintenant de vos avantages</p>";
                    echo ($this->resultat);
        }
        else {
                    $this->error = Requete::getErreur();
                    print_r($this->error);

        }
        return $result;
    }

    public function getError() {
        return $this->error;
    }

    public function getResultat() {
        return $this->resultat;
    }

}
?>


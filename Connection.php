<?php

require_once('Requete.class.php');

class Connection {

    private $motdepasse;
    private $pseudo;
    private $error;
    private $result;
    private $idClient;

    public function __construct($motpass, $pseudo) {  
       
        $this->pseudo = $pseudo;       
        $this->motdepasse = $motpass;
               
    }

    public function getPseudo() {
        $res = NULL;
        if (isset($this->pseudo)) {
            $res = $this->pseudo;
        }
        return $res;
    }

    public function conn() {
        $res = FALSE;

        $result = Requete::selectForTab("Client", "idClient, password", "pseudo", $this->pseudo);
    
        if ($result) {                    
            
                 if (password_verify($this->motdepasse, $result[0]['password'])) {

                    $this->result = "Connection réussie";
                    $this->idClient = $result[0]['idClient'];
                    $res = TRUE;
                } else {
                    $this->error = " erreur ! mot de passe incorrect";                   
                    print_r($this->error);
                }
            } else {
                 $this->error = " désolé, ce pseudo n'existe pas";
                 print_r($this->error);
            }
        return $res;
        
    }

    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    public function getIdClient() {
        return $this->idClient;
    }

}

<?php

include 'Person.php';

class Etudiant extends Person {

    private $etudiantID;
    protected $password;

    public function __construct($etudiantID, $nom, $prenom, $email, $password) {
        parent::__construct($nom, $prenom, $email);
        $this->etudiantID = $etudiantID;
        $this->password = $password;
    }

    public function getEtudiantID() {
        return $this->etudiantID;
    }

    public function setEtudiantID($newEtudiantID) {
        $this->etudiantID = $newEtudiantID;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($newPassword) {
        $this->password = $newPassword;
    }

    public function __toString() {
        return "Etudiant";

    }

    function __destruct() {

    }

}
<?php


class Professeur extends Person {

    private $professorID;
    protected $password;
    private $listStudents;


    function __construct($professorID, $nom, $prenom, $email, $password) {
        parent::__construct($nom, $prenom, $email);
        $this->professorID = $professorID;
        $this->password = $password;
    }

    public function getProfessorID() {
        return $this->professorID;
    }

    public function setProfessorID($professorID) {
        $this->professorID = $professorID;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($newPassword) {
        $this->password = $newPassword;
    }

    public function __toString() {
        return "Professor";

    }

    function __destruct() {

    }

}
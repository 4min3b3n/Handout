<?php

class Cours {

	private $coursID;
	private $titre;
	private $description;
	private $module;
	private $annee;
    private $professeurID;
    private $fileID;

	public function __construct($coursID, $titre, $description, $module, $annee, $professeurID, $fileID) {
        $this->coursID = $coursID;
        $this->titre = $titre;
        $this->description = $description;
        $this->module = $module;
        $this->annee = $annee;
        $this->professeurID = $professeurID;
        $this->fileID = $fileID;
	}

	public function getCoursID() {
	    return $this->coursID;
    }

	public function getTitre() {
	    return $this->titre;
    }

    public function getAnnee() {
	    return $this->annee;
    }

    public function getModule() {
	    return $this->module;
    }

	public function __toString() {
        return "Cours: " . "<br>";
    }

   public function getDescription() {
	    return $this->description;
   }



    public function __destruct() {

    }

}

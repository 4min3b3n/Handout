<?php


class Devoir {
    private $devoirID;
    private $titre;
    private $description;
    private $module;
    private $annee;
    private $professeurID;
    private $fileID;

    public function __construct($devoirID, $titre, $description, $module, $annee, $professeurID, $fileID) {
        $this->devoirID = $devoirID;
        $this->titre = $titre;
        $this->description = $description;
        $this->module = $module;
        $this->annee = $annee;
        $this->professeurID = $professeurID;
        $this->fileID = $fileID;
    }

    public function getDevoirID() {
        return $this->devoirID;
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

    public function getDescription() {
        return $this->description;
    }



    public function __toString() {
        return "Devoir";
    }

    public function __destruct() {

    }
}
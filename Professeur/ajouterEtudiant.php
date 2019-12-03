<?php

include '../Connection.php';

$database = new Connection();

$professeurID = $_COOKIE['etudiantID'];

$etudiantID = $_GET['etudiantID'];

if ($_GET['etudiantID'] != null) {


    if ($database->addEtudiantToProfesseur($etudiantID, $professeurID)) {
        header('Location: /Professeur/etudiant_.php');
    }


}

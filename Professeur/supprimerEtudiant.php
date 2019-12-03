<?php

include '../Connection.php';

$database = new Connection();

$professeurID = $_COOKIE['etudiantID'];

$etudiantID = $_GET['etudiantID'];

if ($_GET['etudiantID'] != null) {

    if ($database->supprimerEtudiantToProfesseur($etudiantID, $professeurID)) {
        header('Location: /Professeur/etudiant_.php');
    }


}

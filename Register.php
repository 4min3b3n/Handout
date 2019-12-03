<?php

require 'Connection.php';

$handoutConnection = new Connection();


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $nom = checkInput($_POST["Nom"]);
    $prenom = checkInput($_POST['Prenom']);
    $email = checkInput($_POST['Email']);
    $password_1 = checkInput($_POST['Password_1']);
    $password_2 = checkInput($_POST['Password_2']);
    $typeUser = checkInput($_POST['type']);



    if ($handoutConnection->checkExistingEmail($email)) {
        $foundEmail = false;
    } else {
        $foundEmail = true;
    }


    if (checkPassword($password_1, $password_2)) {
        $correctPassword = true;
        $password = $password_2;
    } else {
        $correctPassword = false;
    }


    if ($typeUser == 'Etudiant') {
        if ($correctPassword) {
            if ($foundEmail) {
                $handoutConnection->addEtudiant($nom, $prenom, $email, $password);
                header('Location: /index.php');
            }
        }
    }


    if ($typeUser == 'Professeur') {
        if ($correctPassword) {
            if ($foundEmail) {
                $handoutConnection->addProfesseur($nom, $prenom, $email, $password);
                header('Location: /index.php');
            }
        }
    }

}

function checkInput($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function checkPassword($password_1, $password_2) {
    if ($password_1 == $password_2) {
        return true;
    } else {
        return false;
    }
}







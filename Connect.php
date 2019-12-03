<?php

require 'Connection.php';

session_start();

$handoutConnection = new Connection();

$username = $_POST['Username'];
$password = $_POST['Password'];
$typeUser = $_POST['type'];

function createSession($username, $password) {

    $_SESSION['lastConnection'] = time();
    $_SESSION['Username'] = $username;
    $_SESSION['Password'] = $password;

}

function createCookie($etudiantID, $nom, $prenom, $type) {

    setcookie('etudiantID', $etudiantID, time() + 1800, '/');
    setcookie('nom', $nom, time() + 1800, '/');
    setcookie('prenom', $prenom, time() + 1800, '/');
    setcookie('type', $type, time() + 1800, '/');

}

    $etudiant = $handoutConnection->getEtudiant($username);
    $professeur = $handoutConnection->getProfesseur($username);

    if ($etudiant != null || $professeur != null) {

        if ($etudiant != null) {

            if ($etudiant->getPassword() == $password) {

                $typeUser = 'Etudiant';

                $etudiantID = $handoutConnection->getEtudiantID_ByEmail($username);
                $nomEtudiant = $etudiant->getNom();
                $prenomEtudiant = $etudiant->getPrenom();

                createCookie($etudiantID, $nomEtudiant, $prenomEtudiant, $typeUser);

                createSession($username, $password);

                header('Location: /Home.php');

            } else {

                header('Location: /index.php');
                echo '<script>alert("Mot de passe saisi est incorrect")</script>';

            }
        }

        if ($professeur != null) {

            if ($professeur->getPassword() == $password) {

                $typeUser = 'Professeur';

                $etudiantID = $handoutConnection->getProfesseurID_ByEmail($username);

                $nomProfesseur = $professeur->getNom();
                $prenomProfesseur = $professeur->getPrenom();

                createCookie($etudiantID, $nomProfesseur, $prenomProfesseur, $typeUser);

                createSession($username, $password);

                header('Location: /Home.php');

            } else {

                echo '<script langagealert("Mot de passe saisi est incorrect")</script>';
                header('Location: /index.php');

            }

        }

    } else {
        echo '<script>alert("Identifiant saisi est incorrect")</script>';
        header('Location: /index.php');
    }



?>

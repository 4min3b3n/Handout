<?php

include 'Connection.php';


$database = new Connection();


if ($_GET['coursID'] != null) {
    $nomFile = $database->SupprimerCours($_GET['coursID']);
    if (true) {
        header('Location: /index.php');
    }
} else if ($_GET['devoirID'] != null) {
    $nomFile = $database->SupprimerDevoir($_GET['devoirID']);
    if (true) {
        header('Location: /index.php');
    }
}

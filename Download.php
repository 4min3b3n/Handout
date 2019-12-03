<?php

include 'Connection.php';

$database = new Connection();

if ($_GET['coursID'] != null) {

    $cours = $database->getCours($_GET['coursID']);

    $result = $database->getFileID_ByCoursID($cours->getCoursID());

    $path =  $result['Chemin'] . $result['Nom'];

    $location = 'Location: ' . $path;

    if ($_GET['download'] == 1) {

        $cours = $database->getCours($_GET['coursID']);

        $result = $database->getFileID_ByCoursID($cours->getCoursID());

        $path =  $result['Chemin'] . $result['Nom'];

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$path");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            readfile($path);
    }

    header($location);

} else if ($_GET['devoirID'] != null) {

    $devoir = $database->getDevoir($_GET['devoirID']);

    $result = $database->getFileID_ByDevoirID($devoir->getDevoirID());

    $path =  $result['Chemin'] . $result['Nom'];

    $location = 'Location: ' . $path;

    if ($_GET['download'] == 1) {

        $devoir = $database->getDevoir($_GET['devoirID']);

        $result = $database->getFileID_ByDevoirID($devoir->getDevoirID());

        $path =  $result['Chemin'] . $result['Nom'];

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$path");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        readfile($path);
    }

    header($location);

}
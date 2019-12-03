<?php

session_start();

$expireAfter = 30;

include 'Connection.php';


$database = new Connection();

if ((!isset($_SESSION["Username"])) and ((!isset($_SESSION["Password"])))) {
    header('Location: /index.php');
}

if(isset($_SESSION['lastConnection'])){

    $secondsInactive = time() - $_SESSION['lastConnection'];

    $expireAfterSeconds = $expireAfter * 60;

    if($secondsInactive >= $expireAfterSeconds){

        session_unset();
        session_destroy();

    }

}

$etudiantID = $_COOKIE['etudiantID'];

$fileID = $database->getFileID_ByDevoirID($_GET['devoirID']);

$target_dir = "./Files/CompteRendu/";

$devoir = $database->getDevoir($_GET['devoirID']);
$titre = $devoir->getTitre();

$target_file = $target_dir . $professeurID . "/" . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$database = new Connection();


if(isset($_POST["submit"])) {


    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000000) {
        header('Location: /index.php');
        $uploadOk = 0;
    }

    if($FileType != "doc" && $FileType != "docx" && $FileType != "txt" && $FileType != "pdf" && $FileType != "ppt" && $FileType != "pptx" && $FileType != "odt" && $FileType != "rtf") {
        $uploadOk = 0;
    }

    if ($uploadOk != 0) {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $dir = $target_dir . $etudiantID . "/";

            $fileID = $database->ajouterCompte(basename($_FILES["fileToUpload"]["name"]), $dir);

            $database->ajouterCompteDB($titre, $etudiantID, $fileID);

            header('Location: /index.php');

        } else {

            header('Location: /index.php');

        }
    }
}








<?php

include_once 'Connection.php';


$target_dir = "./Files/Cours/";

$professeurID = $_COOKIE['etudiantID'];

$target_file = $target_dir . $professeurID . "/" . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$database = new Connection();

$titre = $_POST['Titre'];
$description = $_POST['Description'];
$module = $_POST['Module'];
$annee = $_POST['AnneeUniversitaire'];

if(isset($_POST["submit"])) {


    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        header('Location: /index.php');
        $uploadOk = 0;
    }

    if($FileType != "doc" && $FileType != "docx" && $FileType != "txt" && $FileType != "pdf" && $FileType != "ppt" && $FileType != "pptx" && $FileType != "odt" && $FileType != "rtf") {
        $uploadOk = 0;
    }

    if ($uploadOk != 0) {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $dir = $target_dir . $professeurID . "/";

            $fileID = $database->ajouterCours(basename($_FILES["fileToUpload"]["name"]), $dir);

            $database->ajouterCoursBD($titre, $description, $module, $annee, $professeurID, $fileID);

            header('Location: /index.php');

        } else {

            header('Location: /index.php');

        }
    }
}






?>

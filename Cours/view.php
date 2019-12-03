<?php

include '../Connection.php';

session_start();

$expireAfter = 30;

$database = new Connection();


if ($_GET['coursID'] != null) {
    $cours = $database->getCours($_GET['coursID']);
} else if ($_GET['devoirID'] != null) {
    $cours = $database->getDevoir($_GET['devoirID']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Style.css">
    <script src="../jQuery.js"></script>
    <title>Handout - <?php echo $cours->getTitre(); ?></title>
</head>

<?php

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
?>

<body>

<div class='header'>
    <nav>
        <a href='/Home.php' class='logo'>Handout</a>
    </nav>
</div>

<div class="dropdown topright header-right">
    <button class="dropbtn">Menu</button>
    <div class="dropdown-content">
        <a href="#"><?php echo $_COOKIE['prenom'] ?></a>
        <a onclick="on()" href="#">Modifier Profile</a>
        <a href="/Disconnect.php">Se déconnecter</a>
    </div>
</div>



<?php


$typeUser = $_COOKIE['type'];

echo "

    <div class='main'

        <div class='viewCours'>
            
            <h1>" . $cours->getTitre() ."</h1>
            
            <h5>Description:</h5>
            <p>" .  $cours->getDescription() . "</p>
            
            <h5>Module:</h5>
            <p>" . $cours->getModule() . "</p>
            
            <h5>Date</h5>
            <p>" . $cours->getAnnee() . "</p>
            
       

";

if ($typeUser != 'Etudiant') {
    if ($_GET['coursID'] != null) {
        echo  "<a class='button' href='../Delete.php?coursID=".$_GET['coursID']."'>Supprimer</a>";
    } else if ($_GET['devoirID'] != null) {
        echo  "<a class='button' href='../Delete.php?devoirID=".$_GET['devoirID']."'>Supprimer</a>";
    }
} else {
    if ($_GET['coursID'] != null) {
        echo  "<a class='button' href='../Download.php?coursID=".$_GET['coursID']."'>Diffuser</a>";
        echo  "<a class='button' href='../Download.php?coursID=".$_GET['coursID']."&download=1'>Télécharger</a>";
    } else if ($_GET['devoirID'] != null) {
        echo  "<a class='button' href='../Download.php?devoirID=".$_GET['devoirID']."'>Diffuser</a>";
        echo  "<a class='button' href='../Download.php?devoirID=".$_GET['devoirID']."&download=1'>Télécharger</a>";
        echo  "<o class='button' href='../UploadCompte.php?devoirID=".$_GET['devoirID']."&compteRendu=1'>Déposer Compte-Rendu</a>";

        echo "        <br> <br>
     <form action='../UploadDevoir.php' method='post' enctype='multipart/form-data'>
        <input type='file' class='button' name='fileToUpload'  id='fileToUpload'><br>
        <input type='submit' value='Ajouter' name='submit'>

    </form>

";

    }
}

echo "            
        </div>        
    </div>"
;


?>


<?php

$etudiantID = $_COOKIE['etudiantID'];
$typeUser = $_COOKIE['type'];

if ($typeUser != 'Etudiant') {
    echo " <div class='sidenav'>
                <a href='/Professeur/cours_.php'>Cours</a>
                <a href='/Professeur/devoir_.php'>Devoir</a>
                <a href='/Professeur/etudiant_.php'>Etudiant</a>
                <a href=\"\">Compte-Rendu</a>
            </div>
";

}
?>





</body>

</html>

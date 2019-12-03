<?php

include '../Connection.php';

session_start();

$expireAfter = 30;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Professeur/Style.css">
    <script src="../jQuery.js"></script>
    <title>Handout - Devoir</title>
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

<div>
    <a href='ajouterDevoir.php' class="button topright_">Ajouter</a>
</div>




<?php

$database = new Connection();

$professeur = $_COOKIE['etudiantID'];

$listCours = $database->getDevoirByProfesseurID($professeur);

echo "<div class='main'>
 <h3>Mes cours</h3>
";

foreach ($listCours as $cours) {

    echo "
                        <div class='row cours'>
                            <a href='/Cours/view.php?devoirID=".$cours->getDevoirID()."'>" . $cours->getTitre() ."</a><br>
                        </div>
                                            ";

}

echo "</div>";




?>


<div class='sidenav'>
    <a href='cours_.php'>Cours</a>
    <a href="devoir_.php">Devoir</a>
    <a href="etudiant_.php">Etudiant</a>
    <a href="">Compte-Rendu</a>
</div>


</body>

</html>

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/Professeur/Style.css">
    <script src="../jQuery.js"></script>
    <title>Handout - Cours</title>
</head>


<?php

$searchInput = $_GET['submit'];

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
        <a href="Disconnect.php">Se déconnecter</a>
    </div>
</div>


<form class="searchBar" action="Search.php" method="get">
    <input class="searchBar" type="text" placeholder="Chercher...">
    <input type="submit" class="searchInput" value="Chercher" name="submit">
</form>

<?php


$cours = $database->searcherCours($searchInput);



    echo "

                    <div class='row cours'>
                        <a href='/Cours/view.php?coursID=".$cours->getCoursID()."'>" . $cours->getTitre() ."</a><br>
                    </div>
                            
                                                    ";


?>


</body>
</html>


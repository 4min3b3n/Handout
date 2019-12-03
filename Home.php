<?php

include 'Connection.php';

session_start();

$expireAfter = 30;

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/jQuery.js"></script>
    <title>Handout</title>
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
        <a href="Disconnect.php">Se déconnecter</a>
    </div>
</div>


<form class="searchBar" action="Search.php" method="get">
    <input class="searchBar" type="text" placeholder="Chercher...">
    <input type="submit" class="searchInput" value="Chercher" name="submit">
</form>


<?php

$database = new Connection();

$etudiantID = $_COOKIE['etudiantID'];
$typeUser = $_COOKIE['type'];

if ($typeUser == 'Etudiant') {

    echo "  
            <div>
                <h2>Cours</h2>
             </div>";


    $professeurs = $database->getProfesseurID($etudiantID);

    foreach ($professeurs as $professeur) {

        $nomProfesseur = $database->getNomProfesseur_ByProfesseurID($professeur);

        $listCours = $database->getCoursByProfesseurID($professeur);

        echo "<div class='column'></div> ";

        if ($listCours != null) {

            echo "<h3>Liste des cours du professeur " . $nomProfesseur . ":</h3>";

            foreach ($listCours as $cours) {

                echo "

                    <div class='row cours'>
                        <a href='/Cours/view.php?coursID=".$cours->getCoursID()."'>" . $cours->getTitre() ."</a><br>
                    </div>
                            
                                                    ";

            }
        }

    }

    echo "  <div>
                <h2>Devoirs</h2>
            </div>";

    foreach ($professeurs as $professeur) {

        $nomProfesseur = $database->getNomProfesseur_ByProfesseurID($professeur);

        $listDevoir = $database->getDevoirByProfesseurID($professeur);

        if ($listDevoir != null) {

            echo "<h3>Liste des devoirs du professeur " . $nomProfesseur . ":</h3>";

            foreach ($listDevoir as $devoir) {

                echo "<div class='row cours'>
                        <a href='/Cours/view.php?devoirID=".$devoir->getDevoirID()."'>" . $devoir->getTitre() ."</a><br>                       
                    </div>";


            }
        }



    }

} else if ($typeUser == 'Professeur') {
    header('Location: Professeur/cours_.php');
    echo "  <div class='sidenav'>
                    <a href='Professeur/cours_.php'>Cours</a>
                    <a href='Professeur/devoir_.php'>Devoir</a>
                    <a href='Professeur/etudiant_.php'>Etudiant</a>
                    
            </div>";
}

?>





</body>
</html>
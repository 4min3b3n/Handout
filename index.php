<?php

session_start();

$expireAfter = 30;

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Style.css">
    <title>Handout - Connection</title>
</head>

<body>

<h1 class="front" >Handout</h1>

<?php

    if ((isset($_SESSION["Username"])) and ((isset($_SESSION["Password"])))) {
        header('Location: /Home.php');
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


<br>
<a class="button topright" href = "Register.html">S'inscrire</a> <br>
<br>

<form class="center" action = "Connect.php" method = "post">

    <h2>Connection</h2>


    <table>

        <tr>
            <input type="text" name="Username" placeholder="Enter votre email..." required> <br>
        </tr>

        <tr>
            <input type="password" name="Password" placeholder="Enter votre mot de passe" required> <br>
        </tr>

        <tr>
            <input class="inputbutton button" type="submit" value="Se Connecter"> <br>
        </tr>

    </table>



</form>

<div class="footer">
    <footer>Amine Benzaggagh, Anas Bourafa  - Projet Fin d'Année 2018 (ENSIAS)</footer>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Style.css">
    <script src="../jQuery.js"></script>
    <title>Handout - Ajouter Devoir</title>
</head>
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

<div class="center">

    <h2>Ajouter un devoir</h2>

    <form action="../UploadDevoir.php" method="post" enctype="multipart/form-data">

        <input name="Titre" type="text" placeholder="Titre" required><br>
        <input name="Description" type="text" placeholder="Description" required><br>
        <input name="Module" type="text" placeholder="Module" required><br>
        <input name="AnneeUniversitaire" type="text" placeholder="Annee Universitaire"><br>
        <input type="file" class="button" name="fileToUpload"  id="fileToUpload"><br>
        <input type="submit" value="Ajouter" name="submit">

    </form>

</div>


<div class='sidenav'>
    <a href='cours_.php'>Cours</a>
    <a href="devoir_.php">Devoir</a>
    <a href="#">Etudiant</a>
</div>












</body>
</html>
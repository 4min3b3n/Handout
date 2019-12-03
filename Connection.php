<?php

include 'Etudiant.php';
include 'Professeur.php';
include 'Cours.php';
include 'Devoir.php';

class Connection {

    protected $databaseUser = 'root';
    protected $databasePassword = '';
    protected $databaseHost = 'localhost';
    protected $databaseName = 'Handout';

    private $databaseConnection;

    public function __construct() {

        $this->databaseConnection = new mysqli($this->databaseHost, $this->databaseUser, $this->databasePassword, $this->databaseName);

        if (mysqli_connect_errno()) {
            printf("Connection failed: %s\ ", mysqli_connect_error());
            exit();
        }

        return $this->databaseConnection;
    }

    public function getDatabaseConnection() {
        return $this->databaseConnection;
    }

    public function getEtudiant($email) {

        $query = "SELECT * FROM Etudiant WHERE Email = '" . $email . "';";
        $result = $this->getDatabaseConnection()->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $etudiant = new Etudiant($row["EtudiantID"], $row["Nom"], $row["Prenom"], $row["Email"], $row["Password"]);
            return $etudiant;
        }
        return null;
    }

    public function getProfesseur($email) {
        $query = "SELECT * FROM Professeur WHERE Email = '" . $email . "';";
        $result = $this->getDatabaseConnection()->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $professeur = new Professeur($row["ProfesseurID"], $row["Nom"], $row["Prenom"], $row["Email"], $row["Password"]);
            return $professeur;
        }
        return null;
    }

    public function getEtudiantByID($etudiantID) {
        $query = "SELECT * FROM Etudiant WHERE EtudiantID = '" . $etudiantID . "';";
        $result = $this->getDatabaseConnection()->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $etudiant = new Etudiant($row["EtudiantID"], $row["Nom"], $row["Prenom"], $row["Email"], $row["Password"]);
            return $etudiant;
        }
        return null;
    }

    public function getProfesseurByID($professeurID) {
        $query = "SELECT * FROM Professeur WHERE ProfesseurID = '" . $professeurID . "';";
        $result = $this->getDatabaseConnection()->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $professeur = new Professeur($row["ProfesseurID"], $row["Nom"], $row["Prenom"], $row["Email"], $row["Password"]);
            return $professeur;
        }
        return null;
    }

    public function getMaxEtudiantID() {
        $query = "SELECT MAX(EtudiantID) FROM Etudiant;";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row["MAX(EtudiantID)"];
    }

    public function getMaxProfesseurID() {
        $query = "SELECT MAX(ProfesseurID) FROM Professeur;";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row["MAX(ProfesseurID)"];
    }


    public function addEtudiant($nom, $prenom, $email, $password) {
        $newEtudiantID = ($this->getMaxEtudiantID() + 1);
        $query = "INSERT INTO Etudiant VALUES (". $newEtudiantID . ", '" . $nom . "', '" . $prenom . "', '". $email . "', '" . $password . "');";
        $result = $this->getDatabaseConnection()->query($query);
        if ($result == TRUE) {
            return true;
        }
        return false;
    }

    public function addProfesseur($nom, $prenom, $email, $password) {
        $newProfesseurID = ($this->getMaxProfesseurID() + 1);
        $query = "INSERT INTO Professeur VALUES (". $newProfesseurID . ", '" . $nom . "', '" . $prenom . "', '". $email . "', '" . $password . "');";
        $result = $this->getDatabaseConnection()->query($query);
        if ($result == true) {
            return true;
        }
        return false;
    }

    public function checkExistingEmail($email) {

        $queryProfesseur = "SELECT ProfesseurID, Email FROM Professeur WHERE Email = '" . $email . "';";
        $queryEtudiant = "SELECT EtudiantID, Email FROM Etudiant WHERE Email = '" . $email . "';";

        $resultProfesseur = $this->getDatabaseConnection()->query($queryProfesseur);
        $resultEtudiant = $this->getDatabaseConnection()->query($queryEtudiant);

        $rowP = $resultProfesseur->fetch_assoc();
        $rowE = $resultEtudiant->fetch_assoc();

        if ($rowP["Email"] == $email or $rowE["Email"] == $email) {
            return true;
        } else {
            return false;
        }

    }

    public function getEtudiantID_ByEmail($email) {

        $query = "SELECT EtudiantID FROM Etudiant WHERE Email = '" . $email . "';";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();

        return $row["EtudiantID"];
    }

    public function getNomEtudiant_ByEmail($email) {

        $query = "SELECT Nom FROM Etudiant WHERE Email = '" . $email . "';";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();

        return $row["Nom"];
    }

    public function getPrenomEtudiant_ByEmail($email) {

        $query = "SELECT Prenom FROM Etudiant WHERE Email = '" . $email . "';";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();

        return $row["Prenom"];
    }

    public function getProfesseurID_ByEmail($email) {
        $query = "SELECT ProfesseurID FROM Professeur WHERE Email = '" . $email . "';";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();

        return $row["ProfesseurID"];
    }

    public function getNomProfesseur_ByProfesseurID($professeurID) {
        $query = "SELECT Nom FROM Professeur WHERE ProfesseurID = '". $professeurID ."';";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();

        return $row["Nom"];
    }

    public function getPrenomProfesseur_ByProfesseurID($professeurID) {
        $query = "SELECT Prenom FROM Professeur WHERE ProfesseurID = '". $professeurID ."';";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();

        return $row["Prenom"];
    }

    /* ----------------------------------- */

    public function getProfesseurID($etudiantID) {

        $query = "SELECT * FROM Classe WHERE EtudiantID = " . $etudiantID . ";";
        $result = $this->getDatabaseConnection()->query($query);

        $listProf = array();

        $i = 0;

        while($row = $result->fetch_assoc()) {
            $listProf[$i] = $row["ProfesseurID"];
            $i++;
        }

        return $listProf;
    }

    public function getCoursByProfesseurID($professeurID) {

        $query = "SELECT * FROM Cours WHERE ProfesseurID = " . $professeurID . ";";
        $result = $this->getDatabaseConnection()->query($query);

        $listCours = array();
        $i = 0;

        while($row = $result->fetch_assoc()) {
            $listCours[$i] = new Cours($row["CoursID"], $row["Titre"], $row["Description"], $row["Module"], $row["AnneeUniversitaire"], $row["ProfesseurID"], $row["FileID"]);
            $i++;
        }

        return $listCours;

    }

    public function getDevoirByProfesseurID($professeurID) {

        $query = "SELECT * FROM Devoir WHERE ProfesseurID = " . $professeurID . ";";
        $result = $this->getDatabaseConnection()->query($query);

        $listDevoir = array();
        $i = 0;

        while($row = $result->fetch_assoc()) {
            $listDevoir[$i] = new Devoir($row["DevoirID"], $row["Titre"], $row["Description"], $row["Module"], $row["AnneeUniversitaire"], $row["ProfesseurID"], $row["FileID"]);
            $i++;
        }

        return $listDevoir;

    }

    public function getMaxCoursID() {
        $query = "SELECT MAX(CoursID) FROM Cours;";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row["MAX(CoursID)"];
    }

    public function getMaxDevoirID() {
        $query = "SELECT MAX(DevoirID) FROM Devoir;";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row["MAX(DevoirID)"];
    }

    public function getMaxFileID() {
        $query = "SELECT MAX(FileID) FROM File;";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row["MAX(FileID)"];
    }

    public function getMaxCompteRenduID() {
        $query = "SELECT MAX(CompteID) FROM CompteRendu;";
        $result = $this->getDatabaseConnection()->query($query);
        $row = $result->fetch_assoc();
        return $row["MAX(CompteID)"];
    }

    public function ajouterCours($file, $path) {

        $fileID = ($this->getMaxFileID()+1);


        $firstQuery = "INSERT INTO File VALUES (" . $fileID . ", '" . $file . "', '" . $path . "')";

        $this->getDatabaseConnection()->query($firstQuery);

        return $fileID;
    }

    public function ajouterCoursBD($titre, $description, $module, $annee, $professeurID, $fileID) {

        $coursID = ($this->getMaxCoursID()+1);
        $query = "INSERT INTO Cours VALUES (". $coursID .", '" . $titre . "', '" . $description . "', '" . $module . "', '" . $annee . "', ". $professeurID . ", " . $fileID . ");";

        $this->getDatabaseConnection()->query($query);
    }

    public function ajouterDevoir($file, $path) {

        $fileID = ($this->getMaxFileID()+1);

        $firstQuery = "INSERT INTO File VALUES (" . $fileID . ", '" . $file . "', '" . $path . "')";

        $this->getDatabaseConnection()->query($firstQuery);

        return $fileID;
    }

    public function ajouterDevoirBD($titre, $description, $module, $annee, $professeurID, $fileID) {

        $devoirID = ($this->getMaxDevoirID()+1);
        $query = "INSERT INTO Devoir VALUES (". $devoirID .", '" . $titre . "', '" . $description . "', '" . $module . "', '" . $annee . "', ". $professeurID . ", " . $fileID . ");";

        $result = $this->getDatabaseConnection()->query($query);
    }

    public function getCours($coursID) {

        $query= "SELECT * FROM Cours WHERE CoursID = " . $coursID . ";";

        $result = $this->getDatabaseConnection()->query($query);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            return new Cours($row['CoursID'], $row['Titre'], $row['Description'], $row['Module'], $row['AnneeUniversitaire'], $row['ProfesseurID'], $row['FileID']);
        }

    }

    public function getDevoir($devoirID) {

        $query= "SELECT * FROM Devoir WHERE DevoirID = " . $devoirID . ";";

        $result = $this->getDatabaseConnection()->query($query);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            return new Devoir($row['DevoirID'], $row['Titre'], $row['Description'], $row['Module'], $row['AnneeUniversitaire'], $row['ProfesseurID'], $row['FileID']);
        }

    }

    public function SupprimerCours($coursID) {

        $firstQuery = "SELECT * FROM Cours JOIN File ON Cours.FileID = File.FileID WHERE CoursID = " . $coursID . ";";
        $resultFirstQuery = $this->getDatabaseConnection()->query($firstQuery);
        $rowFi = $resultFirstQuery->fetch_assoc();

        $query = 'DELETE FROM Cours WHERE CoursID = ' . $coursID . ';';
        $secondQuery = 'DELETE FROM File WHERE FileID = ' . $rowFi["FileID"] . ';';

        $this->getDatabaseConnection()->query($query);
        $this->getDatabaseConnection()->query($secondQuery);

        return $rowFi['Nom'];

    }

    public function SupprimerDevoir($devoirID) {

        $firstQuery = "SELECT * FROM Devoir JOIN File ON Devoir.FileID = File.FileID WHERE DevoirID = " . $devoirID . ";";
        $resultFirstQuery = $this->getDatabaseConnection()->query($firstQuery);
        $rowFi = $resultFirstQuery->fetch_assoc();

        $query = 'DELETE FROM Devoir WHERE DevoirID = ' . $devoirID . ';';
        $secondQuery = 'DELETE FROM File WHERE FileID = ' . $rowFi["FileID"] . ';';

        $this->getDatabaseConnection()->query($query);
        $this->getDatabaseConnection()->query($secondQuery);

        return $rowFi['Nom'];

    }

    public function getFileID_ByCoursID($coursID) {

        $firstQuery = "SELECT * FROM Cours JOIN File ON Cours.FileID = File.FileID WHERE CoursID = " . $coursID . ";";

        $result = $this->getDatabaseConnection()->query($firstQuery);

        $row = $result->fetch_assoc();

        return $row;
    }

    public function getFileID_ByDevoirID($devoirID) {

        $firstQuery = "SELECT * FROM Devoir JOIN File ON Devoir.FileID = File.FileID WHERE DevoirID = " . $devoirID . ";";

        $result = $this->getDatabaseConnection()->query($firstQuery);

        $row = $result->fetch_assoc();

        return $row;
    }

    public function getEtudiantsByProfesseurID($professeurID) {

        $query = 'SELECT * FROM Etudiant WHERE EtudiantID IN (SELECT EtudiantID FROM Classe WHERE ProfesseurID = '.$professeurID.');';

        $result = $this->getDatabaseConnection()->query($query);

            $listEtudiants = array();

            $i = 0;

            while($row = $result->fetch_assoc()) {
                $listEtudiants[$i] =  new Etudiant($row["EtudiantID"], $row["Nom"], $row["Prenom"], $row["Email"], $row["Password"]);
                $i++;
            }

            return $listEtudiants;
    }

    public function getEtudiantsNonInscritByProfesseurID($professeurID) {

        $query = 'SELECT * FROM Etudiant WHERE EtudiantID NOT IN (SELECT EtudiantID FROM Classe WHERE ProfesseurID = '.$professeurID.');';

        $result = $this->getDatabaseConnection()->query($query);

        $listEtudiants = array();

        $i = 0;

        while($row = $result->fetch_assoc()) {
            $listEtudiants[$i] =  new Etudiant($row["EtudiantID"], $row["Nom"], $row["Prenom"], $row["Email"], $row["Password"]);
            $i++;
        }

        return $listEtudiants;
    }

    public function addEtudiantToProfesseur($etudiantID, $professeurID) {

        $query = 'INSERT INTO Classe VALUES ('. $professeurID . ', ' . $etudiantID . ')';

        $result = $this->getDatabaseConnection()->query($query);

        if ($result == true) {
            return true;
        } else  {
            return false;
        }

    }

    public function supprimerEtudiantToProfesseur($etudiantID, $professeurID) {

        $query = 'DELETE FROM Classe WHERE EtudiantID = ' . $etudiantID . ' AND ProfesseurID = ' . $professeurID . ';';

        $result = $this->getDatabaseConnection()->query($query);

        if ($result == true) {
            return true;
        } else  {
            return false;
        }
    }


    public function searcherCours($titre) {

        $query = "SELECT CoursID FROM Cours WHERE Titre = '".$titre."';";
        $result = $this->getDatabaseConnection()->query($query);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            $coursID  = $row['CoursID'];

            return $this->getCours($coursID);

        } else {
            return header('Location: /index.php');
        }

    }

    public function ajouterCompte($file, $path) {

        $fileID = ($this->getMaxFileID()+1);

        $firstQuery = "INSERT INTO File VALUES (" . $fileID . ", '" . $file . "', '" . $path . "')";

        $this->getDatabaseConnection()->query($firstQuery);

        return $fileID;
    }

    public function ajouterCompteDB($titre, $etudiantID, $fileID) {

        $compteID = ($this->getMaxCompteRenduID()+1);

        $query = "INSERT INTO CompteRendu VALUES (" . $compteID. ", '" . $titre."', ".$etudiantID.", ".$fileID. ")";

        $this->getDatabaseConnection()->query($query);

    }




    public function __destruct() {
        $this->databaseConnection->close();
    }

}


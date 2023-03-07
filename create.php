<?php
/**
 * We gaan een verbinding maken met de MySQL database
 */
require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo 'Er is een verbinding gemaakt met de mysqldatabase';
    } else {
        echo 'Interne servererror, neem contact op met de databasebeheerder';
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}

$post = var_dump($_POST);

/**
 * We gaan een sql-query maken voor het wegschrijven van de formuliergegevens in de tabel Inschrijving
 */
// Schrijf de sql-insertquery
$sql = "INSERT INTO Inschrijving (inschrijfid
                            ,homeclub
                            ,lidmaatschap
                            ,looptijd
                            ,yanga_water
                            ,coach
                            ,training
                            ,email
                            ,datum_inschrijving)
        VALUES              (NULL
                            ,:homeclub
                            ,:lidmaatschap
                            ,:looptijd
                            ,:yanga
                            ,:coach
                            ,:training
                            ,:email
                            ,:datum_inschrijving);";

// Zorgt ervoor dat de default values '' of 'nee' wordt als er niets ingevuld is
$homeclub = (isset($_POST['homeclub'])) ? $_POST['homeclub'] : '';
$lidmaatschap = (isset($_POST['lidmaatschap'])) ? $_POST['lidmaatschap'] : '';
$looptijd = (isset($_POST['looptijd'])) ? $_POST['looptijd'] : '';
$yanga = (isset($_POST['yanga'])) ? $_POST['yanga'] : 'nee';
$coach = (isset($_POST['coach'])) ? $_POST['coach'] : 'nee';
$training = (isset($_POST['training'])) ? $_POST['training'] : 'nee';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$datum_inschrijving = (isset($_POST['datum_inschrijving'])) ? $_POST['datum_inschrijving'] : '';



// Maak de sql-query gereed om te worden afgevuurd op de mysql-database
$statement = $pdo->prepare($sql);

// De bindValue method bind de $_POST waarde aan de placeholder
$statement->bindValue(':homeclub', $homeclub, PDO::PARAM_STR);
$statement->bindValue(':lidmaatschap', $lidmaatschap, PDO::PARAM_STR);
$statement->bindValue(':looptijd', $looptijd, PDO::PARAM_STR);
$statement->bindValue(':yanga', $yanga, PDO::PARAM_STR);
$statement->bindValue(':coach', $coach, PDO::PARAM_STR);
$statement->bindValue(':training', $training, PDO::PARAM_STR);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->bindValue(':datum_inschrijving', $datum_inschrijving, PDO::PARAM_STR);

// Voer de sql-query uit op de database
$statement->execute();

echo "Het opslaan is gelukt";
// Link door naar read.php voor een overzicht van de gegevens in tabel Inschrijving
header('Refresh:4; url=read.php');
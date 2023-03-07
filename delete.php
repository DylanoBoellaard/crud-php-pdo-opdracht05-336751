<?php
// Voeg de verbindingsgegevens toe aan de delete.php
require('config.php');

// Maak de data sourcename string
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    if ($pdo) {
        // echo "Er is een verbinding met de database";
    } else {
        echo "Interne server-error";
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}

// Maak een delete query om een record in de tabel Afspraak te verwijderen
$sql = "DELETE FROM Inschrijving
        WHERE inschrijfid = :inschrijfid";

// Maak de query klaar voor het binden van een waarde aan de placeholder
$statement = $pdo->prepare($sql);

// Koppel de waarde van $_GET['id'] aan de placeholder :id
$statement->bindValue(':inschrijfid', $_GET['id'], PDO::PARAM_INT);

// Voer de query uit
$result = $statement->execute();

if ($result) {
    // Geef een melding dat het gelukt is
    echo "Het verwijderen van het record met id = {$_GET['id']} is gelukt";    
} else {
    echo "Interne server-error. Record is niet verwijderd...probeer het opnieuw";
}

header('Refresh:3; url=read.php');
<?php
/**
 * Maak een verbinding met de mysql-server en database
 */

// 1. Voeg een configuratiebestand toe
require('config.php');

// 2. Maak een data source name string
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    // 3. Maak een pdo-object aan voor het maken van de verbinding
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Er is verbinding met de mysql-server en database";
    } else {
        echo "Interne server-error. Probeer het later nog eens";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

// 4. Maak een select query voor het opvragen van de gegevens.
$sql = "SELECT naam FROM Vestiging";

$result = $pdo->query($sql);
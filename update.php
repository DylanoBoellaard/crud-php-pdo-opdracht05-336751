<?php
require('config.php');
require('vestiging.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Verbinding";
    } else {
        // echo "Interne error";
    }
} catch(PDOException $e) {
    $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Er is op het formulier knopje gedrukt";
    var_dump($_POST);
    try {
        $sql = "UPDATE inschrijfid
                SET homeclub = :homeclub,
                    lidmaatschap = :lidmaatschap,
                    looptijd = :looptijd,
                    yanga_water = :yanga_water,
                    coach = :coach,
                    training = :training,
                    email = :datumTijd,
                    datum_inschrijving = :datum_inschrijving

                WHERE inschrijfid = :inschrijfid";
        
        // Zorgt voor default values "nee"
        $yanga_water = (isset($_POST['yanga_water'])) ? $_POST['yanga_water'] : "nee";
        $coach = (isset($_POST['coach'])) ? $_POST['coach'] : "nee";
        $training = (isset($_POST['training'])) ? $_POST['training'] : "nee";


        $statement = $pdo->prepare($sql);
        $statement->bindValue(':inschrijfid', $_POST['id'], PDO::PARAM_INT);
        $statement->bindValue(':homeclub', $_POST['homeclub'], PDO::PARAM_STR);
        $statement->bindValue(':lidmaatschap', $_POST['lidmaatschap'], PDO::PARAM_STR);
        $statement->bindValue(':looptijd', $_POST['looptijd'], PDO::PARAM_STR);
        $statement->bindValue(':yanga_water', $_POST[$yanga_water], PDO::PARAM_STR);
        $statement->bindValue(':coach', $_POST[$coach], PDO::PARAM_STR);
        $statement->bindValue(':training', $_POST[$training], PDO::PARAM_STR);
        $statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $statement->bindValue(':datum_inschrijving', 'datum_inschrijving', PDO::PARAM_STR);

        $statement->execute();

        header('Refresh:3; url=read.php');
    } catch(PDOException $e) {
        echo 'Het record is niet geupdate, probeer het opnieuw.'; 
        header('Refresh:3; url=read.php');
    }
    exit();
} 

$sql = "SELECT inschrijfid
              ,homeclub as HC
              ,lidmaatschap as LM
              ,looptijd as LT
              ,yanga_water as YW
              ,coach as CO
              ,training as TR
              ,email as EM
              ,datum_inschrijving as DI
        FROM Inschrijving
        WHERE inschrijfid = :inschrijfid";

$statement = $pdo->prepare($sql);

$statement->bindValue(':inschrijfid', $_GET['id'], PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetch(PDO::FETCH_OBJ);

var_dump($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud-php-pdo-opdracht05</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>BASIC-FIT Utrecht</h3>

    <a href="read.php">Inschrijvingen</a>
    <form action="update.php" method="post">
        <label for="homeclub">Kies je homeclub:</label><br>
        <select name="homeclub" id="homeclub">
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?= $row['naam'] ?>"><?= $row['naam'] ?></option>
                <?php } ?>
            </select>
    <br>
    <br>
        <label for="lidmaatschap">Selecteer een lidmaatschap:</label><br>
            <input type="radio" name="lidmaatschap" id="comfort" value="comfort" required>
        <label for="comfort">Comfort</label>
            <input type="radio" name="lidmaatschap" id="premium" value="premium" required>
        <label for="premium">Premium</label>
            <input type="radio" name="lidmaatschap" id="allin" value="allin" required>
        <label for="allin">All in</label>
    <br>
    <br>
        <label for="looptijd">Looptijd:</label><br>
        <input type="radio" name="looptijd" id="jaarlidmaatschap" value="jaarlidmaatschap">
            <label for="jaarlidmaatschap">Jaarlidmaatschap</label>
        <input type="radio" name="looptijd" id="flex">
            <label for="flex">Flex optie</label>
    <br>
    <br>
        <label for="extra">Selecteer je extra's:</label><br>
        <input type="checkbox" name="extra" id="yanga" value="yanga">
            <label for="yanga">Yanga sportswater €2,50 per 4 weken</label>
    <br>
        <input type="checkbox" name="extra" id="coach" value="coach">
            <label for="coach">Personal online coach €60,00 eenmalig</label>
    <br>
        <input type="checkbox" name="extra" id="training" value="training">
            <label for="training">Personal training intro €25,00 eenmalig</label>
    <br>
    <br>
        <label for="email">E-mail:</label><br>
            <input type="email" name="email" id="email" value="<?= $result->EM ?>" required>
    <br>
    <br>
        <input type="datetime" name="date" id="date" hidden>
        <input type="submit" value="Sla op">
        <input type="reset" value="Reset">
    </form>
</body>
</html>
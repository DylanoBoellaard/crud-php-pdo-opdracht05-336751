<?php
require('vestiging.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud-php-pdo-opdracht05</title>
</head>
<body>
    <h3>BASIC-FIT Utrecht</h3>
    <a href="read.php">Inschrijvingen</a>
    <form action="create.php" method="post" onsubmit="setDateTime()">
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
        <input type="checkbox" name="yanga" id="yanga" value="ja">
            <label for="yanga">Yanga sportswater €2,50 per 4 weken</label>
    <br>
        <input type="checkbox" name="coach" id="coach" value="ja">
            <label for="coach">Personal online coach €60,00 eenmalig</label>
    <br>
        <input type="checkbox" name="training" id="training" value="ja">
            <label for="training">Personal training intro €25,00 eenmalig</label>
    <br>
    <br>
        <label for="email">E-mail:</label><br>
            <input type="email" name="email" id="email" required>
    <br>
    <br>
    <input type="hidden" name="datum_inschrijving" id="datum_inschrijving">
        <input type="submit" value="Sla op">
        <input type="reset" value="Reset">
    </form>

    <script>
    function setDateTime() {
        var now = new Date();
        var datetime = now.getFullYear() + '-' + (now.getMonth()+1) + '-' + now.getDate() + ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
        document.getElementById('datum_inschrijving').value = datetime;
    }
    </script>

</body>
</html>
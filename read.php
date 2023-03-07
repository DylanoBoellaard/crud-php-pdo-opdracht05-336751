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
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    // 4. Maak een select query voor het opvragen van de gegevens.
    $sql = "SELECT inschrijfid
                    ,homeclub
                    ,lidmaatschap
                    ,looptijd
                    ,yanga_water
                    ,coach
                    ,training
                    ,email
                    ,datum_inschrijving
            FROM Inschrijving
            ORDER BY inschrijfid";

    // 5. We bereiden de query voor met de method prepare()
    $statement = $pdo->prepare($sql);

    // 6. We vuren de query af op de mysql-database
    $statement->execute();

    // 7. We stoppen het resultaat van de query in de variabele $result
    $result = $statement->fetchAll(PDO::FETCH_OBJ);

    $rows = "";
    foreach ($result as $info) {
        $rows .= "<tr>
                    <td>$info->inschrijfid</td>
                    <td>$info->homeclub</td>
                    <td>$info->lidmaatschap</td>
                    <td>$info->looptijd</td>
                    <td>$info->yanga_water</td>
                    <td>$info->coach</td>
                    <td>$info->training</td>
                    <td>$info->email</td>
                    <td>$info->datum_inschrijving</td>
                    <td>
                        <a href='delete.php?id={$info->inschrijfid}'>
                            <img src='img/b_drop.png' alt='kruis'>
                        </a>
                    </td>
                    <td> 
                        <a href='update.php?id={$info->inschrijfid}'>
                            <img src='img/b_edit.png' alt='potlood'>
                        </a>
                    </td>
                  </tr>";
    }
?>

<link rel="stylesheet" href="css/style.css">
<a href="index.php">Homepage</a>
<h3>Inschrijvingen</h3>
<a href="index.php"><input type="button" value="Nieuwe inschrijving"></a>
<br><br>
<table border="1">
    <thead>
        <th>Id</th>
        <th>homeclub</th>
        <th>lidmaatschap</th>
        <th>looptijd</th>
        <th>yanga_water</th>
        <th>coach</th>
        <th>training</th>
        <th>email</th>
        <th>datum_inschrijving</th>
        <th></th>
        <th></th>   
    </thead>
    <tbody>
        <?= $rows; ?>   
    </tbody>
</table>
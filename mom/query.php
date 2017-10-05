<?php
// Zu Datenbank verbinden
$mysqli = new mysqli("25.83.12.108", "root", "SiSal2002");
$mysqli->set_charset("utf8");

// Sprache einstellen
setlocale(LC_ALL, "de_DE.UTF-8");

// Datenbank erstellen falls nicht vorhanden
$mysqli->query("CREATE DATABASE IF NOT EXISTS mom");
$mysqli->query("USE mom");
$mysqli->query("CREATE TABLE `anwesenheit` ( `id` INT NOT NULL AUTO_INCREMENT , `datum` DATE NOT NULL , `name` VARCHAR(255) NOT NULL , `art` INT NOT NULL , `betrag` INT NOT NULL DEFAULT 0 , `gemalt` TEXT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
?>

<table>
    <tr>
        <th>Datum</th>
        <th>Name</th>
        <th>Art</th>
        <th>Gemalt</th>
    </tr>

    <?php
    $list = true;
    
    if (isset($_GET["month"])) {
        list($year, $month) = explode("-", $_GET["month"]);
        $query = "SELECT * FROM anwesenheit WHERE YEAR(datum) = " . $year . " AND MONTH(datum) = " . $month . " ORDER BY datum DESC";
    }
    if (isset($_GET["year"])) {
        $query = "SELECT * FROM anwesenheit WHERE YEAR(datum) = " . $_GET["year"] . " ORDER BY datum DESC";
    }
    if (isset($_GET["typ"])) {
        $query = "SELECT * FROM anwesenheit WHERE art = " . $_GET["typ"] . " ORDER BY datum DESC";
    }
    if (isset($_GET["name"])) {
        $query = "SELECT * FROM anwesenheit WHERE name = '" . $_GET["name"] . "' ORDER BY datum DESC";
    }
    if (!isset($_GET["month"]) && !isset($_GET["year"]) && !isset($_GET["typ"]) && !isset($_GET["name"])) {
        $query = "SELECT * FROM anwesenheit ORDER BY datum DESC";
        $list = false;
    }

    $cnt = 0;
    
    $result = $mysqli->query($query);
    while ($ar = $result->fetch_assoc()) {
        $cnt++;
        echo '<tr>';
        $datum = strftime("%A, %d %B %Y", strtotime($ar["datum"]));
        echo "<td>$datum</td>";
        
        $result2 = $mysqli->query("SELECT * FROM teilnehmer WHERE id = '".$ar["name"]."'");
        while ($row = $result2->fetch_row()) {
            $name = $row[2] . " " . $row[1];
        }
        
        echo '<td>' . $name . '</td>';

        $art = array("Bezahlt", "Gutschein", "Probe", "Ferienkurs");
        if ($ar["art"] != 2) {
            if ($ar["gezahlt"]) {
                echo "<td>Gezahlt</td>";
            } else {
                $betrag = $ar["betrag"];
                echo '<td>' . $art[$ar["art"]] . " ($betrag &euro;)</td>";
            }
        } else {
            echo '<td>' . $art[$ar["art"]] . '</td>';
        }

        echo "<td>" . $ar["gemalt"] . "</td>";
    }
    if ($list) {
        echo "<pre>Es wurden $cnt Einträge aufgelistet.</pre>";
    }
    ?>

</table>
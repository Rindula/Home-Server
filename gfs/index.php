<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Ausleihe</title>
</head>
<body>
    <a href="scan.php?type=scan">Ausleihen / Zurücknehmen</a><br>
    <a href="scan.php?type=add">Gegenstand registrieren</a>
    <hr>
    <table>
        <tr><th>Name</th><th>Genre</th><th>Verliehen an</th><th>Verliehen am</th></tr>
    <?php
    require "connection.php";
    $r = $conn->query("SELECT a.an, z.bez, a.timestamp, k.genre, z.author FROM ausgeliehen AS a INNER JOIN bestand AS z ON a.id = z.id INNER JOIN beschreibung AS b ON b.id = a.id INNER JOIN genre AS k ON b.genre = k.id");
    echo $conn->error;
    while ($a = $r->fetch_array()) {
        $t = date("d.m.Y", strtotime($a[2]));
        echo "<tr><td>".$a[1]." (".$a[4].")</td><td>".$a[3]."</td><td>".$a[0]."</td><td>".$t."</td></tr>";
    }
    ?>
    </table>
</body>
</html>
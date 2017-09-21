<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ausleihe</title>
</head>
<body>
    <a href="scan.php?type=scan&step=1">Ausleihen / Zurücknehmen</a><br>
    <a href="scan.php?type=add">Gegenstand registrieren</a>
    <hr>
    <table>
        <tr><th>Bezeichnung</th><th>Konsole / Art</th><th>Verliehen an</th><th>Verliehem am</th></tr>
    <?php
    $conn = new mysqli("localhost", "root", "SiSal2002", "etiketten");
    $r = $conn->query("SELECT a.an, z.bez, a.timestamp, k.konsole FROM ausgeliehen AS a INNER JOIN zeug AS z ON a.id = z.id INNER JOIN beschreibung AS b ON b.id = a.id INNER JOIN konsole AS k ON b.konsole = k.id");
    echo $conn->error;
    while ($a = $r->fetch_array()) {
        $t = date("d.m.Y", strtotime($a[2]));
        echo "<tr><td>".$a[1]."</td><td>".$a[3]."</td><td>".$a[0]."</td><td>".$t."</td></tr>";
    }
    ?>
    </table>
</body>
</html>
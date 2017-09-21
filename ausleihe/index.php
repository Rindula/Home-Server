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
    <ul>
    <?php
    $conn = new mysqli("localhost", "root", "SiSal2002", "etiketten");
    $r = $conn->query("SELECT a.name, b.bez, a.timestamp, k.konsole FROM ausgeliehen a INNER JOIN beschreibung b ON a.id = b.id INNER JOIN konsole k ON b.konsole = k.id");
    echo $conn->error;
    while ($a = $r->fetch_array()) {
        $t = date("d.m.Y", strtotime($a[2]));
        echo "<li>".$a[1]." für ".$a[3]." | ".$a[0]." am ".$t."</li>";
    }
    ?>
    </ul>
</body>
</html>
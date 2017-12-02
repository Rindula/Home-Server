<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ausleihe</title>
</head>
<body class="container text-center">
    <a class="btn btn-block btn-primary" href="lent.php">Ausleihen</a>
    <a class="btn btn-block btn-secondary" href="scan.php?type=add">Gegenstand registrieren</a>
    <hr>
    <table class="table table-striped">
        <tr><th>Name</th><th>Autor</th><th>Genre</th><th>Verliehen an</th><th>Verliehen am</th></tr>
    <?php
    require "connection.php";
    $r = $conn->query("SELECT a.an, z.bez, a.timestamp, k.genre, z.author, b.code FROM ausgeliehen AS a INNER JOIN bestand AS z ON a.id = z.id INNER JOIN beschreibung AS b ON b.id = a.id INNER JOIN genre AS k ON b.genre = k.id");
    echo $conn->error;
    while ($a = $r->fetch_array()) {
        $t = date("d.m.Y", strtotime($a[2]));
        echo "<tr data-toggle=\"modal\" data-target=\"#".$a[5]."\"><td>".$a[1]."</td><td>".$a[4]."</td><td>".$a[3]."</td><td>".$a[0]."</td><td>".$t."</td></tr>";
    }
    ?>
    </table>
</body>
</html>
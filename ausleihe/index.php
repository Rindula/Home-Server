<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Ausleihe</title>
</head>
<body>
    <div class="btn-group m-2">
        <a class="btn btn-outline-warning" href="scan.php?type=scan">Ausleihen / Zurücknehmen</a><br>
        <a class="btn btn-info" href="scan.php?type=add">Gegenstand registrieren</a>
    </div>
    <hr>
    <table class="table table-striped">
        <tr><th>Bezeichnung</th><th>Konsole / Art</th><th>Verliehen an</th><th>Verliehen am</th></tr>
    <?php
    $conn = new mysqli("25.83.12.108", "root", "SiSal2002", "etiketten");
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
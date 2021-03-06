<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <title>Ausleihe</title>
</head>
<body class="container text-center m-t-3">
    <a class="btn btn-block btn-primary" href="lent.php">Ausleihen</a>
    <a class="btn btn-block btn-secondary" href="scan.php?type=add">Gegenstand registrieren</a>
    <hr>
    <table class="table table-striped table-hover">
        <thead>
            <tr><th>Name</th><th>Autor</th><th>Genre</th><th>Verliehen an</th><th>Verliehen am</th></tr>
        </thead>
        <tbody>
    <?php
    require "connection.php";
    $r = $conn->query("SELECT a.an, z.bez, a.timestamp, k.genre, ath.autor, b.id FROM ausgeliehen AS a INNER JOIN bestand AS z ON a.id = z.id INNER JOIN beschreibung AS b ON b.id = a.id INNER JOIN genre AS k ON b.genre = k.id INNER JOIN autoren AS ath ON ath.id = z.author ORDER BY a.timestamp DESC");
    echo $conn->error;
    while ($a = $r->fetch_array()) {
        $t = date("d.m.Y", strtotime($a[2]));
        $receiver = $a[0];
        $modalID = $a[5];
        $modalTitle = "Rücknahme bestätigen";
        $modalBody = "Sind Sie sicher, dass sie das Buch als zurückgegeben markieren möchten?<br><br><b>Titel:</b> ".$a[1]."<br><b>Autor:</b> ".$a[4]."<br><br><b>Verliehen an:</b> ".$a[0]."";
        echo "<tr data-toggle=\"modal\" data-target=\"#$modalID\"><td>".$a[1]."</td><td>".$a[4]."</td><td>".$a[3]."</td><td>".$receiver."</td><td>".$t."</td></tr>";
        include "createModal.php";
    }
    ?>
        </tbody>
    </table>
    <script src="js/bootstrap.js"></script>
</body>
</html>
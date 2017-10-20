<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Quittungen</title>
</head>
<body>
    <form action="enter.php" method="get">
        <button class="btn btn-info btn-block rounded-0" type="submit">Neue Rechnung</button>
    </form>
    <table class="table table-striped">
        <tr><th scope="col">Rechnungsnummer</th><th>Bezahlt von</th><th>Empfänger</th><th>Datum</th><th>Betrag</th><th>Nicht bezahlt</th></tr>
    <?php
        $conn = new mysqli("localhost", "root", "74cb0A0kER", "rechnungen");
        $conn->query("SET NAMES 'utf8'");
        $ret = $conn->query("SELECT r.für, r.bezahlt, r.id, p.name, p.vorname, pa.name as 'namea', pa.vorname as 'vornamea', r.timestamp, r.betrag FROM rechnung as r inner join personendaten as p on p.id = r.von inner join personendaten as pa on pa.id = r.an");
        $got = 0;
        $remain = 0;
        echo $conn->error;
        while($r = $ret->fetch_assoc()) {
            $timestamp = date("d.m.Y, G:i", strtotime($r["timestamp"]));
            $von = $r["name"] . ", " . $r["vorname"];
            $fur = $r["namea"] . ", " . $r["vornamea"];

            if ($r["bezahlt"] == 0) {
                $remain += $r["betrag"];
            } else {
                $got += $r["betrag"];
            }

            echo "<tr class='". (($r["bezahlt"] == 0) ? "table-danger" : "") ."'><td scope='row'><a href='fill.php?id=".$r["id"]."'>".$r["id"]."</a></td><td>".$von."</td><td>$fur</td><td>".$timestamp."</td><td>€".$r["betrag"]."</td><td>".(($r["bezahlt"] == 0) ? "<a class='btn btn-outline-success' data-toggle='tooltip' data-placement='left' title='Rechnung als bezahlt markieren' href='paybill.php?id=".$r["id"]."'>&#10004;</a>" : "<a class='btn btn-outline-warning' data-html='true' data-toggle='tooltip' data-placement='left' title='Rechnung als <b><u>NICHT</u></b> bezahlt markieren' href='paybill.php?revoke&id=".$r["id"]."'>&#10006;</a>")." <a class='btn btn-outline-danger fa fa-trash' data-toggle='collapse' href='#".$r["id"]."' aria-controls='".$r["id"]."' aria-expanded='false' title='Rechnung löschen'></a></td></tr>";
            echo "<tr data-toggle='collapse' id='".$r["id"]."' class='table-dark collapse'><td colspan='6' class='p-4'><span class='text-info'><strong>Löschen bestätigen!</strong> Bist du dir sicher, dass du Rechnung Nr. ".$r["id"]." löschen willst?<br><form action='deletebill.php' method='post'><button type='submit' class='btn btn-outline-success' name='id' value='".$r["id"]."'>Ja, bitte</button> <button type='reset' class='btn btn-danger' data-toggle='collapse' href='#".$r["id"]."' aria-controls='".$r["id"]."' aria-expanded='false'>Nee, hab mich vertan!</button></form></span></td></tr>";
        }

        $remain = number_format($remain, 2);
        $got = number_format($got, 2);

        echo "<tr class='table-success font-weight-bold text-success'><td scope='row'>Gesamt:</td><td></td><td></td><td></td><td>€$got</td><td class='text-danger'>€$remain</td></tr>";
    ?>
    </table>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>
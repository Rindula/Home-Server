<?php

function suppList($id) {
    $conn = new mysqli("localhost", "root", "SiSal2002", "support");
    $ret = $conn->query("SELECT * FROM supporter ORDER BY name");

    $out = "<form class='form' action='changeSupp.php' method='post'><input type='hidden' name='id' value='$id' /><select class='form-control' onChange='this.parentNode.submit()' size='1' name='name'>";

    while ($r = $ret->fetch_assoc()) {
        if($r["id"] == 0) {
            $disabled = "disabled selected";
        } else {
            $disabled = "";
        }
        $out .= "<option $disabled value='".$r["id"]."'>".$r["name"]."</option>";
    }

    $out .= "</select></form>";

    return $out;
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Tickets</title>
</head>
<body>
    <form action="/dashboard" method="get">
        <button class="btn btn-info btn-block rounded-0" type="submit">Zurück zum Dashboard</button>
    </form>
    <div class="table-responsive">
    <table id="dataTable" class="table table-striped dataTable">
        <thead>
            <tr role="row"><th scope="col">Ticketnummer</th><th>Eingereicht von</th><th>Bearbeitender Supporter</th><th>Datum</th><th>Steuerung</th></tr>
        </thead>
        <tbody>
    <?php
        $conn = new mysqli("localhost", "root", "SiSal2002", "support");
        $conn->query("SET NAMES 'utf8'");
        $ret = $conn->query("SELECT t.id, t.von, t.text, t.supporter, s.name, t.erledigt, t.timestamp FROM tickets as t inner join supporter as s on t.supporter = s.id");
        $got = 0;
        $remain = 0;
        $modal = "";
        echo $conn->error;
        while($r = $ret->fetch_assoc()) {
            //$text = str_replace("\n", "<br>", $r["text"]);
            $text = $r["text"];
            $timestamp = date("d.m.Y, G:i", strtotime($r["timestamp"]));
            $modalBody = "Bist du sicher, dass du Ticket Nr. " . $r["id"] . " löschen möchtest?";
            $modalTitle = "Löschen bestätigen";

            $modal .= '<div class="modal fade" id="'.$r["id"].'" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">'.$modalTitle.'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p>'.$modalBody.'</p></div><div class="modal-footer"><form action="deletebill.php" method="post"><button type="submit" class="btn btn-outline-danger" name="id" value="'.$r["id"].'">Ja, bitte</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button></form></div></div></div></div>';
            
            echo "<tr class='lead ". (($r["supporter"] == 0) ? "table-danger" : (($r["erledigt"] == 0) ? "table-info" : "" )) ."'><td scope='row'>".$r["id"]."</td><td>".$r["von"]."</td><td>".(($r["supporter"] == 0) ? suppList($r["id"]) : $r["name"])."</td><td>".$timestamp."</td><td>".(($r["erledigt"] == 0) ? "<a class='btn btn-outline-success' data-toggle='tooltip' data-placement='left' title='Ticket als gelöst markieren' href='paybill.php?id=".$r["id"]."'>&#10004;</a>" : "<a class='btn btn-outline-warning' data-html='true' data-toggle='tooltip' data-placement='left' title='Ticket als <b><u>NICHT</u></b> gelöst markieren' href='paybill.php?revoke&id=".$r["id"]."'>&#10006;</a>")." <a class='btn btn-outline-danger fa fa-trash' data-toggle='collapse' href='#".$r["id"]."' aria-controls='".$r["id"]."' aria-expanded='false' title='Ticket löschen'></a> <a class='btn btn-outline-info fa fa-info' data-toggle='collapse' href='#info_".$r["id"]."' aria-controls='info_".$r["id"]."' aria-expanded='false' title='Beschreibung anzeigen'></a></td></tr>";
            echo "<tr data-toggle='collapse' id='info_".$r["id"]."' class='table-dark collapse'><td colspan='6' class='p-4'><pre>".$text."</pre></td></tr>";
        }
    ?>
        </tbody>
    </table>
    <?= $modal ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $("#dataTable").DataTable();
        })
    </script>
</body>
</html>
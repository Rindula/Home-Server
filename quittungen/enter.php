<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Rechnung eintragen</title>
</head>
<body>
    <h1 class="display-1">Rechnung erstellen</h1><hr>
    <a class="m-1 btn btn-outline-danger" href="./">Zurück</a>
    <form class="p-4 form" action="enterbill.php" method="post">
    <div class="input-group">
        <span class="input-group-addon">€</span>
        <input required id="betrag" name="betrag" type="number" step=".01" min="0" class="form-control" autocomplete="off" placeholder="Betrag">
    </div>
    <br>
    <div class="form-group">
        <select required class="form-control" id="an" name="an">
            <option value="" selected disabled>--- Rechnungsempfänger ---</option>
            <?php
            $conn = new mysqli("localhost", "root", "SiSal2002", "quittungen");
            $conn->query("SET NAMES 'utf8'");

            $ret = $conn->query("SELECT * FROM personendaten WHERE id > 0 ORDER BY name");
            
            if ($ret->num_rows > 0) {
                while ($r = $ret->fetch_assoc()) {
                    echo "<option value='".$r["id"]."'>".$r["name"].", ".$r["vorname"]."</option>";
                }
            }
            ?>
        </select>
    </div>
    <br>
    <div class="input-group">
        <span class="input-group-addon fa fa-book"></span>
        <textarea name="für" id="für" class="form-control" autocomplete="off" placeholder="Für..."></textarea>
    </div>
    <br>
    <button class="btn btn-outline-success btn-block" type="submit">Rechnung erstellen</button>
    </form>
    <h1 class="display-4">Neuen Rechnungsempfänger eintragen</h1>
    <form class="p-4 form" method="post" action="addreceiver.php">
    <div class="input-group">
        <span class="input-group-addon">Name</span>
        <input required id="name" name="name" type="text" class="form-control" autocomplete="off" placeholder="Name">
    </div>
    <div class="input-group">
        <span class="input-group-addon">Vorname</span>
        <input required id="vorname" name="vorname" type="text" class="form-control" autocomplete="off" placeholder="Vorname">
    </div>
    <br>
    <button class="btn btn-outline-info" type="submit">Rechnungsempfänger eintragen</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
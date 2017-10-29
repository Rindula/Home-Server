<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Ausleihe | Gegenstand hinzufügen</title>
</head>
<body>
    <form class="form" action="query.php?type=add" method="post">
        <input class="form-control" placeholder="Bezeichnung" type="text" autofocus name="bez" id="bez"><br>
        <select class="form-control" name="konsole" id="konsole">
            <?php
            $conn = new mysqli("25.83.12.108", "root", "SiSal2002", "etiketten");

            $r = $conn->query("SELECT * FROM konsole");
            while($a = $r->fetch_assoc()) {
                echo "<option value='".$a["id"]."'>".$a["konsole"]."</option>";
            }
            ?>
        </select><br>
        <input class="form-control" placeholder="Code (0123456789)" type="text" name="code" id="code"><br>
        <input class="btn btn-success" type="submit" value="Hinzufügen">
    </form>
</body>
</html>
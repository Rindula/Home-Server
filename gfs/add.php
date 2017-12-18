<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ausleihe | Gegenstand hinzufügen</title>
</head>
<body class="container text-center">
    <a class="m-3 btn btn-danger btn-block" href="./" type="reset">Zurück</a>
    <form action="query.php?type=add" class="form" method="post">
        <input class="form-control" placeholder="Titel" type="text" autofocus name="bez" id="bez"><br><br>
        <select class="form-control" name="author" id="author">
            <option selected value="" disabled>--- Autor auswählen ---</option>
            <?php
            require "connection.php";

            $r = $conn->query("SELECT * FROM autoren");
            while($a = $r->fetch_assoc()) {
                echo "<option value='".$a["id"]."'>".$a["autor"]."</option>";
            }
            ?>
        </select><br><br>
        <select class="form-control" name="genre" id="genre">
            <option selected value="" disabled>--- Genre auswählen ---</option>
            <?php
            $r = $conn->query("SELECT * FROM genre");
            while($a = $r->fetch_assoc()) {
                echo "<option value='".$a["id"]."'>".$a["genre"]."</option>";
            }
            ?>
        </select><br><br>
        <input class="form-control" placeholder="ISBN (0123456789)" type="text" name="code" id="code" value="<?= (isset($_GET["isbn"])) ? $_GET["isbn"] : "" ; ?>"><br><br>
        <input class="btn btn-success" type="submit" value="Hinzufügen">
    </form>
    <hr>
    <form action="query.php?type=addA" method="post">
        <input type="text" name="autor" id="autor"><br><br>
        <input class="btn btn-success" type="submit" value="Autor Hinzufügen">
    </form>
</body>
</html>
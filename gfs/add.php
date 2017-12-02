<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ausleihe | Gegenstand hinzufügen</title>
</head>
<body class="container text-center">
    <form action="query.php?type=add" class="form" method="post">
        <input placeholder="Bezeichnung" type="text" autofocus name="bez" id="bez"><br><br>
        <input placeholder="Author" type="text" autofocus name="author" id="author"><br><br>
        <select name="genre" id="genre">
            <?php
            require "connection.php";

            $r = $conn->query("SELECT * FROM genre");
            while($a = $r->fetch_assoc()) {
                echo "<option value='".$a["id"]."'>".$a["genre"]."</option>";
            }
            ?>
        </select><br><br>
        <input placeholder="ISBN (0123456789)" type="text" name="code" id="code"><br><br>
        <input type="submit" value="Hinzufügen">
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ausleihe | Gegenstand hinzufügen</title>
</head>
<body>
    <form action="query.php?type=add" method="post">
        <input placeholder="Bezeichnung" type="text" autofocus name="bez" id="bez"><br>
        <select name="konsole" id="konsole">
            <?php
            $conn = new mysqli("25.83.12.108", "root", "SiSal2002", "etiketten");

            $r = $conn->query("SELECT * FROM konsole");
            while($a = $r->fetch_assoc()) {
                echo "<option value='".$a["id"]."'>".$a["konsole"]."</option>";
            }
            ?>
        </select><br>
        <input placeholder="Code (0123456789)" type="text" name="code" id="code"><br>
        <input type="submit" value="Hinzufügen">
    </form>
</body>
</html>
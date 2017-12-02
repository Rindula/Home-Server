<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ausleihe | Check</title>
</head>
<body class="container text-center">
    <form action="query.php?type=get" method="post">
        <input class="form-control" type="text" placeholder="ISBN" autofocus name="code" id="code"><br><br>
        <input class="btn btn-success" type="submit" value="Einlesen">
    </form>
</body>
</html>
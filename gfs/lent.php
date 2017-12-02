<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ausleihen | Name eingeben</title>
</head>
<body class="container text-center">
    <form action="query.php?type=lent" method="post">
        <input class="form-control" type="text" autofocus name="name" id="name"><br><br>
        <input class="form-control" type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <input class="btn btn-outline-success" type="submit" value="Ausleihen">
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ausleihen | Name eingeben</title>
</head>
<body class="container align-items-center">
    <form action="query.php?type=lent" method="post">
        <input type="text" autofocus name="name" id="name">
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <input type="submit" value="Ausleihen">
    </form>
</body>
</html>
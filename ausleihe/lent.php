<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Ausleihen | Name eingeben</title>
</head>
<body>
    <form class="form" action="query.php?type=lent" method="post">
        <input class="form-control" type="text" autofocus name="name" id="name">
        <input class="form-control" type="hidden" name="id" value="<?= $_GET["id"] ?>">
        <input class="btn btn-outline-success" type="submit" value="Ausleihen">
    </form>
</body>
</html>
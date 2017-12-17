<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ausleihen | Name eingeben</title>

    <script src="js/fetch.js"></script>

</head>
<body class="container text-center">
    <a class="m-3 btn btn-danger btn-block" href="./" type="reset">Zurück</a>
    <form action="query.php?type=lent" method="post">
        <input class="form-control" placeholder="Name" type="text" autofocus name="name" id="name">
        <input class="form-control" placeholder="ISBN" type="text" name="isbn" id="isbn">
        <input class="btn btn-outline-success" type="submit" value="Ausleihen">
    </form>
    <hr>
    <form action="" method="get">
        <h3>Suchen nach:</h3>
        <input placeholder="Titel" type="text" name="title" oninput="search_title(this.value)" id="title">
        <input placeholder="Autor" type="text" name="autor" oninput="search_author(this.value)" id="autor">
        <hr>
        <div class="list-group" id="list"></div>
    </form>
</body>
</html>
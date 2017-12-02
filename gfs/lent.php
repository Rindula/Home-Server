<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ausleihen | Name eingeben</title>

    <script>
        function search_title() {
            var xhttp = new XMLHttpRequest(text);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("list").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "query.php?type=searchT&q=" + text, true);
            xhttp.send();
        }
        function search_author(text) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("list").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "query.php?type=searchA&q=" + text, true);
            xhttp.send();
        }
    </script>

</head>
<body class="container text-center">
    <form action="query.php?type=lent" method="post">
        <input class="form-control" placeholder="Name" type="text" autofocus name="name" id="name">
        <input class="form-control" placeholder="ISBN" type="text" name="isbn" value="<?= $_GET["isbn"] ?>">
        <input class="btn btn-outline-success" type="submit" value="Ausleihen">
    </form>
    <hr>
    <form action="" method="get">
        <input placeholder="Titel" type="text" name="title" oninput="search_title(this.value)" id="title">
        <input placeholder="Autor" type="text" name="autor" oninput="search_author(this.value)" id="autor">
        <hr>
        <div class="list-group" id="list"></div>
    </form>
</body>
</html>
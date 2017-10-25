<?php

$conn = new mysqli("localhost", "root", "SiSal2002", "rechnungen");
$conn->query("SET NAMES 'utf8'");

if (!isset($_GET["id"])) {
    header("Location: ?id=1");
}

$lid = $_GET["id"];

$conn->query("INSERT INTO rechnung (rid, preis) VALUES ('$lid', '0') ON DUPLICATE KEY UPDATE rid = $lid");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Kasse</title>
    <script>
        function search(val) {
            var list = document.getElementById("list");
            var lastId = document.getElementById("lastId").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    list.innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "fetch.php?last=" + lastId + "&id=" + val, true);
            xhttp.send();
        }

        function filter(e, text) {
            if (e.keyCode == 13) {
                search(text.value);
                text.value = "";
            }
            return true;
        }
    </script>
</head>
<body onload="search('')">
    <a href="?id=<?= $lid + 1 ?>" class="btn btn-outline-success rounded-circle">Neue Rechnung</a>
    <input type="hidden" id="lastId" value="<?= $lid ?>">
    <input placeholder="Identifier hier eingeben..." class="form-control" type="text" onkeypress="filter(event, this)">
    <div class="list-group" id="list"></div>
</body>
</html>
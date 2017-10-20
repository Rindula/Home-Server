<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Liste</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script>
            var old = "";
            var xhttp = new XMLHttpRequest();
            function update(d) {
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (xhttp.responseText !== old) {
                            document.getElementsByTagName("div")[0].innerHTML = xhttp.responseText;
                            old = xhttp.responseText;
                        }
                    }
                    if (this.readyState == 4 && this.status != 200) {
                        document.getElementsByTagName("div")[0].innerHTML = "<h1>Es ist ein Verbindungsfehler aufgetreten!</h1>";
                        old = "";
                    }
                };
                xhttp.open("GET", "show.php?date=" + d, true);
                xhttp.send();
            }
        </script>
    </head>
    <body class="bg-dark">
        <input class="d-print-none form-control" id="datepick" value="<?= date("Y-m") ?>" type="month" onchange="update(this.value)"><h1 class="display-1 text-info d-print-none">Verbrauchsliste</h1>
        <div class="content-fluid"></div>
    </body>
    <script>
    setInterval(function() {
        update(document.getElementById("datepick").value);
    }, 1000);
    update("<?= date("Y-m") ?>");
    </script>
</html>
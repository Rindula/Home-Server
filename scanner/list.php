<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Liste</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
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
                        setTimeout(function() {
                            update(document.getElementById("datepick").value);
                        }, 1000);
                    }
                };
                xhttp.open("GET", "show.php?date=" + d, true);
                xhttp.send();
            }
        </script>
    </head>
    <body>
        <input id="datepick" value="<?= date("Y-m") ?>" type="month" onchange="update(this.value)"><h1 class="top">Verbrauchsliste</h1>
        <div></div>
    </body>
    <script>
    update("<?= date("Y-m") ?>");
    </script>
</html>
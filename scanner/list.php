<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Liste</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <script>
            var old = "";
            function update(d) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (xhttp.responseText !== old) {
                            document.getElementsByTagName("div")[0].innerHTML = xhttp.responseText;
                            old = xhttp.responseText;
                        }
                        setTimeout(function() {
                            update();
                        }, 1000);
                    }
                };
                xhttp.open("GET", "show.php?date=" + d, true);
                xhttp.send();
            }
        </script>
    </head>
    <body>
        <input type="month" onchange="update(this.value)">
        <div></div>
    </body>
    <script>
    update("<?= date("Y-m") ?>");
    </script>
</html>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Liste</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <script>
            var old = "";
            function update() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (xhttp.responseText !== old) {
                            document.getElementsByTagName("body")[0].innerHTML = xhttp.responseText;
                            old = xhttp.responseText;
                        }
                        setTimeout(function() {
                            update();
                        }, 1000);
                    }
                };
                xhttp.open("GET", "show.php", true);
                xhttp.send();
            }
        </script>
    </head>
    <body>
        
    </body>
    <script>
    update();
    </script>
</html>
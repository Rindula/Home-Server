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
        <div class="input-append date" id="datepicker" data-date="<?= date("Y-m") ?>" data-date-format="yyyy-mm">
            <input  type="text" readonly="readonly" name="date" >    
            <span class="add-on"><i class="icon-th"></i></span>      
        </div>
        <br>
        <a href="javascript:window.print()" role="button" class="btn btn-outline-info d-print-none">Drucken</a>
        <h1 class="display-1 text-info d-print-none">Verbrauchsliste</h1>
        <div class="content-fluid"></div>
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    
    <script>
    setInterval(function() {
        update(document.getElementById("datepick").value);
    }, 1000);
    update("<?= date("Y-m") ?>");
    $("#datepicker").datepicker( {
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    </script>
</html>
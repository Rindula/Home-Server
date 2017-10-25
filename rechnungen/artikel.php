<?php

$conn = new mysqli("localhost", "root", "SiSal2002", "rechnungen");
$conn->query("SET NAMES 'utf8'");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Artikel Liste</title>
    <style>
        @font-face {
            font-family: barcode;
            src: url(CarolinaBarUPC_Normal.ttf);
        }
        .barcode {
            font-family: barcode !important;
        }
    </style>
</head>
<body>
    <div class="content">
            <?php
            $ret = $conn->query("SELECT bez, identifier, preis FROM artikel");
            while ($r = $ret->fetch_assoc()) {
                echo "<div class='d-inline-block w-50 p-4 border'><div class='d-flex w-100 justify-content-between'><h5 class='mb-5'>".$r["bez"]."</h5><small class='text-muted'>".$r["preis"]."€</small></div><span class='h1 barcode'>*".$r["identifier"]."*</span></div>";
            }
            ?>
    </div>
</body>
</html>
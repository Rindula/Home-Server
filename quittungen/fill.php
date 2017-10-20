<?php

if(!isset($_GET["id"])) die();

$id = $_GET["id"];

$conn = new mysqli("localhost", "root", "74cb0A0kER", "rechnungen");
$conn->query("SET NAMES 'utf8'");
$ret = $conn->query("SELECT r.an, r.bezahlt, r.id, p.name, p.vorname, pa.name as 'namea', pa.vorname as 'vornamea', r.timestamp, r.betrag, r.für FROM rechnung as r inner join personendaten as p on p.id = r.von inner join personendaten as pa on pa.id = r.an WHERE r.id = '$id'");

$r = $ret->fetch_assoc();

$f = new NumberFormatter("de", NumberFormatter::SPELLOUT);
$worte = $f->format($r["betrag"]);
$timestamp = date("d.m.Y", strtotime($r["timestamp"]));
$von = $r["name"] . ", " . $r["vorname"];
$an = $r["namea"] . ", " . $r["vornamea"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <title>Document</title>
    <style>
        output {
            position: absolute;
            font-size: 150%;
        }
        #number {
            top: 35px;
            left: 440px;
        }
        #betrag {
            top: 80px;
            left: 600px;
        }
        #betragwort {
            top: 130px;
            left: 200px;
        }
        #von {
            top: 175px;
            left: 100px;
        }
        #an {
            top: 220px;
            left: 100px;
        }
        #fur {
            top: 270px;
            left: 100px;
        }
        #date {
            top: 365px;
            left: 100px;
        }
        #location {
            top: 365px;
            left: 350px;
        }
    </style>
</head>
<body>
    <img src="template.png" alt="Quittung">
    <output class="font-weight-bold" id="betrag"><?= $r["betrag"] ?></output>
    <output class="" id="number"><?= $r["id"] ?></output>
    <output class="" id="betragwort"><?= ucfirst($worte) ?></output>
    <output class="" id="von"><?= $von ?></output>
    <output class="" id="an"><?= $an ?></output>
    <output class="" id="fur"><?= $r["für"] ?></output>
    <output class="" id="date"><?= $timestamp ?></output>
    <output class="" id="location">Sinsheim</output>
</body>
</html>
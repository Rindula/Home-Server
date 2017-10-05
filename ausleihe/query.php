<?php

$t = $_GET["type"];
$conn = new mysqli("25.83.12.108", "root", "SiSal2002", "etiketten");

if ($t == "add") {
    $conn->query("INSERT INTO zeug (bez) VALUES ('".$conn->escape_string($_POST["bez"])."')");
    $r = $conn->query("SELECT max(id) FROM zeug");
    $id = $r->fetch_array()[0];
    $conn->query("INSERT INTO beschreibung (id, code, konsole) VALUES ('$id', '".$conn->escape_string($_POST["code"])."', '".$conn->escape_string($_POST["konsole"])."');");
}

if($t == "get") {
    $c = $conn->escape_string($_POST["code"]);

    $r = $conn->query("SELECT id FROM beschreibung WHERE code = '$c'");
    if($r->num_rows > 0) {
        $id = $r->fetch_array()[0];
    } else {
        die("<meta http-equiv=\"refresh\" content=\"3; URL=./scan.php?type=add\"><h1>Gegebstand existiert nicht im System! Bitte registriere ihn zuerst!</h1>");
    }

    $r = $conn->query("SELECT * FROM ausgeliehen WHERE id = '$id'");
    if($r->num_rows > 0) {
        $conn->query("DELETE FROM ausgeliehen WHERE id = '$id'");
    } else {
        header("Location: ./lent.php?id=$id");
        die();
    }
}

if($t == "lent") {
    $i = $conn->escape_string($_POST["id"]);
    $p = $conn->escape_string($_POST["name"]);

    $conn->query("INSERT INTO ausgeliehen (id, an) VALUES ('$i', '$p')");
}

header("Location: ./");
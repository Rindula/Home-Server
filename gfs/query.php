<?php

$t = $_GET["type"];
require "connection.php";

if ($t == "add") {
    $conn->query("INSERT INTO bestand (bez, author) VALUES ('".$conn->escape_string($_POST["bez"])."', '".$conn->escape_string($_POST["author"])."')");
    $r = $conn->query("SELECT max(id) FROM bestand");
    $id = $r->fetch_array()[0];
    $conn->query("INSERT INTO beschreibung (id, code, genre) VALUES ('$id', '".$conn->escape_string($_POST["code"])."', '".$conn->escape_string($_POST["genre"])."');");
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
    $i = $conn->escape_string($_POST["isbn"]);
    $p = $conn->escape_string($_POST["name"]);

    $r = $conn->query("SELECT id FROM beschreibung WHERE code = '$i'");
    if($r->num_rows > 0) {
        $id = $r->fetch_array();
        $id = $id[0];
        $conn->query("INSERT INTO ausgeliehen (id, an) VALUES ('$id', '$p')");
    } else {
        header("Location: ./scan.php?type=add&isbn=$i");
    }
}

header("Location: ./");
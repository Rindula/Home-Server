<?php

$t = $_GET["type"];
$conn = new mysqli("localhost", "root", "SiSal2002", "etiketten");

if ($t == "add") {
    $conn->query("INSERT INTO zeug (bez) VALUES ('".$conn->escape_string($_POST["bez"])."')");
    echo $conn->error . PHP.EOL;
    $r = $conn->query("SELECT max(id) FROM zeug");
    echo $conn->error . PHP.EOL;
    $id = $r->fetch_assoc["id"];
    $conn->query("INSERT INTO beschreibung (id, code, konsole) VALUES ($id, '".$conn->escape_string($_POST["code"])."', ".$conn->escape_string($_POST["konsole"]).");");
    echo $conn->error . PHP.EOL;
}

if($t == "get") {
    $c = $_POST["code"];


}
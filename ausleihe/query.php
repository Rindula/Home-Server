<?php

$t = $_GET["type"];
$conn = new mysqli("localhost", "root", "SiSal2002", "etiketten");

if ($t == "add") {
    $conn->query("INSERT INTO zeug (bez) VALUES ('".$conn->escape_string($_POST["bez"])."')");
    $r = $conn->query("SELECT max(id) FROM zeug");
    $id = $r->fetch_array()[0];
    $conn->query("INSERT INTO beschreibung (id, code, konsole) VALUES ($id, '".$conn->escape_string($_POST["code"])."', '".$conn->escape_string($_POST["konsole"])."');");
}

if($t == "get") {
    $c = $_POST["code"];


}
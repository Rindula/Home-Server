<?php

$t = $_GET["type"];
$conn = new mysqli("localhost", "root", "SiSal2002", "etiketten");

if ($t == "add") {
    $r = $conn->query("INSERT INTO zeug (bez) VALUES ('".$conn->escape_string($_POST["bez"])."'); SELECT max(id) FROM zeug;");
    $id = $r->fetch_assoc["id"];
    $conn->query("INSERT INTO beschreibung (id, code, konsole) VALUES ($id, '".$conn->escape_string($_POST["code"])."', ".$conn->escape_string($_POST["konsole"]).");");
}

if($t == "get") {
    $c = $_POST["code"];

    
}
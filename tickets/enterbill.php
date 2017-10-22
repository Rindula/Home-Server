<?php

$conn = new mysqli("localhost", "root", "SiSal2002", "support");
$conn->query("SET NAMES 'utf8'");


$name = $conn->real_escape_string($_POST["name"]);
$text = $conn->real_escape_string($_POST["text"]);


$conn->query("INSERT INTO rechnung (von, text) VALUES ('$name', '$text')");

echo "<script>location.replace('./')</script>";
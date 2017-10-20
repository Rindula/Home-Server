<?php

$conn = new mysqli("localhost", "root", "74cb0A0kER", "rechnungen");
$conn->query("SET NAMES 'utf8'");


$n = $conn->real_escape_string($_POST["name"]);
$v = $conn->real_escape_string($_POST["vorname"]);


$conn->query("INSERT INTO personendaten (name, vorname) VALUES ('$n', '$v')");

echo "<script>location.replace('./enter.php')</script>";
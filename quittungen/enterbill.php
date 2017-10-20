<?php

$conn = new mysqli("localhost", "root", "74cb0A0kER", "rechnungen");
$conn->query("SET NAMES 'utf8'");


$bet = $conn->real_escape_string($_POST["betrag"]);
$an = $conn->real_escape_string($_POST["an"]);
$fur = $conn->real_escape_string($_POST["für"]);


$conn->query("INSERT INTO rechnung (betrag, an, von, für) VALUES ('$bet', '0', '$an', '$fur')");

echo "<script>location.replace('./')</script>";
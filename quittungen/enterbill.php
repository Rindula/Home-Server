<?php

$conn = new mysqli("localhost", "root", "SiSal2002", "quittungen");
$conn->query("SET NAMES 'utf8'");


$bet = $conn->real_escape_string(str_replace(",", ".", $_POST["betrag"]));
$an = $conn->real_escape_string($_POST["an"]);
$fur = $conn->real_escape_string($_POST["für"]);


$conn->query("INSERT INTO rechnung (betrag, an, von, für) VALUES ('$bet', '0', '$an', '$fur')");

echo "<script>location.replace('./')</script>";
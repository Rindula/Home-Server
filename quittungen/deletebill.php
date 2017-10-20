<?php

if(!isset($_POST["id"])) die();

$id = $_POST["id"];

$conn = new mysqli("localhost", "root", "74cb0A0kER", "rechnungen");
$conn->query("SET NAMES 'utf8'");

$conn->query("DELETE FROM rechnung WHERE id = '$id'");

echo "<script>location.replace('./')</script>";
<?php

if(!isset($_POST["id"])) die();

$id = $_POST["id"];

$conn = new mysqli("localhost", "root", "SiSal2002", "quittungen");
$conn->query("SET NAMES 'utf8'");

$conn->query("DELETE FROM rechnung WHERE id = '$id'");

echo "<script>location.replace('./')</script>";
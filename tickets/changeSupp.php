<?php

if(!isset($_POST["id"])) die();

$id = $_POST["id"];
$supp = $_POST["name"];

$conn = new mysqli("localhost", "root", "SiSal2002", "support");
$conn->query("SET NAMES 'utf8'");

$conn->query("UPDATE tickets SET supporter = $supp WHERE id = '$id'");

echo "<script>location.replace('./')</script>";
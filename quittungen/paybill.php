<?php

if(!isset($_GET["id"])) die();

$id = $_GET["id"];

$conn = new mysqli("localhost", "root", "74cb0A0kER", "rechnungen");
$conn->query("SET NAMES 'utf8'");

if(isset($_GET["revoke"])) {
    $conn->query("UPDATE rechnung SET bezahlt = 0 WHERE id = '$id'");
} else {
    $conn->query("UPDATE rechnung SET bezahlt = 1 WHERE id = '$id'");
}
echo "<script>location.replace('./')</script>";
<?php

if(!isset($_GET["id"])) die();

$id = $_GET["id"];

$conn = new mysqli("localhost", "root", "SiSal2002", "support");
$conn->query("SET NAMES 'utf8'");

if(isset($_GET["revoke"])) {
    $conn->query("UPDATE tickets SET erledigt = 0 WHERE id = '$id'");
} else {
    $conn->query("UPDATE tickets SET erledigt = 1 WHERE id = '$id'");
}
echo "<script>location.replace('./')</script>";
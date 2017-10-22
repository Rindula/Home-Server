<?php

$conn = new mysqli("localhost", "root", "SiSal2002", "support");
$conn->query("SET NAMES 'utf8'");


$n = $conn->real_escape_string($_POST["name"]);


$conn->query("INSERT INTO supporter (name) VALUES ('$n')");

echo "<script>location.replace('./enter.php')</script>";
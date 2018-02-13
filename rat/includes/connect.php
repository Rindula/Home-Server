<?php
$database = "phprat";
$connect = mysqli_connect("localhost", "root","SiSal2002", $database);

mysqli_query($connect, "CREATE DATABASE IF NOT EXISTS $database");
?>

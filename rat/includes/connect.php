<?php
$database = "phprat";
$connect = mysqli_connect("25.83.12.108", "root","SiSal2002", $database);

mysqli_query($connect, "CREATE DATABASE IF NOT EXISTS $database");
?>

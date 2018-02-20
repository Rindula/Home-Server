<?php

$dbhost = "localhost";
$dbname = "appNews";
$dbuser = "root";
$dbpass = "SiSal2002";

$mysql = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$ret = $mysql->query("SELECT * FROM news WHERE newsDate BETWEEN now() AND DATE_ADD(NOW(), INTERVAL 14 DAY)");
while ($r = $ret->fetch_assoc()) {
    echo "<h1>".$r["title"]."</h1>";
    echo "<p>".$r["content"]."</p>";
}
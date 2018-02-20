<?php

$dbhost = "localhost";
$dbname = "appNews";
$dbuser = "root";
$dbpass = "SiSal2002";

$mysql = new mysqli($dbhost, $dbname, $dbuser, $dbpass);

$return = $mysql->query("SELECT * FROM news");
// WHERE newsDate < DATEADD(now(), 14) AND newsDate >= now()
while ($r = $return->fetch_assoc()) {
    echo "<h1>".$r["title"]."</h1>";
    echo "<p>".$r["content"]."</p>";
}
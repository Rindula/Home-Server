<?php

$type = $_GET["t"];

if (empty($type)) {
    http_response_code(400);
    die();
}

// Datenbankverbindung öffnen
$mysql = new mysqli("localhost", "root", "SiSal2002", "todo");

switch ($type) {
    case 'enter':
        if (empty($_GET["v"])) {
            http_response_code(400);
            die();
        }
        $value = $mysql->real_escape_string($_GET["v"]);

        $mysql->query("INSERT INTO list (entry) VALUES ('$value')");
        break;
    

    case 'list':
        $res = $mysql->query("SELECT * FROM list");
        while ($r = $res->fetch_assoc()) {
            echo "<li class='".(($r["done"] == 1) ? "checked" : "")."'>".$r["entry"]."</li>";
        }
        break;
    default:
        http_response_code(501);
        die();
        break;
}
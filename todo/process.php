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
        if (!isset($_GET["v"])) {
            http_response_code(400);
            die();
        }
        $value = $mysql->real_escape_string($_GET["v"]);

        $mysql->query("INSERT INTO list (entry) VALUES ('$value')");
        break;
    

    case 'list':
        $res = $mysql->query("SELECT * FROM list");
        while ($r = $res->fetch_assoc()) {
            $cl = "";
            $stamp = new DateTime(date("Y-m-d", strtotime($r["timestamp"])));
            $now = new DateTime();
            $now->modify('-1 week');
            $diff = $now->diff($stamp);
            $diff = $diff->format("%d");
            if ($diff >= 7)
            {
                $cl .= " wichtig";
            }
            echo "<li database-id='".$r["timestamp"]."' class='".(($r["done"] == 1) ? "checked" : "")."$cl'>".$r["entry"]." </li>";
        }
        break;

    case 'done':
        if (!isset($_GET["v"]) || !isset($_GET["v2"])) {
            http_response_code(400);
            die();
        }
        $value = $mysql->real_escape_string($_GET["v"]);
        $value2 = $mysql->real_escape_string($_GET["v2"]);

        $mysql->query("UPDATE list SET done = $value WHERE entry = '$value2'");
        break;

    case 'delete':
        if (!isset($_GET["v"])) {
            http_response_code(400);
            die();
        }
        $value = $mysql->real_escape_string($_GET["v"]);

        $mysql->query("DELETE FROM list WHERE entry = '$value'");
        break;
        
    default:
        http_response_code(501);
        die();
        break;
}
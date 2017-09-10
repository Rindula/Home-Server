<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'config/config.php';
include_once 'config/db_conn.php';

$sql = "CREATE TABLE IF NOT EXISTS actions ( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, actionName text not null, action text not null, description text null )ENGINE=InnoDB";
$mysqli->query($sql);

$action[] = "INSERT INTO actions(actionName, action, description) VALUES('Herunterfahren', '/sbin/shutdown -h now', 'Fährt den Computer herunter, sodass er manuell wieder gestartet werden muss.')";
$action[] = "INSERT INTO actions(actionName, action, description) VALUES('Neustarten', '/sbin/shutdown -r now', 'Fährt den Computer herunter, und startet ihn anschließend wieder.')";



foreach ($action as $a) {
    $mysqli->query($a);
}


$_SESSION["status"] = 0;
header("Location: ./install.php");

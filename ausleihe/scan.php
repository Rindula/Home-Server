<?php

$t = $_GET["type"];

switch ($t) {
    case 'scan':
        include "";
        break;
    
    case 'add':
        include "add.php";
        break;
    
    default:
        echo "<h1>Fehler in der Typen Variable!</h1>";
        break;
}
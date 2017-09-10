<?php

    list($fach, $aufgabe, $datum) = array($_POST["fach"], $_POST["aufgaben"], $_POST["datum"]);

    include "vars.php";
    include "verify.php";


	// Datenbankverbindung herstellen
    mysql_connect("213.202.252.221", "rindula", "SiSal2002");
	// Datenbank und Tabelle erstellen, falls noch nicht vorhanden
	mysql_query("CREATE DATABASE IF NOT EXISTS homeworks");
	// Datenbank auswählen
	mysql_select_db("homeworks");

    $query = "INSERT INTO `list` (`ID`, `Fach`, `Aufgaben`, `Datum`, `Erledigt`) VALUES (NULL, '$fach', '$aufgabe', '$datum', '0')";
    echo $query;
    mysql_query($query);

    echo '<script>window.location.replace("/hausaufgaben/")</script>';
?>
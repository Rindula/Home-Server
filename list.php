<?php

$str = file_get_contents('/proc/uptime');
$num = floatval($str);
$secs = fmod($num, 60);
$num = (int) ($num / 60);
$mins = $num % 60;
$num = (int) ($num / 60);
$hours = $num % 24;
$num = (int) ($num / 24);
$days = $num;

if ($days == 1) {
    $daysStr = "Tag";
} else {
    $daysStr = "Tage";
}

if ($hours == 1) {
    $hoursStr = "Stunde";
} else {
    $hoursStr = "Stunden";
}

if ($mins == 1) {
    $minsStr = "Minute";
} else {
    $minsStr = "Minuten";
}

$monat = date("F");
$jahr = date("Y");
// Ausgabe vom Monat und dem Jahr
echo "<h1>Terminkalender $monat, $jahr</h1>";

echo "<pre>Systemlaufzeit: $days $daysStr, $hours $hoursStr und $mins $minsStr</pre><p>Anzahl der Einträge: $anzahl_eintraege</p>";

include_once 'kalender/kalender.php';
?>

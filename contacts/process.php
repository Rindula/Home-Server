<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET["q"])) {
    $q = $_GET["q"];
} else {
    $q = "";
}

if (trim($q) == "") {
    $sql = "SELECT * FROM personen";
} else {
    $sql = "SELECT * FROM personen WHERE name LIKE '%$q%' OR vorname LIKE '%$q%'";
}

$db_link = new mysqli("25.83.12.108", "root", "SiSal2002", "kontakte");

$result = $db_link->query($sql);
echo( "<main>" );
while ($row = $result->fetch_assoc()) {

    $name = str_replace(strtolower($q), "<b><u>" . strtolower($q) . "</b></u>", $row["name"]);
    $vorname = str_replace(strtolower($q), "<b><u>" . strtolower($q) . "</b></u>", $row["vorname"]);
    $name = str_replace(strtoupper($q), "<b><u>" . strtoupper($q) . "</b></u>", $name);
    $vorname = str_replace(strtoupper($q), "<b><u>" . strtoupper($q) . "</b></u>", $vorname);

    $address = $row["plz"] . " " . $row["stadt"] . ", " . $row["strasse"] . " " . $row["nr"];
    $address = urlencode($address);

    $link = "https://www.google.de/maps/search/" . $address;

    list( $year, $month, $day ) = explode("-", $row["geb_date"]);
    $geb_date = "$day.$month.$year";

    $from = new DateTime($row["geb_date"]);
    $to = new DateTime('today');
    $alter = $from->diff($to)->y;

    $phone = $row["vorwahl"] . "/" . $row["telefon"];

    $out = "<a style='text-decoration: none; color: white;' target='cadress' href='$link'><article><h2>$name, $vorname</h2><p>Alter: $alter Jahre</p><p>Geburtsdatum: $geb_date</p><p>Telefon/Handy: $phone</p></article></a>";
    echo( $out );
}
echo( "</main>" );

$db_link->close();
?>
<?php

$mysqli = mysqli_connect("25.83.12.108", "root", "SiSal2002", "mom");
$mysqli->set_charset("utf8");
$datum = $_POST["datum"];
$name = $_POST["name"];
$art = $_POST["art"];
$betrag = $_POST["betrag"];
$gemalt = $_POST["gemalt"];
$gezahlt = $_POST["gezahlt"];

if ($gezahlt || trim($betrag) == "") {
    $betrag = 0;
}

if ($gezahlt == "on") {
    $gezahlt = 1;
} else {
    $gezahlt = 0;
}

$sql = "INSERT INTO anwesenheit (datum, name, art, betrag, gemalt, gezahlt) VALUES ('$datum', '$name', '$art', '$betrag', '$gemalt', '$gezahlt')";

$res = $mysqli->query($sql);
echo '<script type="text/javascript">window.close();</script>';
if ($res === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
?>
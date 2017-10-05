<?php

$mysqli = new mysqli("25.83.12.108", "root", "SiSal2002", "produktionen");
$result = $mysqli->query("SELECT * FROM Factorio_items");

while ($row = $result->fetch_assoc()) {
	echo str_replace(array("\n", "\t"), array("<br>", "&nbsp;&nbsp;&nbsp;&nbsp;"), print_r($row, true));
}

?>

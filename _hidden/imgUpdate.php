<?php
	include "../header.php";
	include "../_hidden/vars.php";

	// Lese Input...
	$id = $_GET["id"];
	$value = $_GET["link"];
	
	// Datenbankverbindung herstellen
        $conn = mysqli_connect("25.83.12.108", "root", $mySqlPassword, "myPasswords");
	
	
	if (isSet($_GET["delete"])) {
		unlink("..".htmlspecialchars_decode($value));
		$conn->query("UPDATE list SET account='/img/placeholder.png' WHERE ID='$id'");
	} else {
		$conn->query("UPDATE list SET account='$value' WHERE ID='$id'");
	}
	
	echo '<script>window.location.replace("/?section=passwörter")</script>';
?>

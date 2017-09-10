<?php

define('DATABASE_IP', 'localhost');
define('DATABASE_USER', 'root');
define('DATABASE_PASS', 'SiSal2002');
define('DATABASE_DATABASE', 'test');

if (!file_exists("./config/db_conn.php")) {
	$outString = "\$mysqli = mysqli_connect(DATABASE_IP, DATABASE_USER, DATABASE_PASS, DATABASE_DATABASE);";
	$handle = fopen("config/db_conn.php", "w") or die("Unable to open file!");
	fwrite($handle, "<?php\n\n" . $outString);
}

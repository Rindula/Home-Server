<?php
define ( 'MYSQL_HOST', 'localhost' );
define ( 'MYSQL_BENUTZER', 'root' );
define ( 'MYSQL_KENNWORT', 'SiSal2002' );
define ( 'MYSQL_DATENBANK', 'terminkalender' );
 
$db_link = @mysqli_connect (MYSQL_HOST,
                           MYSQL_BENUTZER,
                           MYSQL_KENNWORT,
                           MYSQL_DATENBANK);
 
if ( ! $db_link )
{
  // hier sollte dann später dem Programmierer eine
  // E-Mail mit dem Problem zukommen gelassen werden
  // die Fehlermeldung für den Programmierer sollte
  // das Problem ausgeben mit: mysql_error()
  die('keine Verbindung zur Zeit möglich - später probieren ');
}
?>

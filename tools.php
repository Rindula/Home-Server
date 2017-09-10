<head>
    <title>Rindulas Downloadpage</title>
    <link rel="stylesheet" href="../format.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
    <center><h1 style="text-decoration: underline; text-shadow: 1px 1px blue, -1px 1px blue, -1px -1px blue, 1px -1px blue; background-color: orange; color: grey; border: solid 5px black">Downloads</h1></center>
<?php
// Ordnername 
$ordner = "downloads"; //auch komplette Pfade möglich ($ordner = "download/files";)

// Ordner auslesen und Array in Variable speichern
$alledateien = scandir($ordner); // Sortierung A-Z
// Sortierung Z-A mit scandir($ordner, 1)               				

// Schleife um Array "$alledateien" aus scandir Funktion auszugeben
// Einzeldateien werden dabei in der Variabel $datei abgelegt
foreach ($alledateien as $datei) {

	// Zusammentragen der Dateiinfo
	$dateiinfo = pathinfo($ordner."/".$datei); 
	//Folgende Variablen stehen nach pathinfo zur Verfügung
	// $dateiinfo['filename'] =Dateiname ohne Dateiendung  *erst mit PHP 5.2
	// $dateiinfo['dirname'] = Verzeichnisname
	// $dateiinfo['extension'] = Dateityp -/endung
	// $dateiinfo['basename'] = voller Dateiname mit Dateiendung

	// Größe ermitteln zur Ausgabe
	$size = ceil(filesize($ordner."/".$datei)/1024); 
	//1024 = kb | 1048576 = MB | 1073741824 = GB

	// scandir liest alle Dateien im Ordner aus, zusätzlich noch "." , ".." als Ordner
	// Nur echte Dateien anzeigen lassen und keine "Punkt" Ordner
	// _notes ist eine Ergänzung für Dreamweaver Nutzer, denn DW legt zur besseren Synchronisation diese Datei in den Orndern ab
	if ($datei != "." && $datei != ".."  && $datei != "_notes") { 
	?>
    <a class="user" download href="<?php echo $dateiinfo['dirname']."/".$dateiinfo['basename'];?>"><?php echo utf8_encode($dateiinfo['filename']); ?></a> (<?php echo $dateiinfo['extension']; ?> | <?php echo $size ; ?>kb)<hr><br>
<?php
	};
 };
?>

    <br><br><a href="../">Zur&uuml;ck</a>
</body>
<?php
// Zu Datenbank verbinden
$mysqli = mysqli_connect("localhost", "root", "SiSal2002", "mom");
$mysqli->set_charset("utf8");
setlocale(LC_ALL, "de_DE.UTF-8");

if(isset($_GET["limit"]) && !empty($_GET["limit"])) {
    $result = $mysqli->query("Select b.name as 'Titel', b.hoehe as 'Höhe',b.breite as 'Breite',t.name as 'Technik',k.name as 'Kategorie' from Bilder as b inner join Techniken as t on b.technik = t.id inner join Kategorien as k on b.kategorie = k.id where verkauft = 'N' order by Rand() limit " . $mysqli->real_escape_string($_GET["limit"]));
} else {
    $result = $mysqli->query("Select b.name as 'Titel', b.hoehe as 'Höhe',b.breite as 'Breite',t.name as 'Technik',k.name as 'Kategorie' from Bilder as b inner join Techniken as t on b.technik = t.id inner join Kategorien as k on b.kategorie = k.id order by b.name");
}
echo "<table border=\"1\">";
echo "<tr><th>Titel</th><th>Maße</th><th>Technik</th><th>Kategorie</th></tr>";
while ($ar = $result->fetch_assoc()) {
    echo "<tr><td>".$ar["Titel"]."</td><td>".$ar["Höhe"]." x ".$ar["Breite"]."</td><td>".$ar["Technik"]."</td><td>".$ar["Kategorie"]."</td></tr>";
}
echo "</table>";
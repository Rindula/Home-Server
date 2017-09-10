<?php
require ('termin-konfiguration.php');
 
// Speichern neuer Daten
if ( $_POST['vorgang'] == 'neu' )
{
    speichere_daten ( $_POST['termin'] );
    header("Location: content.php?sec=kalender");
}
 
// Löschen von Einträgen
if ( $_GET['vorgang'] == 'loeschen' )
{
    loeschen_daten ( $_GET['id'] );
    header("Location: content.php?sec=kalender");
}
 
// Daten zum ändern anzeigen
if ( $_GET['vorgang'] == 'aendern' 
     AND 
     $_POST['vorgang'] <> 'update' 
   )
{
    anzeige_daten_zum_bearbeiten ( $_GET['id'] );

}
 
if ( $_POST['vorgang'] == 'update' )
{
    update_daten ( $_POST['termin'] );
    header("Location: content.php?sec=kalender");
}
 
// wenn ein Monat angegeben ist, Kontrolle der Angabe
if ( $_GET['monat'] )
{
  if ( (INT) $_GET['monat'] > 0 AND (INT) $_GET['monat'] < 13 )
  {
    $monat = (INT) $_GET['monat'];
  }
  else
  {
    // ohne Angabe wird der aktuelle Monat verwendet
    $monat = date("n");
  }
}
else
{
  // aktuelle Monat wird verwendet
  $monat = date("n");
}

if ( $_GET['jahr'] )
{
  if ( (INT) $_GET['jahr'] > 0 
       AND 
       (INT) $_GET['jahr'] < 3000 
     )
  {
    $jahr = (INT) $_GET['jahr'];
  }
  else
  {
    $jahr = date("Y");
  }
}
else
{
  $jahr = date("Y");
}
 
// Ausgabe vom Monat und dem Jahr
echo "<h1>Terminkalender $monat.$jahr</h1>";
 
$sql = "
SELECT
  id, datum, titel, beschreibung
FROM termine
WHERE
   YEAR(datum) = '$jahr'
AND
  MONTH(datum) = '$monat'
ORDER BY datum
";
 
$db_erg = $db_link->query( $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . $db_link->error());
}

 
// Ausgabe Tabelle mit Terminen
echo '<table border="1">';
echo "<tr><th>Datum</th><th>Termin</th><th>Löschen</th><th>Bearbeiten</th></tr>";
while ($zeile = $db_erg->fetch_assoc())
{
  echo '<tr>';
  echo '<td>'. $zeile['datum'] . '</td>';
  echo '<td>';
  echo '<b>'. $zeile['titel'] . '</b><br>';
  echo $zeile['beschreibung'];
  echo '</td>';
 
  echo '<td>';
  echo '<a style="padding: 10px;" href="content.php?sec=kalender&vorgang=loeschen&id=';
  echo $zeile['id'];
  echo '">&#10008;</a> ';
  echo '</td>';
 
  echo '<td>';
  echo '<a style="padding: 10px;" href="content.php?sec=kalender&vorgang=aendern&id=';
  echo $zeile['id'];
  echo '">&#9997;</a> ';
 
  echo '</td>';
 
  echo '</tr>';
}
echo '</table>';
 
// Vormonat Kontrolle, ob bereits Januar
if ( $monat == 1 )
{
    $vmonat = 12;
    $vjahr = $jahr - 1;
}
else
{
    $vmonat = $monat - 1;
    $vjahr = $jahr;
}
 
echo '<a href="content.php?sec=kalender';
echo '&monat='. $vmonat;
echo '&jahr='. $vjahr;
echo '">Vormonat</a>';
 
echo ' | ';
 
echo '<a href="content.php?sec=kalender';
echo '">akt. Monat</a>';
 
echo ' | ';
 
// nächster Monat - Kontrolle, ob bereits Dezember
if ( $monat == 12 )
{
    $nmonat = 1;
    $njahr = $jahr + 1;
}
else
{
    $nmonat = $monat + 1;
    $njahr = $jahr;
}
echo '<a href="content.php?sec=kalender';
echo '&monat='. $nmonat;
echo '&jahr='. $njahr;
echo '">nächster Monat</a>';
 
 
// Anzeige Formular
echo '<hr>';
echo '<form name="" action="content.php?sec=kalender" method="POST">';
 
echo '<p>Datum<br>';
echo '<input type="date" name="termin[datum]" value="">';
echo '</p>';
 
echo '<p>Kurzbeschreibung<br>';
echo '<input type="text" name="termin[kurzbeschreibung]" autocomplete="off">';
echo '</p>';
 
echo '<p>ausführliche Beschreibung<br>';
echo '<textarea name="termin[beschreibung]" rows="9" ';
echo ' cols="80"></textarea></p>';
 
echo '<input type="hidden" name="vorgang" value="neu">';
 
echo '<input type="Submit" value="speichern">';
echo '</form>';
 
 
// Daten speichern
function speichere_daten ( $termin )
{
  // hier sollte noch eine Validierung des 
  // Datums stattfinden
  global $db_link;
  $sql = "INSERT INTO termine
          (
           `datum`,`titel`,`beschreibung`
          )
          VALUES
          (
            '". $termin['datum'] ."',
            '". $termin['kurzbeschreibung'] ."',
            '". $termin['beschreibung'] ."'
          )
       ";
 
    $db_erg = $db_link->query( $sql );
    if ( ! $db_erg )
    {
        die("Ungültige Abfrage: $sql <hr>" . $db_link->error());
    }
    else
    {
        echo "<h2>Termin gespeichert</h2>";
    }
}
 
function loeschen_daten ( $id ) {
    global $db_link;
    $sql = "DELETE FROM termine
            WHERE id='$id'
            LIMIT 1
            ";
 
    $db_erg = $db_link->query( $sql );
    if ( ! $db_erg )
    {
      die("Ungültige Abfrage: $sql <hr>" . $db_link->error());
    }
    else
    {
      echo "<h2>Termin gelöscht</h2>";
    }
}
 
function anzeige_daten_zum_bearbeiten ($id)
{
  global $db_link;
  $sql = " SELECT *
           FROM termine
           WHERE id = '$id'
         ";
 
  $db_erg = $db_link->query( $sql );
  if ( ! $db_erg )
  {
    die('Ungültige Abfrage: ' . $db_link->error());
  }
 
  $zeile = $db_erg->fetch_assoc();
 
  echo '<form action="content.php?sec=kalender" method="POST">';
 
  echo '<p>Datum<br>';
  echo '<input type="date" name="termin[datum]" value="';
  echo $zeile['datum'];
  echo '" size="10" maxlength="10">';
  echo '</p>';
 
  echo '<p>Kurzbeschreibung<br>';
  echo '<input type="text" name="termin[kurzbeschreibung]" ';
  echo ' value="';
  echo $zeile['titel'];
  echo '" size="50" maxlength="255">';
  echo '</p>';
 
  echo '<p>ausführliche Beschreibung<br>';
  echo '<textarea name="termin[beschreibung]" rows="9" ';
  echo ' cols="80">';
  echo $zeile['beschreibung'];
  echo '</textarea></p>';
 
  echo '<input type="hidden" name="termin[id]" value="';
  echo $zeile['id'];
  echo '">';
  echo '<input type="hidden" name="vorgang" value="update">';
 
  echo '<input type="Submit" value="Änderung speichern">';
  echo '</form>';
  echo '<hr>';
}
 
// Daten updaten
function update_daten ( $termin )
{
    global $db_link;
    // hier sollte noch eine Validierung des Datums stattfinden
    $sql = "UPDATE termine SET
        `datum` = '". $termin['datum'] ."',
        `titel` = '". addslashes($termin['kurzbeschreibung']) ."',
        `beschreibung` = '". addslashes($termin['beschreibung']) ."'
    WHERE
        id = '". $termin['id'] ."'
    ";
 
    $db_erg = $db_link->query( $sql );
    if ( ! $db_erg )
    {
        die("Ungültige Abfrage: $sql <hr>" . $db_link->error());
    }
    else
    {
        echo "<h2>Termin geupdatet</h2>";
    }
}
?>

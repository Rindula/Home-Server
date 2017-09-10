<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Char Test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="../scripts/chart.js/dist/Chart.js"></script>
    </head>
    <body>
    <?php
    $werte = array("Katze" => 40, "Hund" => 65, "Nagetier" => 12, "Sonstiges" => 13);
 
    $breite = 400;
    $hoehe = 300;
    $radius = 200;
    $start_x = ($breite/3)*2;
    $start_y = $hoehe/2;
 
    $rand_oben = 20;
    $rand_links = 20;
    $punktbreite = 10;
    $abstand = 10;
    $schriftgroesse = 10;
 
    $diagramm = imagecreatetruecolor($breite, $hoehe);
 
    $schwarz = imagecolorallocate($diagramm, 0, 0, 0);
    $weiss = imagecolorallocate($diagramm, 255, 255, 255);
 
    $r = 0;
    $g = 45;
    $b = 45;
    $farbabstufung = 40;
 
    imagefill($diagramm, 0, 0, $weiss);
 
    $i = 0;
    $winkel = 0;
    arsort($werte);
    $gesamt = array_sum($werte);
    foreach ($werte as $key => $value) {
          $i++;
          $start = $winkel;
          $winkel = $start + $value*360/$gesamt;
 
          $color = imagecolorallocate($diagramm, $r+($i-1)*$farbabstufung, $g+($i-1)*$farbabstufung, $b+($i-1)*$farbabstufung);
 
          imagefilledarc($diagramm, $start_x, $start_y, $radius, $radius, $start, $winkel, $color, IMG_ARC_PIE);
 
          $unterkante = $rand_oben+$punktbreite+($i-1)*($punktbreite+$abstand);
          imagefilledrectangle($diagramm, $rand_links, $rand_oben+($i-1)*($punktbreite+$abstand), $rand_links+$punktbreite, $unterkante, $color);
          imagettftext($diagramm, $schriftgroesse, 0, $rand_links+$punktbreite+5, $unterkante-$punktbreite/2+$schriftgroesse/2, $schwarz, "arial.ttf", $key." ".round($value*100/$gesamt, 0)." %");
    }
    imagepng($diagramm, "kreisdiagramm.png");
?>
    </body>
</html>

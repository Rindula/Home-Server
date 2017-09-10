<?php
/*
 * Alle Rechte dieser Website liegen bei Sven Nolting.
 * Medien können unter Umständen von anderen Seiten sein.
 * Die Nutzung dieser Website und ihrer Scripte sind !NACH ANFRAGE! erlaubt oder halt nicht.
 */

$outStr = exec("sudo hddtemp /dev/sda");
$outCpu = exec("acpi -t");

list($dev, $name, $tempStr) = explode(": ", $outStr);
list($s, $s, $stat,$tempCpu) = explode(" ", $outCpu);

?>
<table style="width: 100%;">
    <tr><td><?= $dev ?></td><td><?= $name ?></td><td><?= $tempStr ?></td></tr>
    <tr><td>CPU</td><td><?= str_replace(",", "", $stat) ?></td><td><?= $tempCpu ?></td></tr>
</table>
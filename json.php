<style>
	tr:nth-child(even) {background: #DFD}
	tr:nth-child(odd) {background: #DDF}
</style>
<table style='border: 1px solid'>
<?php
$jsonfile = file_get_contents('http://diemalztiere.de/apis/haapi.php?hausaufgaben');
echo $jsonfile;
$jsonarray = json_decode($jsonfile, true);
foreach ($jsonarray[0] as $key=>$value){
	echo "<h2>".gettype(intval($value[0]))."</h2><span>".intval($value[0])."</span>";
                if(intval(date( "N" )) == $key) {
                    if ((intval(date("G")) >= intval($value["maxHour"])) || (intval(date("G")) == intval($value["maxHour"]) && intval(date("i")) >= intval($value["maxMin"]))) {
                        echo "<td><h1>".$key."</h1></td><td><p>".$value['maxHour'].":".$value["maxMin"]."</p></td>";
                        $break = true;
                    }
                }
        }
?>
</table>
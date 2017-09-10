<style>
    html {
        background-color: #5a5a5a;
        color: white;
    }
    
    .zuErledigen {
        background-color: rgba(255, 0, 0, 0.25);
    }
    .erledigt {
        background-color: rgba(0, 255, 0, 0.25);
    }
    .datum, .fach, .aufgaben {
        font-family: monospace;
        font-size: 20px;
    }
    .fach {
        width: 100px;
        text-align: center;
		background-color: rgba(0, 0, 0, 0.3);
    }
    .aufgaben {
        width: 500px;
        padding: 5px;
    }
    .datum {
        width: 120px;
        text-align: center;
		background-color: rgba(255, 255, 255, 0.3);
    }
    .fertig {
        background-color: rgba(0, 57, 163, 0.5);
    }
    
    td {
        border-radius: 10px;
        transition: 0.5s cubic-bezier(0.22, 0.61, 0.36, 1);
		border: 2px solid black;
    }
    
    th {
        font-size: 30px;
        color: #f47316;
    }
    
    .aufgaben:hover {
        border-radius: 20px;
        background-color: rgba(98, 0, 255, 0.25);
        cursor: pointer;
    }
    
    .fertig:hover {
        border-radius: 5px;
        background-color: rgba(0, 57, 163, 0.5);
        cursor: default;
    }
    
    @keyframes imp {
        0% {
            background-color: rgba(255, 0, 0, 0.25);
        }
        50% {
            background-color: rgba(255, 157, 0, 0.75);
        }
        100% {
            background-color: rgba(255, 0, 0, 0.25);
        }
    }
    .dringend {
        background-color: rgba(255, 0, 0, 0.25) !important;
        animation: imp 2s infinite !important;
    }
    
    #uhr { position:absolute; top:10px; right:10px; font-family:monospace; font-size:34px; color:#00ffff; text-shadow: 0 0 5px #a6ffff; background-color: #5914dc; padding: 10px; border-radius: 10px}
    
    #add { position:absolute; top:100px; right:10px; font-family:monospace; font-size:34px; color:#ff4500; text-shadow: 0 0 5px #a6ffff; background-color: #14dc87; padding: 10px; border-radius: 10px; border: 10px inline black; transition: 0.2s linear; cursor: pointer}
    
    #add:hover {
        background-color: chartreuse;
    }
    
</style>

<script language="JavaScript">
     <!--

      var interval = window.setInterval("uhr_anzeigen()", 100);

      function uhr_anzeigen() {
        var Datum = new Date()
        var stunde = Datum.getHours()
        var minute = Datum.getMinutes()
        var sekunde = Datum.getSeconds()

        Zeit = ((stunde < 10) ? " 0" : " ") + stunde
        Zeit += ((minute < 10) ? ":0" : ":") + minute
        Zeit += ((sekunde < 10) ? ":0" : ":") + sekunde
        Zeit += " Uhr"

        document.getElementById('uhr').innerHTML=Zeit;
          
      }
     // -->
    </script>

<script>
    function setDone(id) {
        location.replace("/_hidden/setDone.php?id=" + id);
    }
</script>

<body onload="uhr_anzeigen()">
    <div id="uhr">&nbsp;</div>
<div id="content">
<?php
	
	$title =  "Hausaufgaben";
    $exitLink = "/hausaufgaben/show";
	
	include "../header.php";
	include "../_hidden/vars.php";
	include "../_hidden/verify.php";


	// Datenbankverbindung herstellen
    mysql_connect("213.202.252.221", "rindula", "SiSal2002");
	// Datenbank und Tabelle erstellen, falls noch nicht vorhanden
	mysql_query("CREATE DATABASE IF NOT EXISTS homeworks");
	// Datenbank auswählen
	mysql_select_db("homeworks");
	$queryCreateTable = "CREATE TABLE IF NOT EXISTS `list` ( `ID` INT NOT NULL AUTO_INCREMENT , `Fach` VARCHAR(255) NULL DEFAULT NULL , `Aufgaben` VARCHAR(255) NULL DEFAULT NULL , `Datum` DATE NOT NULL , `Erledigt` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
	$out = mysql_query($queryCreateTable);
            ?>
            <table>
                <th>Fach</th>
                <th>Aufgaben</th>
                <th>Zieldatum</th>
        <?php
    $result = mysql_query("SELECT * FROM list ORDER BY Datum Asc");
    while ($ar = mysql_fetch_array($result)) 
    {
        $today = strtotime(date("Y-m-d"));
        $expiration_date = strtotime($ar["Datum"]);
        list($year, $month, $day) = explode("-", $ar["Datum"]);
        if ($expiration_date < $today) {
            continue;
        }
            if ($ar["Erledigt"] == "0"){
                if ($expiration_date <= $today + (1*60*60*24)) {
                    echo "<tr id='".$ar['ID']."' class='dringend'>";
                }else{
                    echo "<tr id='".$ar['ID']."' class='zuErledigen'>";
                }
            } else {
                echo "<tr id='".$ar['ID']."' class='erledigt'>";
            };
        
        if ($ar["Erledigt"] != "0" && ($expiration_date <= $today)){
            echo "<td class='fach fertig'>".utf8_encode($ar["Fach"])."</td>";
            echo "<td class='aufgaben fertig'>".utf8_encode($ar["Aufgaben"])."</td>";
            echo "<td class='datum fertig'>$day.$month.$year</td>";
        } else {
            echo "<td class='fach'>".utf8_encode($ar["Fach"])."</td>";
            echo "<td class='aufgaben' onclick='setDone(".$ar["ID"].")'>".utf8_encode($ar["Aufgaben"])."</td>";
            echo "<td class='datum'>$day.$month.$year</td>";
        }
        echo "</tr>";
    }
    ?>
</table>
    <div onclick="location.assign('/hausaufgaben/enter');" id="add">Hinzufügen</div>
</div>
</body>

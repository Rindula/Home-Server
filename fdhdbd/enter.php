<style>
    html {
        background-color: #5a5a5a;
        color: white;
    }
    
    form, h1 {
        text-align: center;
    }
    
    h1 {
        color: #f47316;
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

<div id="uhr">&nbsp;</div>
<div onclick="location.assign('/hausaufgaben/');" id="add">Zurück</div>
<?php
	
	$title =  "Hausaufgaben eintragen";
	
	include "../header.php";
	include "../_hidden/vars.php";
	include "../_hidden/verify.php";

?>
<h1>Hausaufgaben eintrag</h1>
<form action="../_hidden/enterHW.php" method="post">
    <label for="fach">Fach:</label>
    <select required id="fach" name="fach">
        <?php
            $list = array("Mathe", "Englisch", "Deutsch", "IT Hardware", "IT Software", "Spanisch", "Geschichte", "Physik", "Ethik", "Chemie", "Theater AG");
        
            foreach($list as $key => $value):
            echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
            endforeach;
        ?>
    </select><br><br>
    <label for="aufgaben">Aufgaben:</label>
    <textarea required id="aufgaben" name="aufgaben"></textarea><br><br>
    <label for="datum">Zieldatum:</label>
    <input required type="date" id="datum" name="datum" /><br><br><br>
    <button type="submit">Eintragen</button>
</form>
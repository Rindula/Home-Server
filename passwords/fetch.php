<?php
/*
 * Alle Rechte dieser Website liegen bei Sven Nolting.
 * Medien können unter Umständen von anderen Seiten sein.
 * Die Nutzung dieser Website und ihrer Scripte sind !NACH ANFRAGE! erlaubt oder halt nicht.
 */


include $_SERVER['DOCUMENT_ROOT'] . "/_hidden/vars.php";
$mysqli = mysqli_connect("localhost", "root", $mySqlPassword, "myPasswords");


if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $res = $mysqli->query("SELECT * FROM list WHERE id = '" . $id . "'");
    $infos = $res->fetch_assoc();

    $out = "<table><tr><td><img style='width: 200px;' src='" . $infos['account'] . "'></td><td><table><tr><h1>" . $infos["service"] . "</h1></tr><tr><td><b>Username:</b></td><td><input style='text-align: center;' id='usr_$id' onclick='copyToPaste(\"usr_$id\")' readonly value='" . $infos["user"] . "'></td></tr><tr><td><b>Passwort:</b></td><td><input style='text-align: center;' id='pw_$id' onclick='copyToPaste(\"pw_$id\")' readonly value='" . $infos["passwort"] . "'></td></tr></table></tr></table>";

    die($out);
}
?><select onchange="load(this.value)">
    <option selected disabled>--- Bitte Auswählen ---</option><?php
    $res = $mysqli->query("SELECT id, service FROM list ORDER by service ASC");
    while ($row = $res->fetch_assoc()) {
        ?>
        <option value="<?= $row["id"] ?>"><?= $row["service"] ?></option>
        <?php
    }
    ?></select>

<div id="infos"></div>
<script type="text/javascript">
    function load(v) {
        var xhttpPasswords = new XMLHttpRequest();
        xhttpPasswords.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // Typical action to be performed when the document is ready:
                document.getElementById("infos").innerHTML = xhttpPasswords.responseText;
            }
        };
        xhttpPasswords.open("GET", "passwords/fetch.php?id=" + v, true);
        xhttpPasswords.send();
    }
    function copyToPaste(id) {
        document.getElementById(id).select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Copying text command was ' + msg);
        } catch (err) {
            console.log('Oops, unable to copy');
        }
    }
</script>
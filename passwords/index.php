<?php
$title = "Passwords";

//include "../header.php";
include "../_hidden/vars.php";
// include "../_hidden/verify.php";
// Datenbankverbindung herstellen
$mysqli = mysqli_connect("localhost", "root", $mySqlPassword, "myPasswords");
$queryCreateUsersTable = "CREATE TABLE IF NOT EXISTS `list` ( `ID` INT NOT NULL AUTO_INCREMENT , `service` TEXT NOT NULL DEFAULT '' , `user` TEXT NOT NULL DEFAULT '' , `passwort` TEXT NOT NULL DEFAULT '' , `account` TEXT NOT NULL DEFAULT '' , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
$mysqli->query($queryCreateUsersTable);

if (isset($_POST['user']) && isset($_POST['service'])) {
    if (empty($_POST['passwort'])) {
        $passwort = generate_password();
    } else {
        $passwort = $_POST['passwort'];
    }

    if (empty($_POST['image'])) {
        $account = "/img/placeholder.png";
    } else {
        $account = $_POST['image'];
    }

    $user = $_POST['user'];
    $service = $_POST['service'];

    $sql_add = "INSERT INTO `list`(`ID`, `service`, `user`, `passwort`, `account`) VALUES (NULL,'$service','$user','$passwort','$account')";
    echo $sql_add;
    $mysqli->query($sql_add);
    ?>
    <meta http-equiv="refresh" content="0">
    <?php
}
?>
<link type="text/css" href="/style.css" />
<style>
    .header img {
        float: left;
        width: auto;
        height: 1.5em;
        padding-right:10px;
        background: transparent;
    }

    .header h1 {
        position: relative;
        top: 18px;
        left: 10px;
    }

    [data-tooltip] {
        position: relative;
    }

    [data-tooltip]::after {
        content: attr(data-tooltip);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.5s;

        display: block;  
        position: absolute; 
        bottom: 2em;
        left: -1em;
        width: 15em;
        padding: 0.5em;
        z-index: 100;
        color: #000; 
        background-color: #3affd9;
        border: solid 1px #c32e04;
        border-radius: 0.5em;  
        transition-delay: 0.2s;
    }

    [data-tooltip]::before {
        content: "";
        position: absolute;
        display: block;	
        opacity: 0;
        transition: opacity 0.5s;
        bottom: 1em;
        left: auto;
        right: 0; 
        border-width: 2em 1em 0;
        border-style: solid;
        border-color: #043fc3 transparent;
    }

    [data-tooltip]:hover::after, [data-tooltip]:hover::before {
        transition-delay: 0.5s;
        opacity: 1;
    }

    .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }
    input, button {
        background-color: transparent;
    }
</style>

<script type="text/javascript">
    function show_image(src) {
        var img = encodeURI(document.getElementById("preview"));
        if (!src.trim()) {
            img.src = "/img/placeholder.png";
        } else {
            img.src = src;
        }
        img.width = 24;
        img.height = 24;
        img.alt = "------";
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
        document.selection.empty();
    }
    ;

    function updater(id, uid) {
        window.location.replace("/_hidden/imgUpdate.php?id=" + uid + "&link=" + document.getElementById(id).value);
    }

    function resetter(id) {
        var link = document.getElementById("preview_small_image_" + id).src.substr(13);

        window.location.replace("/_hidden/imgUpdate.php?id=" + id + "&link=" + link + "&delete");
    }

    function openForm() {
        document.getElementById("form").style.display = "block";
        document.getElementById("closebtn").innerHTML = "-";
        document.getElementById("closebtn").onclick = function () {
            closeForm();
            return false;
        };
        var now = new Date();
        now.setTime(now.getTime() + 100 * 365 * 24 * 3600 * 1000);
        document.cookie = "menustate=opened; expires=" + now.toUTCString() + "; path=/?section=passwörter";
    }

    /* Set the width of the side navigation to 0 */
    function closeForm() {
        document.getElementById("form").style.display = "none";
        document.getElementById("closebtn").innerHTML = "+";
        document.getElementById("closebtn").onclick = function () {
            openForm();
            return false;
        };
        var now = new Date();
        now.setTime(now.getTime() + 100 * 365 * 24 * 3600 * 1000);
        document.cookie = "menustate=closed; expires=" + now.toUTCString() + "; path=/?section=passwörter";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function checkField() {
        if (getCookie("menustate") == "opened") {
            openForm();
        } else {
            closeForm();
        }
    }
    ;

    window.onload = function () {
        checkField();
    };
</script>
<div id="wrapper">
    <div id="content">
        <button id="closebtn" class="closebtn"></button>
        <form id="form" action="" method="post" style="display: none; background-color: rgba(0, 88, 255, 0.1)">
            <table>
                <tr>
                    <td><label for="service">Dienstname: </label></td>
                    <td><input autocomplete="off" id="service" required type="text" name="service"></td>
                </tr>
                <tr>
                    <td><label for="user">Username: </label></td>
                    <td><input autocomplete="off" id="user" required type="text" name="user"></td>
                </tr>
                <tr>
                    <td><label for="passwort">Passwort (optional): </label></td>
                    <td><input autocomplete="off" id="passwort" type="text" name="passwort"></td>
                </tr>
                <tr>
                    <td><label for="inputPreview">Bild (optional): </label></td>
                    <td><input type="text" onchange="show_image(this.value);" oninput="show_image(this.value);" name="image" id="inputPreview" /></td>
                    <td><img id="preview" src="/img/placeholder.png" width="24" height="24" alt="------" /></td>
                    <td><button data-tooltip='Eintrag der Datenbank hinzufügen'  type="submit">Hinzuf&uuml;gen</button></td>
                </tr>
            </table>
            <hr></form>
        <?php
// Abfrage erstellen
        $query = "SELECT * FROM list ORDER BY service ASC";
        $result = $mysqli->query($query);
        $noUrl = 0;
        $reload = false;

        while ($ar = $result->fetch_assoc()) {
            $service = $ar["service"];
            $user = $ar["user"];
            $passwort = $ar["passwort"];
            $id = $ar["ID"];
            $img = $ar["account"];

            if (substr($img, 0, 4) === "http") {
                $ending = substr(strrchr(substr(strrchr($img, "/"), 1), "."), 1);
                if ($ending == "") {
                    $ending = "png";
                }
                $imgSave = 'img/icons/' . $service . '.' . $ending;
                file_put_contents($imgSave, file_get_contents($img));
                $mysqli->query("UPDATE list SET account='/img/icons/$service.$ending' WHERE ID=$id");
                $reload = true;
            } else {
                ?>
                <div style="font-size: 15px;">
                    <div class="header">
                        <?php
                        if ($img == "/img/placeholder.png") {
                            echo "<img src='$img' /><h2>$service</h2>";
                            echo "<input id='image_update_$id'><button onclick='updater(\"image_update_$id\", \"$id\")'>Bild erneuern</button>";
                            $noUrl++;
                        } else {
                            echo "<img id='preview_small_image_$id' src='$img' /><h2>$service <button data-tooltip='Bild entfernen' onclick='resetter(\"$id\")' style='background-color: red; color: white; font-weight: bold;'>#</button></h2>";
                        }
                        ?>
                    </div>
                    <table>
                        <?php
                        echo "<tr><td><label for='user'>User: </label></td>";
                        echo "<td><input id='name_$id' name='user' style='outline:none; border:0px;' readonly value='$user'/></td><td><button data-tooltip='Benutzernamen von $service in die Zwischenablage kopieren' onclick='copyToPaste(\"name_$id\")'>User kopieren</button></td></tr>";
                        echo "<tr><td><label for='password'>Passwort: </label></td>";
                        echo "<td><input id='password_$id' name='password' style='outline:none; border:0px; width: 500px' readonly value='$passwort'/></td><td><button data-tooltip='Passwort von $service in die Zwischenablage kopieren' onclick='copyToPaste(\"password_$id\")'>Passwort kopieren</button></td></tr>";
                        ?>
                    </table>
                </div>
                <hr>
                <?php
            }
        }
        if ($reload) {
            ?>
            <script>window.location.replace("/?section=passwörter")</script>
            <?php
        }
        echo "<p>Es fehlen <b>$noUrl</b> Iconbilder</p>"
        ?>
    </div>
</div>
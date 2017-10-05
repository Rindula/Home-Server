<?php
$mysqli = new mysqli("25.83.12.108", "root", "SiSal2002", "mom");
$mysqli->set_charset("utf8");
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript">
        function betrage(v) {
            s = document.getElementById('betrag');
            st = document.getElementById('gezahlt');
            if (v === "2") {
                s.disabled = true;
            } else {
                s.disabled = false;
            }
            if (v !== "0") {
                st.disabled = true;
            } else {
                st.disabled = false;
            }
        }

        function formSubmit() {
            f = document.getElementById('enterform');
            name = document.getElementById('name');
            datum = document.getElementById('datum');
            text = document.getElementById('gemalt');
            msgDisplay = document.getElementById('msg');
            msgDisplay.innerHTML = '<div id="nachricht" class="alert success"><span class="closebtn">&times;</span><strong>Erfolg!</strong> ' + name.options[name.selectedIndex].innerHTML + ' wurde eingetragen.</div>';

            f.submit();
            text.value = "";
            var div = document.getElementById('nachricht');
            setTimeout(function () {
                div.style.opacity = "0";
            }, 3000);

            setTimeout(function () {
                msgDisplay.innerHTML = "";
            }, 5600);

        }
    </script>
</head>

<pre id="msg"></pre>

<form id="enterform" action="mom/queryEnter.php" name="enterform" method="POST" enctype="multipart/form-data" target="_blank">
    <table>
        <tr></tr>
        <tr>
            <td>
                <label for="datum">Datum: </label>
            </td>
            <td>
                <input id="datum" type="date" name="datum" max="<?= date("Y-m-d") ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="name">Name: </label>
            </td>
            <td>
                <select id="name" name="name">
                    <?php
                    $result = $mysqli->query("SELECT * FROM teilnehmer ORDER BY name ASC");
                    while ($ar = $result->fetch_assoc()) {
                        $name = $ar["name"] . " " . $ar["vname"];
                        echo "<option value='" . $ar["id"] . "'>" . $name . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="art">Art: </label>
            </td>
            <td>
                <select onchange="betrage(this.value)" name="art" id="art">
                    <option value="0">Bezahlt</option>
                    <option value="1">Gutschein</option>
                    <option value="2">Probe</option>
                    <option value="3">Ferienkurs</option>
                </select>
                <input id="betrag" placeholder="55" style="width: 50px" type="number" name="betrag" value="" /> &euro;
                <br><label for="gezahlt">Noch bezahlt: </label>
                <input type="checkbox" name="gezahlt" id="gezahlt" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="gemalt">Gemaltes Bild: </label>
            </td>
            <td>
                <textarea id="gemalt" name="gemalt" rows="4" cols="100"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <input onclick="formSubmit(); return false;" type="button" value="Eintragen" />
            </td>
        </tr>
    </table>

</form>
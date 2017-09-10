<!DOCTYPE html>
<?php session_start(); ?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ducky Creator</title>
    </head>
    <body>
        <div id="info"></div>
        <form method="POST" enctype="multipart/form-data" action="process.php">
            <textarea style="width: 100%; height: 300px" name="input"><?= $_SESSION["text_in"] ?></textarea><br>
            <button onclick="process()">Verarbeiten</button> <input type="checkbox" name="tab_space" value="ON" <?= ($_SESSION["tab_space"] == true) ? "checked" : "" ?> />
            <textarea style="width: 100%; height: 300px" width="500px" height="500px" name="output"><?= $_SESSION["text_out"] ?></textarea><br>
        </form>
        <script type="text/javascript">
            var myInput = document.getElementsByName("input")[0];
            if (myInput.addEventListener) {
                myInput.addEventListener('keydown', this.keyHandler, false);
            } else if (myInput.attachEvent) {
                myInput.attachEvent('onkeydown', this.keyHandler); /* damn IE hack */
            }

            function keyHandler(e) {
                var TABKEY = 9;
                if (e.keyCode == TABKEY) {
                    this.value += "\t";
                    if (e.preventDefault) {
                        e.preventDefault();
                    }
                    return false;
                }
            }
        </script>
    </body>
</html>

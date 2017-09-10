<!DOCTYPE html>
<html>
    <head>
        <title>Installationsscript</title>
    </head>
    <body>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        session_start();
        if (!isset($_SESSION["status"])) {
            $_SESSION["status"] = 1;
        }

        $maxStep = 2;

        if (isset($_POST["step_1"])) {
            $_SESSION["db_ip"] = $_POST["db_ip"];
            $_SESSION["db_user"] = $_POST["db_user"];
            $_SESSION["db_pass"] = $_POST["db_pass"];
            $_SESSION["db_database"] = $_POST["db_database"];

            $_SESSION["status"] = 2;
        }




        if ($_SESSION["status"] == $maxStep) {

            mkdir("config");

            $outString = "<?php\n\n";

            $outString .= "define('DATABASE_IP', '" . $_SESSION["db_ip"] . "');\n";
            $outString .= "define('DATABASE_USER', '" . $_SESSION["db_user"] . "');\n";
            $outString .= "define('DATABASE_PASS', '" . $_SESSION["db_pass"] . "');\n";
            $outString .= "define('DATABASE_DATABASE', '" . $_SESSION["db_database"] . "');\n";

            $outString .= "\nif (!file_exists(\"./config/db_conn.php\")) {\n";
            $outString .= "\t\$outString = \"\\\$mysqli = mysqli_connect(DATABASE_IP, DATABASE_USER, DATABASE_PASS, DATABASE_DATABASE);\";\n";
            $outString .= "\t\$handle = fopen(\"config/db_conn.php\", \"w\") or die(\"Unable to open file!\");\n";
            $outString .= "\tfwrite(\$handle, \"<?php\\n\\n\" . \$outString);\n";
            $outString .= "}\n";
            $myfile = fopen("config/config.php", "w") or die("Unable to open file!");
            fwrite($myfile, $outString);
            fclose($myfile);
            header("Location: setup_database.php");
        }


        switch ($_SESSION["status"]) {
            case 1:
                ?>
                <form action="./install.php" method="POST">
                    <table>
                        <caption>Datenbankverbindung</caption>
                        <tr><td>IP</td><td><input type="text" autocomplete="off" name="db_ip"></td></tr>
                        <tr><td>Benutzer</td><td><input type="text" autocomplete="off" name="db_user"></td></tr>
                        <tr><td>Passwort</td><td><input type="password" autocomplete="off" name="db_pass"></td></tr>
                        <tr><td>Datenbankname</td><td><input type="text" autocomplete="off" name="db_database"></td></tr>
                        <tr><td>Bestätigen</td><td><input type="submit"  name="step_1" value="Bestätigen"></td></tr>
                    </table>
                </form>
                <?php
                break;

            default:
                session_destroy();
                header("Location: index.php");
                break;
        }
        ?>
    </body>
</html>
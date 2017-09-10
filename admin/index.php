<?php
session_start();
if (!file_exists("./config/config.php")) {
    header("Location: ./install.php");
} else {
    include_once './config/config.php';
}
$mysqli = mysqli_connect(DATABASE_IP, DATABASE_USER, DATABASE_PASS, DATABASE_DATABASE);

$mysqli->query("SET NAMES utf8");

if (isset($_GET["action"]) && isset($_GET["id"])) {
    $result = $mysqli->query("Select * From actions Where id = " . $_GET["id"]);

    while ($row = $result->fetch_assoc()) {
        if ($row["action"] == $_GET["action"]) {
            shell_exec($row["action"] . " > /dev/null &");
        }
    }
//    die(print_r($_GET));
    header("Location: ./index.php");
}
?>

<html>
    <body style="background-color: black;">
        <div style="display: block; padding: 0; margin: 0; margin-right: 10px; margin-bottom: 10px;">
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $result = $mysqli->query("Select * From actions");

            while ($ar = $result->fetch_assoc()) {
                ?>
                <div style="display: inline-block; max-width: 200px; padding: 0; margin: 0; margin-right: 10px; margin-bottom: 10px; border: 2px solid #d8f7ce; padding: 10px; background-color: #53a000; color: #d8f7ce; max-height: 150px; border-radius: 3px; cursor: pointer;">
                    <a style="text-decoration: none; color: #d8f7ce" href="?action=<?= urlencode($ar["action"]) ?>&id=<?= $ar["id"] ?>">
                        <h2><?= $ar["actionName"] ?></h2>
                        <small><?= $ar["description"] ?></small>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>
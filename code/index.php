<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <link type="text/css" rel="stylesheet" href="styles/shCoreFadeToGrey.css" />
        <style>
            html {
                background: #121212;
            }

            h1 {
                color: orange;
            }

            h1:after {
                color: rgba(255, 165, 0, 0.5);
                content: " (" attr(language) ") ";
            }
        </style>
        <?php
        $title = "Public Codes";
        $path = $_SERVER['DOCUMENT_ROOT'];
        include $path . "/header.php";
        include $path . "/_hidden/vars.php";
        include $path . "/code/js.php";
        header("Content-type:text/html; charset=utf-8");

        // Datenbankverbindung herstellen
        $conn = mysqli_connect("localhost", "root", $mySqlPassword, "stats");
        $queryCreateUsersTable = "CREATE TABLE IF NOT EXISTS `arbeit` ( `ID` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL DEFAULT '' , `content` TEXT NOT NULL DEFAULT '' , `language` varchar(255) NOT NULL DEFAULT 'Java' , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
        $conn->query($queryCreateUsersTable);
        $conn->query("SET NAMES utf8");
        ?>
    </head>
    <body>

        <?php
        $query = "SELECT * FROM arbeit ORDER BY language,name ASC";
        $result = $conn->query($query);
        while ($ar = $result->fetch_assoc()) {
            echo '<h1 language="' . $ar["language"] . '">' . $ar["name"] . '</h1>';
            echo '<pre class="brush: java;">';
            echo $ar["content"];
            echo '</pre>';
        }
        ?>

    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Etikettendruck</title>
</head>
<body>
    <table>
    <?php

    $filename = "./codes.lst";
    $lines = file($filename);

    $right = false;

    foreach($lines as $line_num => $line) {
        if($right) {
            echo "<td><code>$line</code></td></tr>";
        } else {
            echo "<tr><td><code>$line</code></td>";
        }

        $right = !$right;
    }

    if($right) {
        echo "</tr>";
    }

    ?>
    </table>
</body>
</html>
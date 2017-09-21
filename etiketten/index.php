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
    <?php

    $filename = "./codes.lst";
    $lines = file($filename);


    foreach($lines as $line_num => $line) {
        echo "<code>$line</code>";
    }

    ?>
</body>
</html>
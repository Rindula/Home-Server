<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filestorage</title>
    <style>
        code {
            font-size:11px;
            color:black;
        }
        div {
            background-color:#ddd;
        }
        a {
            text-decoration: none;
        }
        span:nth-child(1) {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
    
    define("DIRECTORY_SEPERATOR", "/");

    function listDir($dir = ".") {
        foreach (scandir($dir) as $file) {
            if (!preg_match("/\.(.?|php)$/",$file) && $file[0] != ".") {
                if (is_dir($dir .  DIRECTORY_SEPERATOR . $file)) {
                    listDir($dir .  DIRECTORY_SEPERATOR . $file);
                } else {
                    echo '<a download href="' . $dir . DIRECTORY_SEPERATOR .$file. '"><div><span>' .$file. '</span><br>';
                    $size = round(filesize($dir .  DIRECTORY_SEPERATOR . $file) / 1024, 2);
                    echo '<span><code>File Size: ' .$size. 'KB; [' . $dir . ']</code></span></div></a><br><br>';
                }
            }
        }
    }

    listDir();
?>
</body>
</html>
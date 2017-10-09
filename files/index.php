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
            -webkit-transition: all .2s linear;
            -moz-transition: all .2s linear;
            transition: all .2s linear;
            border: 1px solid black;
        }
        div:hover {
            background-color:#ccc;
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
<form action="upload.php" method="post" enctype="multipart/form-data">
    Upload Name:
    <input placeholder="Displayname" type="text" name="displayName" id="displayName"><br>
    Upload Location:
    <select name="uploadDir" id="uploadDir">
        <?php
        $options = array("Hausaufgaben" => "./Schule/Hausaufgaben/");

        foreach ($options as $key => $value) {
            echo "<option value='$value'>$key</option>";
        }
        ?>
    </select><br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="Upload Image" name="submit"><br>
</form><hr>
<?php
    
    define("DIRECTORY_SEPERATOR", "/");
    $m = new mysqli("localhost", "root", "SiSal2002", "uploads");

    function listDir($dir = ".") {
        global $m;
        foreach (scandir($dir) as $file) {
            if (!preg_match("/\.(.?|php)$/",$file) && $file[0] != ".") {
                if (is_dir($dir .  DIRECTORY_SEPERATOR . $file)) {
                    listDir($dir .  DIRECTORY_SEPERATOR . $file);
                } else {
                    $r = $m->query("SELECT display, _show FROM filestorage WHERE file = '$dir" . DIRECTORY_SEPERATOR . "$file'");
                    if ($r->num_rows == 0) continue;
                    $ret = $r->fetch_array();
                    if ($ret[1] !== "1") continue;
                    echo '<a download href="' . $dir . DIRECTORY_SEPERATOR .$file. '"><div><span>' .$ret[0]. '</span><br>';
                    $size = round(filesize($dir .  DIRECTORY_SEPERATOR . $file) / 1024, 2);
                    echo '<span><code>File Size: ' .$size. 'KB; [' . $dir . ']</code></span></div></a>';
                }
            }
        }
    }

    listDir();
?>
</body>
</html>
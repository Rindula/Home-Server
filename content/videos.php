<?php

$path = "content/video/";
$formats = array("mp4", "webm");

if ($handle = opendir($path)) {
    $cnt = count(glob($path . "*"));
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && in_array(strtolower(substr($entry, strpos($entry, ".") + 1)), $formats)) {
            $typ = "video";
            include 'bindIn.php';
            $cnt--;
            if ($cnt > 0) {
                echo '<hr>';
            }
        }
    }
}
?>

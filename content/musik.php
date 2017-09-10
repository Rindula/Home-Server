<?php

$path = "content/musik/";
$formats = array("mp3", "ogg");

error_reporting(E_ALL);
ini_set('display_errors', 'On');

if ($handle = opendir($path)) {
    $cnt = count(glob($path . "*"));
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && in_array(strtolower(substr($entry, strpos($entry, ".") + 1)), $formats)) {
            $typ = "audio";
            include 'bindIn.php';
            $cnt--;
            if ($cnt > 0) {
                echo '<hr>';
            }
        }
    }
}
?>

<?php

$file = md5_file($path . $entry);

$jsonfile = file_get_contents("content/infos.json");
$jsonarray = json_decode($jsonfile, true);
foreach ($jsonarray[0] as $key => $value) {
	$isName = false;
    if ($key == $typ) {
        foreach ($jsonarray[0][$key] as $key2 => $value2) {
            if ($file == $value2["hash"]) {
                $file = $value2["name"];
				$isName = true;
            }
        }
		if (!$isName) {
			$file = $entry . " ### " . $file;
		}
    }
}

echo "<h2>$file</h2><$typ onplay='muteOthers(this); return false;' controls preload='auto' style='width: 100%' src=\"$path$entry\"></$typ>";
?>

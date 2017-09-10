<?php

if ($handle = opendir()) {
    /* Das ist der korrekte Weg, ein Verzeichnis zu durchlaufen. */
    while (false !== ($entry = readdir($handle))) {
        
    }

    closedir($handle);
}
if ($handle = opendir($_SERVER['DOCUMENT_ROOT'] . '/code/scripts')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "<script type='text/javascript' src='scripts/" . $entry . "'></script>\n\t\t";
        }
    }
    closedir($handle);
    echo '<script type="text/javascript">SyntaxHighlighter.all();</script>';
}
?>
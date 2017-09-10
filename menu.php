<?php
$list = array("Startseite", "Videos", "Bilder", "Status", "Musik", "Kalender", "Anwesenheitsliste");
$list[] = "Passwörter";
//$list[] = "Test";
?>
<ul>
    <?php
    foreach ($list as $l) {
        echo "<li><a id='". strtolower($l) ."' href='#' onclick='page(\"". strtolower($l) ."\")'>$l</a></li>";
    }
    ?>
</ul>
<?php

switch ($_GET["sec"]) {
    case "videos":

        include 'content/videos.php';
        break;

    case "bilder":

        include 'content/bilder.php';
        break;

    case "musik":

        include 'content/musik.php';
        break;

    case "kalender":

        include 'content/kalender.php';
        break;

    case "startseite":

        include 'content/startseite.php';
        break;

    case "passwörter":

        include 'passwords/fetch.php';
        break;

    case "status":

        include 'content/status.php';
        break;

    case "kontakte":

        include 'contacts/index.html';
        break;

    case "test":

        //include 'upload/index.php';
        break;

    case "anwesenheitsliste":
        if ($_GET["sub"] == "eintragen") {
            include 'mom/enter.php';
        } else {
            include 'mom/index.php';
        }
        break;

    default:
        $errorCode = "404";
        include 'filenotfound.php';
        break;
}
?>
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function clear_string($str, $how = '-') {
    $search = array("ä", "ö", "ü", "ß", "Ä", "Ö",
        "Ü", "&", "é", "á", "ó");
    $replace = array("ae", "oe", "ue", "ss", "Ae", "Oe",
        "Ue", "und", "e", "a", "o");
    $str = str_replace($search, $replace, $str);
    return $str;
}

session_start();

$_SESSION["text_in"] = clear_string($_POST["input"]);

$d = str_replace("\n", "\nENTER\n", $_SESSION["text_in"]);

$text = explode("\n", $d);

foreach ($text as $line) {
    if (isset($_POST["tab_space"])) {
        $_SESSION["tab_space"] = true;
        $line = str_replace("    ", "\t", $line);
    } else {
        $_SESSION["tab_space"] = false;
    }
    $line = str_replace("\t", "\nTAB\n", $line);

    

    if (substr($line, 0, 3) == "(o)") {
        $line = "GUI r\nDELAY 100\nSTRING " .  substr($line, 4);
    }

    $line = str_replace(array('(', ')'), '', preg_replace("/\([0-9]+\)/", "DELAY $0", $line));
    if (trim($line) == "") {
            $line = "\nENTER";
    }
    $rep = false;
    if (strcasecmp($line, "ENTER") == 0 || strcasecmp($line, "TAB") == 0 || substr($line, 0, 5) == "DELAY" || substr($line, 0, 3) == "GUI") {
        $data .= $line;
        $rep = true;
    } else {
        if (trim($line) != "") {
            $data .= "STRING " . $line;
            $rep = true;
        }
    }
    if ($rep) {
        $data .= "\n";
    }
}

$_SESSION["text_out"] = "DELAY 1000\n$data";

header("Location: ./");

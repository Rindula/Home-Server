<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Variablen initialisierung
$mySqlPassword = "SiSal2002";

function generate_password() {
    $alpha = "abcdefghijklmnopqrstuvwxyz";
    $alpha_upper = strtoupper($alpha);
    $numeric = "0123456789";
    $special = ".-+=_,!@$#*%<>[]{}";
    $chars = $alpha . $alpha_upper . $numeric . $special;

    $len = strlen($chars);
    $pw = '';

    for ($i = 0; $i < 20; $i++) {
        $pw .= substr($chars, rand(0, $len - 1), 1);
    }
    // the finished password
    $ret = str_shuffle($pw);
    return $ret;
}

?>
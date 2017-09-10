<?php
session_start();
if(!isset($_SESSION['userid']) && isset($exitLink)) {
 die("<meta http-equiv='refresh' content='0; $exitLink'>");
}
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst <a href="/login">einloggen</a>');
}
?>
<style>
    .logoutButton {
        position:fixed;
        bottom:10px;
        right:10px;
        font-family:monospace;
        font-size:24px;
        color:#00ff27;
        text-shadow: 0 0 5px #a6ffff;
        background-color: #dc5914;
        padding: 10px;
        border-radius: 10px;
        cursor: pointer;
    }
</style>
<button class="logoutButton" onclick="location.assign('/logout')">Ausloggen</button>
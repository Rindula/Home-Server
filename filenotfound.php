<html style="background-image: url('/images/Background.png'); background-repeat: no-repeat; background-position: center center; background-size: cover;">
<?php
    $errorcode = $errorCode ?: $_GET['e'];
    $redirect = $_GET['r'];
    echo "<title>Error $errorCode</title>";
    $errorText = "";
    if ($errorCode === "404") {
        $errorText = "404 - Seite nicht gefunden...";
?>
<body style="background-image: url('/images/404.png'); background-size: contain; background-repeat: no-repeat; background-position: center center">

<?php
    }
    if ($errorCode === "400") {
        $errorText = "400 - Fehlerhafte anfrage...";
?>
<body style="background-image: url('/images/400.png'); background-size: contain; background-repeat: no-repeat; background-position: center center">

<?php
    }
    if ($errorCode === "401") {
        $errorText = "401 - Keine Berechtigung...";
?>
<body style="background-image: url('/images/401.png'); background-size: contain; background-repeat: no-repeat; background-position: center center">

<?php
    }
    if ($errorCode === "403") {
        $errorText = "403 - Verboten; Kein Zugriff möglich...";
?>
<body style="background-image: url('/images/403.png'); background-size: contain; background-repeat: no-repeat; background-position: center center">

<?php
    }
    if ($errorCode === "500") {
        $errorText = "500 - Interner Server Fehler...";
?>
<body style="background-image: url('/images/500.png'); background-size: contain; background-repeat: no-repeat; background-position: center center">

<?php
    }
    if ($errorCode === "501") {
        $errorText = "501 - Der Server ist noch nicht richtig konfiguriert...";
?>
<body style="background-image: url('/images/501.png'); background-size: contain; background-repeat: no-repeat; background-position: center center">

<?php
    }
    if ($errorCode === "502") {
        $errorText = "502 - Ungültige Antwort...";
?>
<body style="background-image: url('/images/502.png'); background-size: contain; background-repeat: no-repeat; background-position: center center">

<?php
    }
    if ($errorCode === "503") {
        $errorText = "503 - Server überlastet, Vorübergehend nicht verfügbar...";
?>
<body style="background-image: url('/images/503.png'); background-size: contain; background-repeat: no-repeat; background-position: center center">

<?php
    }
?>
   <h1 style="text-align: center;"><?php echo $errorText ?></h1> 
</body>
</html>
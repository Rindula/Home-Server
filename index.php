<?php
header('Cache-Control: no-cache');
?>
<html>

<head>
    <title>Dateispeicher</title>
    <link rel="stylesheet" href="style.css">
    <style id="styleing"></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="scripts.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="header" class="header">
        </div>
        <nav>
            <?php
            include 'menu.html';
            ?>
        </nav>
        <iframe name="content" id="content" src="content.php?sec=startseite" style="border: 0; width: 100%; overflow: hidden; height: 70%;">
		</iframe>
        <div id="footer" class="footer">
            <?php
            include 'footer.php';
            ?>
        </div>
    </div>
</body>
<script type="text/javascript">
    page( "startseite" );
</script>

</html>

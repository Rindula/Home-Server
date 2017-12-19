<?php
header('Cache-Control: no-cache');
?>
<html>

<head>
    <title>Dateispeicher</title>
    <style id="styleing"></style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="scripts.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <?php
            include 'menu.html';
            ?>
        </nav>
        <iframe name="content" id="content" src="content.php?sec=startseite" style="border: 0; width: 100%; overflow: hidden; height: 70%;">
		</iframe>
        <div id="footer" class="sticky-bottom">
            <?php
            include 'footer.php';
            ?>
        </div>
    </div>
</body>
<script type="text/javascript" src="js/bootstrap.js"></script>

</html>

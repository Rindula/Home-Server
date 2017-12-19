<?php
header('Cache-Control: no-cache');
?>
<html>

<head>
    <title>Dateispeicher</title>
    <link rel="stylesheet" href="style.css">
    <style id="styleing"></style>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="scripts.js"></script>
    <script src="js/popper.js"></script>
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
<script src="js/bootstrap.js"></script>

</html>

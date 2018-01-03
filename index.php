<?php
header('Cache-Control: no-cache');
?>
<html>

<head>
    <title>Dateispeicher</title>
    <style id="styleing"></style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="scripts.js"></script>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

</html>

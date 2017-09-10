<html>
    <?php $title = "Bilderliste";
    include "head.php"; ?>
    <script type="text/javascript">
        function submitForm(){
            window.open("","extraWindow","width=500,height=300,toolbar=0");
            setTimeout(function() {
                location.reload(true);
            }, 2000);
        }
        function image(name, fname) {
            var imag = document.getElementById("img");
            imag.src = "uploads/" + fname;
            imag.title = name;
            imag.alt = name;
        }
    </script>
    <body>
        <div>
            <form onsubmit="submitForm()" enctype="multipart/form-data" action="manage.php" method="post" target="extraWindow">
                <input required type="text" name="name" id="name" placeholder="Bildtitel" autocomplete="off"><br><br>
                <input required type="file" name="image" id="image" accept="image/*"><br><br>
                <input type="submit" value="Hochladen">
            </form>
        </div>
        <hr>
        <div>
        <table>
            <tr><th>ID</th><th>Name</th><th>Hochladedatum</th></tr>
            <?php
            $conn = new mysqli("localhost", "root", "SiSal2002", "images");
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $res = $conn->query("SELECT * FROM image");
            while ($r = $res->fetch_assoc()) {
                $class = "valid";

                if (!file_exists("uploads/" . $r["filename"])) {
                    $class = "invalid";
                }

                ?>
                <tr><td><?= $r["id"] ?></td><td class="<?= $class ?>"><a href="#" onclick="image('<?= $r["name"] ?>', '<?= $r["filename"] ?>')"><?= $r["name"] ?></a></td><td><?= date("d.m.Y, H:i", strtotime($r["timestamp"])) ?></td></tr>
                <?php
            }
            ?>
            </table>
        </div>
        <img id="img" src="" alt="">
    </body>

</html>

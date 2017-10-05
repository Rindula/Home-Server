<h2><?= date("M. Y", strtotime($_GET["date"] . "-01")) ?></h2>
<table>
    <tr><th>Timestamp</th><th>Marke</th><th>Produkt</th><th>Preis</th></tr>
    <?php
        $conn = new mysqli("25.83.12.108", "root", "SiSal2002", "scanner");
        $conn->query("SET NAMES utf8");
        $tablename = "scan_" . date("mY", strtotime($_GET["date"] . "-01")) . "";
        $res = $conn->query("SELECT * FROM $tablename");

        $price = 0;

    while ($r = $res->fetch_assoc()) {
        $pr = $conn->query("SELECT * FROM produkte WHERE code='" . $r["code"] . "'");

        $date = date("d.m.Y", strtotime($r["timestamp"]));
        $time = date("H:i", strtotime($r["timestamp"]));

        if ($pr->num_rows > 0) {
            $p = $pr->fetch_assoc();
            $price = $price + $p["preis"];
            echo "<tr title='Gescannt am $date um $time'><td>$date, $time</td><td>" . $p["hersteller"] . "</td><td>" . $p["produkt"] . "</td><td>" . number_format($p["preis"], 2) . "</td></tr>\n\t\t\t";
        } else {
            echo "<tr title='Gescannt am $date um $time'><td>$date, $time</td><td></td><td><a href='https://www.google.de/search?q=" . $r["code"] . "' target='productid'>" . $r["code"] . "</a></td><td>0.00</td></tr>\n\t\t\t";
        }
    }
        $price = number_format($price, 2);
        echo "<tr class='gesamt'><td><b>Gesamtkosten</b></td><td></td><td></td><td><b>$price</b></td></tr>\n"
    ?>
</table>

<h2 class="display-4 text-light"><?= date("M. Y", strtotime($_GET["date"] . "-01")) ?></h2>
<table class="table table-dark table-striped table-bordered table-hover">
    <tr class="text-center"><th scope="col">Timestamp</th><th scope="col">Marke</th><th scope="col">Produkt</th><th scope="col">Preis</th></tr>
    <?php
        $conn = new mysqli("25.83.12.108", "root", "SiSal2002", "scanner");
        $conn->query("SET NAMES utf8");
        $tablename = "scan_" . date("mY", strtotime($_GET["date"] . "-01")) . "";
        $res = $conn->query("SELECT * FROM $tablename");

        $price = 0;

    while ($r = $res->fetch_assoc()) {
        $pr = $conn->query("SELECT p.preis, p.produkt, h.name as 'hersteller' FROM produkte as p inner join hersteller as h on h.id = p.hersteller WHERE code='" . $r["code"] . "'");

        $date = date("d.m.Y", strtotime($r["timestamp"]));
        $time = date("H:i", strtotime($r["timestamp"]));

        if ($pr->num_rows > 0) {
            $p = $pr->fetch_assoc();
            $price = $price + $p["preis"];
            echo "<tr title='Gescannt am $date um $time'><td>$date, $time</td><td>" . $p["hersteller"] . "</td><td>" . $p["produkt"] . "</td><td>" . number_format($p["preis"], 2) . "</td></tr>\n\t\t\t";
        } else {
            echo "<tr class='table-warning text-danger font-weight-bold' title='Gescannt am $date um $time'><td>$date, $time</td><td></td><td><a href='https://www.codecheck.info/product.search?q=" . $r["code"] . "' target='productid'>" . $r["code"] . "</a></td><td>0.00</td></tr>\n\t\t\t";
        }
    }
        $price = number_format($price, 2);
        echo "<tr class='table-success text-success font-weight-bold'><td>Gesamtkosten</td><td></td><td></td><td>$price</td></tr>\n"
    ?>
</table>

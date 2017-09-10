<?php
// Zu Datenbank verbinden
$mysqli = mysqli_connect("localhost", "root", "SiSal2002", "mom");
$mysqli->set_charset("utf8");
setlocale(LC_ALL, "de_DE.UTF-8");

$month = array();
$years = array();

$result = $mysqli->query("SELECT * FROM anwesenheit");
while ($ar = $result->fetch_assoc()) {
    list($year, $months) = explode("-", $ar["datum"]);
    $month[] = "$year-$months";
    $years[] = "$year";
}

$teilnehmer = array();
$result = $mysqli->query("SELECT * FROM teilnehmer");
while ($ar = $result->fetch_assoc()) {
    $teilnehmer[] = $ar;
}

$years = array_unique($years);
$montht = array_unique($month);

$month = array();
$monthStr = array();

foreach ($montht as $m) {
    $month[] = $m;
    $monthStr[] = strftime("%B, %Y", strtotime($m));
}
?>
<script type="text/javascript">
    function callMonth(monat)
    {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                document.getElementById("content2").innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', '/mom/query.php?month=' + monat, true);
        xhr.send(null);
    }
    function callYear(year)
    {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                document.getElementById("content2").innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', '/mom/query.php?year=' + year, true);
        xhr.send(null);
    }
    function callTyp(typ)
    {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                document.getElementById("content2").innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', '/mom/query.php?typ=' + typ, true);
        xhr.send(null);
    }
    function callName(name)
    {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                document.getElementById("content2").innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', '/mom/query.php?name=' + name, true);
        xhr.send(null);
    }
    function call()
    {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                document.getElementById("content2").innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', '/mom/query.php', true);
        xhr.send(null);
    }

    function updateList(value) {
        selector = document.getElementById('subSorter');
        while (selector.length > 0) {
            selector.remove(selector.length - 1);
        }
        if (value != "all") {
            selector.style.display = "";
        } else {
            selector.style.display = "none";
        }

        switch (value) {
            case "month":
<?php for ($i = 0; $i < count($month); $i++) { ?>
                    selector.options[selector.options.length] = new Option('<?= $monthStr[$i] ?>', '<?= $month[$i] ?>');
<?php } ?>
                break;
            case "year":
<?php foreach ($years as $a) { ?>
                    selector.options[selector.options.length] = new Option('<?= $a ?>', '<?= $a ?>');
<?php } ?>
                break;
            case "typ":
                selector.options[selector.options.length] = new Option('Bezahlt', '0');
                selector.options[selector.options.length] = new Option('Gutschein', '1');
                selector.options[selector.options.length] = new Option('Probe', '2');
                break;
            case "name":
<?php foreach ($teilnehmer as $a) { ?>
                    selector.options[selector.options.length] = new Option('<?= $a["name"] . " " . $a["vname"] ?>', '<?= $a["id"] ?>');
<?php } ?>
                break;
        }

    }

    function call2List() {
        sel1 = document.getElementById('sorter');
        sel2 = document.getElementById('subSorter');

        switch (sel1.value) {
            case "month":
                callMonth(sel2.value);
                break;
            case "year":
                callYear(sel2.value);
                break;
            case "typ":
                callTyp(sel2.value);
                break;
            case "name":
                callName(sel2.value);
                break;
                
            default:
                call();
                break;
        }
    }

    call();
</script>
<select id="sorter" onchange="updateList(this.value)">

    <optgroup label="Zeit" id="g_time">
        <option value="year">Jahr</option>
        <option value="month">Monat</option>
    </optgroup>

    <optgroup label="Andere" id="g_typ">
        <option value="typ">Art</option>
        <option value="name">Name</option>
        <option value="all" selected="">Alle</option>
    </optgroup>
</select>

<select style="display: none" id="subSorter">

</select>
<button onclick="call2List()" value="Sortieren">Sortieren</button>
<a class="button" href="?section=anwesenheitsliste&sub=eintragen" style="float: right"><span>Eintragen </span></a>
<div id="content2"></div>
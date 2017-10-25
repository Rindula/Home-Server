<?php

$conn = new mysqli("localhost", "root", "SiSal2002", "rechnungen");
$conn->query("SET NAMES 'utf8'");

$lastId = $conn->real_escape_string($_GET["last"]);
if (!empty($_GET["id"])) {

    $id = $conn->real_escape_string(str_replace("\^", "", strtolower($_GET["id"])));

    $ret = $conn->query("SELECT aid, bez FROM artikel WHERE identifier = '$id'");
    $r = $ret->fetch_assoc();
    $aid = $r["aid"];

    $conn->query("INSERT INTO rechnungspointer (rid, aid) VALUES ('$lastId', '$aid')");
}

$ret = $conn->query("SELECT a.bez, a.preis, count(rp.aid) as 'cnt' FROM artikel as a inner join rechnungspointer as rp on rp.aid = a.aid inner join rechnung as r on rp.rid = r.rid WHERE r.rid = $lastId group by a.aid");
$p = 0;
while ($r = $ret->fetch_assoc()) {
    $pr = number_format($r["preis"] * $r["cnt"], 2);
    echo "<div class='list-group-item'><div class='d-flex w-100 justify-content-between'><h5 class='mb-5'>".$r["cnt"]."x ".$r["bez"]."</h5><small class='text-muted'>".$r["cnt"]." x ".$r["preis"]."€<br><b>".$pr."€</b></small></div></div>";
    $p += $pr;
}

$conn->query("UPDATE rechnung SET preis = '$p' WHERE rid = '$lastId'");
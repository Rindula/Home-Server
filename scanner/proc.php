<meta http-equiv="refresh" content="0; url=.">
<?php

$c = $_POST["code"];

if (trim($c) == "") {
    return;
}

if (strlen($c) == 8 || strlen($c) == 12 || strlen($c) == 13) {
    $conn = new mysqli("localhost", "root", "SiSal2002", "scanner");

    $tablename = "scan_" . date("mY") . "";

    $conn->query("CREATE TABLE IF NOT EXISTS $tablename ( `code` varchar(13) NOT NULL, `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(timestamp)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    echo $conn->error;
        
    $conn->query("INSERT INTO $tablename (code) VALUES('$c')");
    

    $conn->close();
}

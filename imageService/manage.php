<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

$name = $_POST["name"];

$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/imageService/uploads/';
$filename = random_string(100) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$uploadfile = $uploaddir . $filename;

$conn = new mysqli("25.83.12.108",  "root", "SiSal2002", "images");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo '<pre>';
if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
    echo "<h2>Datei ist valide und wurde erfolgreich hochgeladen.</h2>";

    $sql = "INSERT INTO image (name, filename) VALUES ('$name', '$filename')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }    
} else {
    echo "Möglicherweise eine Dateiupload-Attacke!";
}

echo 'Weitere Debugging Informationen:';
print_r($_FILES);

print "</pre>";

?>
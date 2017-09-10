<?php 
session_start();
include "vars.php";
$pdo = new PDO('mysql:host=localhost;dbname=stats', 'root', $mySqlPassword);
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Registrierung</title> 
</head> 
<body>
 
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
 $error = false;
 $name = $_POST['name'];
 $passwort = $_POST['passwort'];
 $passwort2 = $_POST['passwort2'];

 if(strlen($passwort) == 0) {
 echo 'Bitte ein Passwort angeben<br>';
 $error = true;
 }
 if($passwort != $passwort2) {
 echo 'Die Passwörter müssen übereinstimmen<br>';
 $error = true;
 }
 
 //Überprüfe, dass die Name noch nicht registriert wurde
 if(!$error) { 
 $statement = $pdo->prepare("SELECT * FROM users WHERE name = :name");
 $result = $statement->execute(array('name' => $name));
 $user = $statement->fetch();
 
 if($user !== false) {
 echo 'Diese Name ist bereits vergeben<br>';
 $error = true;
 } 
 }
 
 //Keine Fehler, wir können den Nutzer registrieren
 if(!$error) { 
 $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
 
 $statement = $pdo->prepare("INSERT INTO users (name, passwort) VALUES (:name, :passwort)");
 $result = $statement->execute(array('name' => $name, 'passwort' => $passwort_hash));
 
 if($result) { 
 echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
 $showFormular = false;
 } else {
 echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
 }
 } 
}
 
if($showFormular) {
?>
 
<form action="?register=1" method="post">
Name:<br>
<input type="name" size="40" maxlength="250" name="name"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
Passwort wiederholen:<br>
<input type="password" size="40" maxlength="250" name="passwort2"><br><br>
 
<input type="submit" value="Abschicken">
</form>
 
<?php
} //Ende von if($showFormular)
?>
 
</body>
</html>
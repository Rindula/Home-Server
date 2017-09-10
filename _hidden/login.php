<?php 
session_start();
include "vars.php";
$pdo = new PDO('mysql:host=localhost;dbname=stats', 'root', $mySqlPassword);
 
if(isset($_GET['login'])) {
 $name = $_POST['name'];
 $passwort = $_POST['passwort'];
 
 $statement = $pdo->prepare("SELECT * FROM users WHERE name = :name");
 $result = $statement->execute(array('name' => $name));
 $user = $statement->fetch();
 
 //Überprüfung des Passworts
 if ($user !== false && password_verify($passwort, $user['passwort'])) {
 $_SESSION['userid'] = $user['id'];
 die("<meta http-equiv='refresh' content='5; /'><h1>Login erfolgreich. Weiterleitung erfolgt...</h1>");
 } else {
 $errorMessage = "E-Mail oder Passwort war ungültig<br>";
 }
 
};
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title> 
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
 echo $errorMessage;
};
?>
 
<form action="?login=1" method="post">
E-Mail:<br>
<input type="name" size="40" maxlength="250" name="name"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
<input type="submit" value="Abschicken">
</form> 
</body>
</html>
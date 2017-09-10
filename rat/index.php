<?php
include("includes/header.php");

if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $page = stripslashes($page);
  $page = strip_tags($page);
  $page = mysqli_real_escape_string($connect, $page);
	
	if($login == true) {
		$page = "login";
	}

  switch($page) {
    case "clients":
    include("clients.php");
    break;

    case "login":
    include("login.php");
    break;

    case "logout":
    include("logout.php");
    break;

    case "usercp":
    include("settings.php");
    break;

    default:
    include("login.php");
    break;
  }
  include("includes/footer.php");
}

 ?>

<?php

/*
  Variablen zum Anzeigen
*/
$conn = new mysqli("localhost", "root", "SiSal2002", "rechnungen");
if (($ret = $conn->query("SELECT COUNT(*) FROM rechnung WHERE offen = 1")) !== FALSE) {
  $r = $ret->fetch_array();
	$anzahlRechnungen = $r[0];
} else {
	$anzahlRechnungen = 0;
}

$conn->query("use support");
if (($ret = $conn->query("SELECT COUNT(*) FROM tickets WHERE supporter = 0")) !== FALSE) {
  $r = $ret->fetch_array();
  $supportTickets = $r[0];

  if($supportTickets == 1) {
    $supportTickets = $supportTickets . " neues Ticket";
  } else {
    $supportTickets = $supportTickets . " neue Tickets";
  }

} else {
  $supportTickets = 0;
}
$conn->close();
$hw = file_get_contents("https://schule.rindula.de/apis/haapi.php?hausaufgaben");
$hw = json_decode($hw);
$hw = count($hw);

?>
<!-- Icon Cards-->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-comments"></i>
        </div>
        <div class="mr-5"><?= $hw ?> Hausaufgaben zu erledigen</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="https://schule.rindula.de/hausaufgaben">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5"><?= $anzahlRechnungen ?> Rechnungen offen</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="/rechnungen">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-shopping-cart"></i>
        </div>
        <div class="mr-5">123 New Orders!</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-support"></i>
        </div>
        <div class="mr-5"><?= $supportTickets ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="/tickets">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
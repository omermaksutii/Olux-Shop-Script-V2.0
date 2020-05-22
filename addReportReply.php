<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>
<?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$rep = mysqli_real_escape_string($dbcon, $_POST['Reply']);
$id = mysqli_real_escape_string($dbcon, $_GET['id']);
  $msg     = '
  <div class="panel panel-default"><div class="panel-body"><div class="ticket">'.htmlspecialchars($rep).'</div></div><div class="panel-footer"><div class="label label-info">Buyer</div> - '.date("d/m/Y h:i:s a").'</div></div>
  ';
  if(empty($rep)) { echo "01"; } else {
    $s = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$id' AND uid='$uid'") or die();
    $r = mysqli_fetch_assoc($s);
	if ($r['status'] == "1") {
$date = date("d/m/Y h:i:s a");
    $qqq = mysqli_query($dbcon, "UPDATE reports SET memo = CONCAT(memo,'$msg'),seen='0',lastreply='Buyer',lastup='$date' WHERE id='$id'") or die();
} 
  }
?>
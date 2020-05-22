 <?php
error_reporting(0);
 session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>
<?php

  $country = mysqli_real_escape_string($dbcon, $_POST['country']);
  $infos = mysqli_real_escape_string($dbcon, $_POST['infos']);
  $link = mysqli_real_escape_string($dbcon, $_POST['link']);
  $price = mysqli_real_escape_string($dbcon, $_POST['price']);
   $number = mysqli_real_escape_string($dbcon, $_POST['emailsk']);
   $date = date("d/m/Y h:i:s a");
  if(isset($_POST['start']) and $_POST['start'] == "work"){
	      if ($price == 0)
{
	echo "<br><b>".htmlspecialchars($link)."</b> .... <b>Price not valid!</b> <br>";
} 
      else if (empty($link))
{
	echo "Complete all fields <br>";
} 
 else if (preg_match('/[^0-9]/', $price)) {
	echo "<b>".htmlspecialchars($link)."</b> ...... <b>Price not valid!</b> <br>";
} else {
$check="SELECT * FROM leads WHERE url = '$link'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	echo "".htmlspecialchars($link)." .... <b>Already added</b><br>";
} else { 
    $query = mysqli_query($dbcon, "
  INSERT INTO leads
  (acctype,country,infos,url,price,resseller,sold,sto,dateofsold,date,number,reported)
  VALUES
  ('leads','$country','$infos','$link','$price','$uid','0','','','$date','$number','')
  ")or die(mysqli_error($dbcon));

  if($query){
    echo "".htmlspecialchars($link)." ........ <b><font color=green>Added!</b></font>";

  }else{
    echo '<div class="alert alert-danger" role="alert">Not Added Contact Support</div>';
} }
  } }
?>
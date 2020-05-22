<?php
error_reporting(0);
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

function ambilKata($param, $kata1, $kata2){
    if(strpos($param, $kata1) === FALSE) return FALSE;
    if(strpos($param, $kata2) === FALSE) return FALSE;
    $start = strpos($param, $kata1) + strlen($kata1);
    $end = strpos($param, $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}
  $host = mysqli_real_escape_string($dbcon, $_POST['rdp_host']);
  $login = mysqli_real_escape_string($dbcon, $_POST['rdp_login']);
  $pass = mysqli_real_escape_string($dbcon, $_POST['rdp_pass']);
  $access = mysqli_real_escape_string($dbcon, $_POST['access']);
  $windows = mysqli_real_escape_string($dbcon, $_POST['windows']);
   $ram = mysqli_real_escape_string($dbcon, $_POST['ram']);
  $price = mysqli_real_escape_string($dbcon, $_POST['price']);
   $date = date("d/m/Y h:i:s a");
   $link = "$host|$login|$pass";
  if(isset($_POST['start']) and $_POST['start'] == "work"){
      if ($price == 0)
{
	echo "Price is not valid !";
} 
      else if (empty($host) or empty($login) or empty($pass) or empty($access) or empty($windows) or empty($ram))
{
	echo "Complete all fields <br>";
} 
 else if (preg_match('/[^0-9]/', $price)) {
	echo "Price is not valid !";
} else {
$check="SELECT * FROM rdps WHERE url = '$link'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	echo "Already Added !";
} else { 

$iptohosting = "http://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$host&fields=isp";
		$creatorhosting = file_get_contents($iptohosting);
		$hostingg = ambilkata($creatorhosting, '"isp":"','"}');
$iptocountry = "http://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$host&fields=country_name";
		$creatorcountry = file_get_contents($iptocountry);
		$countryy = ambilkata($creatorcountry, '"country_name":"','"}');
$iptocity = "http://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$host&fields=city";
		$creatorcity = file_get_contents($iptocity);
		$cityy = ambilkata($creatorcity, '"city":"','"}');
		if(empty($hostingg)){
			echo "Seems not working !";
		} else {
    $query = mysqli_query($dbcon, "
  INSERT INTO rdps
  (acctype,country,city,hosting,price,url,sold,sto,dateofsold,date,access,windows,ram,resseller,reported)
  VALUES
  ('rdp','$countryy','$cityy','$hostingg','$price','$link','0','','','$date','$access','$windows','$ram','$uid','')
  ")or die();

  if($query){
echo "Succefully Added .. (".htmlspecialchars($host).") with ".htmlspecialchars($login)."/".htmlspecialchars($pass)."";
  }else{
    echo '<div class="alert alert-danger" role="alert">Not Added Contact Support</div>';
  } }  }
  } }
?>
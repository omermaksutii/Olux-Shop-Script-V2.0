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
function ambilKata($param, $kata1, $kata2){
    if(strpos($param, $kata1) === FALSE) return FALSE;
    if(strpos($param, $kata2) === FALSE) return FALSE;
    $start = strpos($param, $kata1) + strlen($kata1);
    $end = strpos($param, $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}
  $host = mysqli_real_escape_string($dbcon, $_POST['host']);
  $login = mysqli_real_escape_string($dbcon, $_POST['login']);
  $pass = mysqli_real_escape_string($dbcon, $_POST['pass']);
  $port = mysqli_real_escape_string($dbcon, $_POST['port']);
  $price = mysqli_real_escape_string($dbcon, $_POST['price']);
   $date = date("d/m/Y h:i:s a");
  if(isset($_POST['start']) and $_POST['start'] == "work"){
      if ($price == 0)
{
	echo "<br><b>".htmlspecialchars($host)."</b> .... <b>Price not valid!</b> <br>";
} 
      else if (empty($host))
{
	echo "Complete all fields <br>";
} 
 else if (preg_match('/[^0-9]/', $price)) {
	echo "<br><b>".htmlspecialchars($host)."</b> .... <b>Price not valid!</b> <br>";
} else {
$check="SELECT * FROM smtps WHERE url = '$link'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	echo "<br><b>".htmlspecialchars($host)."</b> .... <b>Already Added</b> <br>";
} else { 
if (preg_match('/http/', $host)) {
$host = parse_url($host, PHP_URL_HOST);
} 
   $link = "$host|$login|$pass|$port";
$sitetoip = "http://api.ipstack.com/$host?access_key=f991d31642a29f8a8197b57ef76f167b&fields=ip";
		$creatorip = file_get_contents($sitetoip);
		$ipsss = ambilkata($creatorip, '{"ip":"','"}');
$iptohosting = "https://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$ipsss&fields=isp";
		$creatorhosting = file_get_contents($iptohosting);
		$hostingg = ambilkata($creatorhosting, '"isp":"','"}');
$iptocountry = "http://api.ipstack.com/$host?access_key=f991d31642a29f8a8197b57ef76f167b&fields=country_name";
		$creatorcountry = file_get_contents($iptocountry);
		$countryy = ambilkata($creatorcountry, '{"country_name":"','"}');
		if(empty($hostingg)){
			echo "<b>".htmlspecialchars($host)."</b> ........... <b>Seems not working!</b>";
			} else {
    $query = mysqli_query($dbcon, "
  INSERT INTO smtps
  (acctype,country,infos,price,url,sold,sto,dateofsold,date,resseller,reported)
  VALUES
  ('smtp','$countryy','$hostingg','$price','$link','0','','','$date','$uid','')
  ")or die();

  if($query){
    echo "<b>".htmlspecialchars($host)."</b> ........ <b><font color=green>Added!</b></font>";

  }else{
    echo '<div class="alert alert-danger" role="alert">Not Added Contact Support</div>';
  } }  
  } } }
?>
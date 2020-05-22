<?php
ob_start();
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
function curl_get_contents($url)
{
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($curl);
  curl_close($curl);
  return $data;
}
function ambilKata($param, $kata1, $kata2){
    if(strpos($param, $kata1) === FALSE) return FALSE;
    if(strpos($param, $kata2) === FALSE) return FALSE;
    $start = strpos($param, $kata1) + strlen($kata1);
    $end = strpos($param, $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}
  $website = mysqli_real_escape_string($dbcon, $_POST['site']);
     $balance = mysqli_real_escape_string($dbcon, $_POST['balance']);
   $country = mysqli_real_escape_string($dbcon, $_POST['country']);
    $infos = mysqli_real_escape_string($dbcon, $_POST['infos']);
    $url = mysqli_real_escape_string($dbcon, $_POST['inputs']);
  $price = mysqli_real_escape_string($dbcon, $_POST['price']);
   $date = date("d/m/Y h:i:s a");
   $link = "$website | $url ";
  if(isset($_POST['start']) and $_POST['start'] == "work"){
      if ($price == 0)
{
	echo "<br><b>".htmlspecialchars($website)."</b> .... <b>Price not valid!</b> <br>";
} 
      else if (empty($website))
{
	echo "Complete all fields <br>";
} 
 else if (preg_match('/[^0-9]/', $price)) {
	echo "Price not valid!</b> <br>";
} else {
$check="SELECT * FROM banks WHERE url = '$link'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	echo "<br><b>".htmlspecialchars($website)."</b> .... <b>Already Added</b> <br>";
} else { 
    $query = mysqli_query($dbcon, "
  INSERT INTO banks
  (acctype,country,infos,price,url,sold,sto,dateofsold,date,resseller,reported,bankname,balance)
  VALUES
  ('banks','$country','$infos','$price','$link','0','','','$date','$uid','','$website','$balance')
  ")or die(mysqli_error($dbcon));

  if($query){
    echo "<b>".htmlspecialchars($website)."</b> ........ <b><font color=green>Added!</b></font>";

  }else{
    echo '<div class="alert alert-danger" role="alert">Not Added Contact Support</div>';
  } }  }
  } 
?>
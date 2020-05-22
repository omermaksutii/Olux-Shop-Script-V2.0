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
 $infos = mysqli_real_escape_string($dbcon, $_POST['infos']);
  $link = mysqli_real_escape_string($dbcon, $_POST['link']);
  $price = mysqli_real_escape_string($dbcon, $_POST['price']);
   $namescm = mysqli_real_escape_string($dbcon, $_POST['tutoname']);
   $date = date("d/m/Y h:i:s a");

  if(isset($_POST['start']) and $_POST['start'] == "work"){
	  	         if ($price == 0)
{
	echo "<b>Price not valid!</b> <br>";
} 
      else if (empty($link))
{
	echo "Complete all fields <br>";
} 
 else if (preg_match('/[^0-9]/', $price)) {
	echo "<b>Price not valid!</b> <br>";
} else {
  $qq = @mysqli_query($dbcon, "SELECT * FROM tutorials") or die("error here");
  $check="SELECT * FROM tutorials WHERE url = '$link'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
while($row = mysqli_fetch_assoc($qq)){
     $st = $row['url'];
	 
	 			$oddd = parse_url($link, PHP_URL_HOST);
  			 if (preg_match("#$oddd#", $st))  {	
			 } 
    }
    echo "<b>Already added</b><br/>";
} else {


    $query = mysqli_query($dbcon, "
  INSERT INTO tutorials
  (acctype,country,infos,url,price,resseller,sold,sto,dateofsold,date,tutoname)
  VALUES
  ('tutorial','-','$infos','$link','$price','$uid','0','','','$date','$namescm')
  ")or die();

  if($query){
    echo "<font color=green>Added!</b></font>";

  }else{
    echo '<div class="alert alert-danger" role="alert">Not Added Contact Support</div>';
} }
  } }
?>
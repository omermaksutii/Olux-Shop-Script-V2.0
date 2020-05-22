<?php
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

		$id = mysqli_real_escape_string($dbcon, $_GET['id']);

$sql = "SELECT * FROM mailers WHERE id=$id";
		
$query = mysqli_query($dbcon, $sql);

while ($row = mysqli_fetch_array($query))
$serverurl = $row['url'];
$o = parse_url($serverurl, PHP_URL_HOST);
$mailerid = $row['id'];
$sqlppp = "SELECT * FROM users where username='$usrid'";
		
$querypppp = mysqli_query($dbcon, $sqlppp);

while ($rozd = mysqli_fetch_array($querypppp))
	$testemail = $rozd['testemail'];
		$ch = curl_init("$serverurl");
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in second
curl_setopt($ch, CURLOPT_POSTFIELDS,
array('senderEmail'=>"info@$o",'senderName'=>'J E R U X','subject'=>"PHPMailer #$id - Send test",'messageLetter'=>"
This is a test message from #$id
",'emailList'=>"$testemail",'action'=>'send'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$postResult = curl_exec($ch);
curl_close($ch);
	if(preg_match('#<span class="label label-success">Ok</span></div><br>#',$postResult)){
echo"<span class='label label-success'>Sent to $testemail (#$id)</span>";
		return true;
	} elseif(preg_match('#<span class="label label-default">Incorrect Email</span>#',$postResult))  { 
	    	    echo "<span class='label label-danger'>Incorrect email!</span>";
} else {
	    echo "<span class='label label-danger'>Bad!</span>";
	$sql = "UPDATE mailers SET sold='deleted' WHERE id='$id'";
$query = mysqli_query($dbcon, $sql);
	} 

	
	
	?>
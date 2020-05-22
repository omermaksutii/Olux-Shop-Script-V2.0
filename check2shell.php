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


$sql = "SELECT * FROM stufs WHERE id='$id'";
		
$query = mysqli_query($dbcon, $sql);

while ($row = mysqli_fetch_array($query))
$serverurl = $row['url'];
$ch =  curl_init();
	curl_setopt($ch, CURLOPT_URL, $serverurl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0');
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$output = curl_exec($ch);
	curl_close($ch);
	if(preg_match('#Uname:|Safe mode: OFF|Client IP:|Server IP:|Your IP:|Last Modified#si',$output)){
	    echo "<span class='label label-success'>Working</span>";
		return true;
	} else { 
	    echo "<span class='label label-danger'>Bad!</span>";
	$sql = "UPDATE stufs SET sold='deleted' WHERE id='$id'";
$query = mysqli_query($dbcon, $sql);

	}
	
	?>
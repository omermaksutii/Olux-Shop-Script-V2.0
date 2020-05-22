<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

$method = mysqli_real_escape_string($dbcon, $_POST['methodpay']);
$amount = mysqli_real_escape_string($dbcon, htmlspecialchars($_POST['amount']));
if($_POST['methodpay']=="BitcoinPayment"){
	if ($amount < 5) {
		echo "01";
	} else {
$url_btc =    'https://blockchain.info/ticker';
$response_btc = file_get_contents($url_btc);
$object_btc = json_decode($response_btc);
//print_r($object_btc);
$usdprice = $object_btc->{"USD"}->{"last"};
$rate['rate'] =  $object_btc->{"USD"}->{"last"};
$rate = $rate['rate'];
$btcamount = number_format($amount/$rate, 8, '.', '');
$btcamm = $btcamount;
$guid = 'martindinos8@outlook.com';  // Block.io account
$main_password = '121212aa'; // Block.io Password
$pin = '121212aa'; // Block.io PIN
$apikey = "1c84-7e22-51e0-0a64"; // block.io API KEY
$uidz = "".$uid."-".time()."";
$ao = file_get_contents("https://block.io/api/v2/get_new_address/?api_key=$apikey&label=$uidz");
$zz = json_decode($ao);
$btcadrs = $zz->data->address;
$random = substr(md5(mt_rand()), 0, 60);
$date = date('Y-m-d H:i:s');
$sql2 = "INSERT INTO payment(user,method,amount,amountusd,address,p_data,state,date) VALUES('$uid','Bitcoin','$btcamm','$amount','$btcadrs','$random','pending','$date')";
mysqli_query($dbcon, $sql2);
	echo $random; }

} else {
if($_POST['methodpay']=="PerfectMoneyPayment"){
		if ($amount < 10) {
		echo "01";
	} else {
$url_btc =    'https://blockchain.info/ticker';
$response_btc = file_get_contents($url_btc);
$object_btc = json_decode($response_btc);
//print_r($object_btc);
$usdprice = $object_btc->{"USD"}->{"last"};
$rate['rate'] =  $object_btc->{"USD"}->{"last"};
$rate = $rate['rate'];
$btcamount = number_format($amount/$rate, 8, '.', '');
$btcamm = $btcamount;
$guid = 'martindinos8@outlook.com';  // Block.io account
$main_password = '121212aa'; // Block.io Password
$pin = '121212aa'; // Block.io PIN
$apikey = "1c84-7e22-51e0-0a64"; // block.io API KEY
$uidz = "".$uid."-".time()."";
$ao = file_get_contents("https://block.io/api/v2/get_new_address/?api_key=$apikey&label=$uidz");
$zz = json_decode($ao);
$btcadrs = $zz->data->address;
$random = substr(md5(mt_rand()), 0, 60);
$date = date('Y-m-d H:i:s');
$sql2 = "INSERT INTO payment(user,method,amount,amountusd,address,p_data,state,date) VALUES('$uid','PerfectMoney','$btcamm','$amount','$btcadrs','$random','pending','$date')";
mysqli_query($dbcon, $sql2);
echo $random;
}  }
else { header("location: index.html"); }}
?>
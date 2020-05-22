<?php
require_once '../includes/block_io.php';

$apiKey = "1c84-7e22-51e0-0a64";
$version = 2; // API version
$pin = "121212aa";
$block_io = new BlockIo($apiKey, $pin, $version);

$sellername = $_GET["seller"];
$receiveusd = $_GET["receiveusd"];
$receivebtc = $_GET["receivebtc"];
$btcaddress = $_GET["btcaddress"];
$pending = $_GET["pending"];
$removedfrombalance = $sales - $total;
 //// BitPay BTC Rate
$url='https://bitpay.com/api/rates';
$json=json_decode( file_get_contents( $url ) );
$dollar=$btc=0;

foreach( $json as $obj ){
    if( $obj->code=='USD' )$btc=$obj->rate;
}
///// End Bitpay Btc Rate
 //// Block.io Api Estimate fee
$ApiKey = "1c84-7e22-51e0-0a64";
$UrlApi = "https://block.io/api/v2/get_network_fee_estimate/?api_key=$ApiKey&amounts=$receivebtc&to_addresses=$btcaddress";
$ch = curl_init("$UrlApi");
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in second
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$postResultFee = curl_exec($ch);
$outputFee = json_decode($postResultFee);
$EstimatedFee = substr($outputFee->data->estimated_network_fee , 0, 9);
///// End Api
$EstimatedFeeDivision = substr($btc * $EstimatedFee,0,4);
$EstimatedFeeDivisionUsd = $EstimatedFeeDivision / 2;
////
$DivUsdtoBtc = file_get_contents("https://blockchain.info/tobtc?currency=USD&value=$EstimatedFeeDivisionUsd");
$DivUsdtoBtcAB = substr($DivUsdtoBtc, 0, 9);
////
$receivebtcMinusFee = $receivebtc - $DivUsdtoBtcAB;
include "header.php";

echo '
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Send payment <span class="glyphicon glyphicon-send"></span></b></div>
  <div class="col-md-5">
 <hr>
<form method="post">
<tr>
<td width="30%">Seller name :</td>
<td width="70%"><input type="text" class="form-control" size="60px" name="username" value="'.$sellername.'" disabled/></td>
</tr>
<tr>
<td width="30%">Amount in USD $ :</td>
<td width="70%"><input type="text" class="form-control" size="60px" name="amount" value="'.$receiveusd.'" disabled/></td>
</tr>
<tr>
<td width="30%">Amount in BTC :<i class="fa fa-bitcoin"></i></td>
<td width="70%"><input type="text" class="form-control" size="60px" name="abtc" value="'.$receivebtcMinusFee.'" disabled/></td>
</tr>
<tr>
<td width="30%">BTC address :</td>
<td width="70%"><input type="text" class="form-control" size="60px" name="adbtc" value="'.$btcaddress.'" disabled/></td>
</tr><br>
<tr><td colspan="2"><center><input type="submit" class="btn btn-primary" value="Send '.$receivebtcMinusFee.' BTC"/></center></td></tr>
<input type="hidden" name="start" value="work" />
</form>
<hr>
Fee Estimated : <b>'.$EstimatedFee.' <span class="glyphicon glyphicon-bitcoin"></span></b><font color="red"> <b>=~</b></font> <b>'.substr($btc * $EstimatedFee, 0, 4).'$</b>
</center>';
	 
if(isset($_POST['start']) and $_POST['start'] == "work"){
 $queryz = mysqli_query($dbcon, "SELECT * from resseller where username='$sellername'")or die("mysql error");
	  $rzaw = mysqli_fetch_array($queryz);
	  if ($rzaw['withdrawal'] == "requested") {
    $user = mysqli_real_escape_string($dbcon, $_POST['username']);
    $amount = mysqli_real_escape_string($dbcon, $_POST['amount']);
    $abtc = mysqli_real_escape_string($dbcon, $_POST['abtc']);
	 $urlbtc = mysqli_real_escape_string($dbcon, $_POST['urlbtc']);
    $adbtc = mysqli_real_escape_string($dbcon, $_POST['adbtc']);
 $date = date('Y/m/d h:i:s');
 //// Block.io Api
$withdraw = $block_io->withdraw(array("amount" => "$receivebtcMinusFee", "to_address" => "$btcaddress"));
$status = $withdraw->status;
if ($status == "success") {
$tx_id = $withdraw->data->txid;
$urlbtc = "https://www.blockchain.com/btc/tx/$tx_id";
////
     $query = mysqli_query($dbcon, "
   INSERT INTO rpayment
   (username,amount,abtc,adbtc,method,date,url,urid,rate,fee)
   VALUES
   ('$sellername','$receiveusd','$receivebtc','$btcaddress','cashout','$date','$urlbtc','0','$btc','$EstimatedFee')
   ")or die("mysql error");
  $query2 = mysqli_query($dbcon, "UPDATE resseller SET withdrawal='done', soldb='$pending' where username='$sellername'")or die("mysql error");
echo "Payment sent <br>Proof : $urlbtc ";
	  } else {
		  $error = $withdraw->data->error_message;
		  echo "Error sending payment! <br><textarea class='form-control'>$error</textarea>";
} 
} else {
	echo "Already paid!";
} }
?>
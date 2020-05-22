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
$p_data = mysqli_real_escape_string($dbcon, $_GET['p_data']);
 $q = mysqli_query($dbcon, "SELECT * FROM payment WHERE user='$uid' and p_data='$p_data'")or die(mysqli_error($dbcon));
 while($row = mysqli_fetch_assoc($q))
	 if ($row['method'] == "Bitcoin") {
$result = mysqli_query($dbcon, "SELECT balance FROM users WHERE username='$uid'") or die("error here");
$rz = mysqli_fetch_row($result);
$balance = $rz[0];
$a = $row["address"];
    $url = "https://blockchain.info/q/addressbalance/$a?confirmations=0";
    $page = _curl($url, '', '');
        $amount = $page/100000000;
        if($amount>= $row['amount']){
						if ($row['state'] == "paid") {
							        $y = $row['amountusd'];
		$msg = "<div class='alert alert-dismissible alert-success'><strong>Transaction Received <i class='glyphicon glyphicon-ok'></i></strong><br>An amount of $y$ has been added to your balance.</div>";
		echo '
{"stop":"1","time":"'.date("d/m/Y h:i:s a").'","btc":"'.$amount.'","state":"Paid","error":"1","errorTXT":"'.$msg.'"}';
	echo '
	
{"stop":"1","time":"'.date("d/m/Y h:i:s a").'","btc":"'.$amount.'","state":"Paid","error":"1","errorTXT":"<div class="alert alert-dismissible alert-success"><strong>Payment Received! <i class="glyphicon glyphicon-ok"></i></strong><p>An amount of <b>$y$</b> has been added to your balance.</p></div>"}'; }
			if ($row['state'] == "pending") {
        $y = $row['amountusd'];
        $bonus = $y*20/100;

              $x = $balance+$y;
            $sql = "UPDATE users SET balance=$x WHERE username='$uid'";
            mysqli_query($dbcon, $sql);

            $sql2 = "INSERT INTO orders(amount,btcamount,username,lrpaidby,lrtrans,ip,state,date) VALUES('$y','$ba','$uid','$a','$a','$ip','Bitcoin',now())";
            mysqli_query($dbcon, $sql2);
		$msg = "<div class='alert alert-dismissible alert-success'><strong>Transaction Received <i class='glyphicon glyphicon-ok'></i></strong><br>An amount of <b>$y$</b> has been added to your balance.</div>";
		echo '
{"stop":"1","time":"'.date("d/m/Y h:i:s a").'","btc":"'.$amount.'","state":"Paid","error":"1","errorTXT":"'.$msg.'"}';
            $sql = mysqli_query($dbcon, "UPDATE payment SET state='paid' WHERE p_data='$p_data'");
		} } else {
		echo '
{"stop":"0","time":"'.date("d/m/Y h:i:s a").'","btc":"'.$amount.'","state":"Not Paid","error":"0","errorTXT":"0"}';

} 
	 }
?>
<?php


function _curl($url, $post = "", $sock, $usecookie = false)
{
    $ch = curl_init();
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    if (!empty($sock)) {
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_PROXY, $sock);
    }
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT,
        "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3");
    if ($usecookie) {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function get_string_between($string, $start, $end)
{
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0)
        return "";
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
function VisitorIP()
{
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else $ip = $_SERVER['REMOTE_ADDR'];

	return trim($ip);
} 


?>

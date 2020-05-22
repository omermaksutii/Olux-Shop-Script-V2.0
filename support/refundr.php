<?php
 ob_start();
session_start();
include "../includes/config.php";

if(!isset($_SESSION['aname']) and !isset($_SESSION['apass'])){
   header("location: login.php");
   exit();
}
$id = $_GET['id'];
$myid = mysqli_real_escape_string($dbcon, $id);


$get = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$myid'");
$row = mysqli_fetch_assoc($get);

$date = date("m/d/Y h:i:s a");
$resseller = $row['resseller'];
$buyer = $row['uid'];
$acctype = $row['acctype'];
$sid = $row['s_id'];
$surl = $row['s_url'];
$price = $row['price'];
$d = $row['date'];
// Check connection

$check="SELECT * FROM refund WHERE url = '$surl' and ids='$sid' and buyer='$buyer'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
	echo "already refunded";
} else {
$qq = mysqli_query($dbcon, "INSERT INTO refund
    (ids,type,url,price,buyer,sdate,rdate,resseller)
    VALUES
    ('$sid','$acctype','$surl','$price','$buyer','$d','$date','$resseller')
    ")or die("error insert into refund");
if($qq){
  $b = ($price * 55) / 100 ;
  $refund = mysqli_query($dbcon, "UPDATE users SET balance=(balance +$price) WHERE username='$buyer'");
  $refund = mysqli_query($dbcon, "UPDATE reports SET refunded='Refunded' WHERE id='$myid'");
  $backto = mysqli_query($dbcon, "UPDATE resseller SET isold=(isold - 1),soldb=(soldb - $price) WHERE username='$resseller'");
   $msg     = '
  <div class="panel panel-default">
  <div class="panel-body">
<b>Refunded.<br>Thank you for using Jerux.</b>
 </div>
  <div class="panel-footer"><div class="label label-warning">Support</div> - '.date("d/m/Y h:i:s a").'</div>
  </div>
  ';
    $date = date("d/m/Y h:i:s a");
  $qq = mysqli_query($dbcon, "UPDATE reports SET memo = CONCAT(memo,'$msg'),status = ('0'),seen='1',lastup='$date',lastreply='Support',state='accepted' WHERE id='$myid'")or die("mysql error");
  if($refund and $backto){
     header("location: viewr.php?id=$myid");
  }else{
    echo "problem";
  }
} }

if(isset($_GET['action']) and $_GET['action'] == 'nr' ){
 $nrefund = mysqli_query($dbcon, "UPDATE reports SET refunded='not Refunded' WHERE id='$myid'");
 if($nrefund){
  header("location: viewr.php?id=$myid");
 }else{
    echo "problem in not refund";

}
}
?>
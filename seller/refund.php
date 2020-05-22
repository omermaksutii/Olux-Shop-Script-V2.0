<?php
include "./header.php";

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}
$id = $_GET['id'];
$myid = mysqli_real_escape_string($dbcon, $id);


$get = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$myid' and resseller='$uid'");
$row = mysqli_fetch_assoc($get);

$date = date("Y-m-d h:i:sa");
$resseller = $row['resseller'];
$buyer = $row['uid'];
$acctype = $row['acctype'];
$sid = $row['s_id'];
$surl = $row['s_url'];
$price = $row['price'];
$d = $row['date'];
// Check connection
if($dbcon === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$check="SELECT * FROM refund WHERE url = '$surl' and ids='$sid' and buyer='$buyer'";
$rs = mysqli_query($dbcon,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {

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
  <div class="panel-footer"><div class="label label-success">Seller</div> - '.date("d/m/Y h:i:s a").'</div>
  </div>
  ';
    $date = date("d/m/Y h:i:s a");
  $qq = mysqli_query($dbcon, "UPDATE reports SET memo = CONCAT(memo,'$msg'),status = ('0'),lastreply='Seller',seen='1',lastup='$date',state='accepted' WHERE id='$myid'")or die("mysql error");
  if($refund and $backto){
     header("location: vr-$myid.html");
  }else{
     header("location: vr-$myid.html");
  }
} }

if(isset($_GET['action']) and $_GET['action'] == 'nr' ){
 $nrefund = mysqli_query($dbcon, "UPDATE reports SET refunded='not Refunded' WHERE id='$myid'");
 if($nrefund){
  header("location: ./vr-$myid.html");
 }else{
    echo "problem in not refund";

}
}
?>
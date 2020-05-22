<?php
error_reporting(0);
include "header.php";

$uid = mysqli_real_escape_string($dbcon, $_GET["id"]);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE id='$uid'")or die(mysql_error());
$r = mysqli_fetch_assoc($q);
$date = date("Y/m/d h:i:s");
$user = $r['username'];

if($r['resseller'] == "1"){
    die('<br><div class="alert alert-danger" role="alert"><center>Already seller</center></font>');
    exit();
}


 $qu = mysqli_query($dbcon, "UPDATE users SET resseller='1' WHERE id='$uid'")or die();
 if($qu){
 echo '<br><div class="alert alert-success" role="alert"><center>Seller system is activated Congrats</center></font>';
     $k = mysqli_query($dbcon, "
 INSERT INTO `resseller` (
`username` ,
`unsoldb` ,
`soldb` ,
`isold` ,
`iunsold` ,
`activate`,
`btc`,
`withdrawal`,
`allsales`,
`lastweek`
)
VALUES (
'$user',  '0',  '0',  '0',  '0',  '$date','','',null,null
)")or die(mysqli_error());

 }else{
  echo '<br><div class="alert alert-danger" role="alert"><center>error system not activated</center></font>';
 }


?>



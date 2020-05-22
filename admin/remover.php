<?php

include "header.php";

$uid = mysqli_real_escape_string($dbcon, $_GET[id]);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE id='$uid'")or die(mysql_error());
$r = mysqli_fetch_assoc($q);
$date = date("d/m/Y h:i:s a");
$user = $r['username'];

if($r['resseller'] == "0"){
    die('<br><div class="alert alert-warning" role="alert"><center>not seller</center></font>');
    exit();
}


 $qu = mysqli_query($dbcon, "UPDATE users SET resseller='0' WHERE id='$uid'")or die();
 if($qu){
 echo '<br><div class="alert alert-danger" role="alert"><center>Seller is banned</center></font>';
 $qu = mysqli_query($dbcon, "DELETE from resseller where username='$user'")or die();
 }else{
  echo '<br><div class="alert alert-warning" role="alert"><center>error seller not banned</center></font>';
 }


?>



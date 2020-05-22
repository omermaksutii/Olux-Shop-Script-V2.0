<?php
ob_start();
session_start();
error_reporting(0);
date_default_timezone_set('UTC');
 include "../../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}

    $new = mysqli_real_escape_string($dbcon, $_GET['id']);
    $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

    $qq = mysqli_query($dbcon, "UPDATE resseller SET btc='$new' WHERE username='$uid'")or die(mysqli_error());
    if($qq){
      echo '<script>swal("Done", "BTC Address changed." , "success");</script>';
    }else{
      echo '<script>swal("Error", "Error pls contact support!" , "error");</script>';
    }

?>
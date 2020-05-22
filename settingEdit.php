<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$oldpass = mysqli_real_escape_string($dbcon, strip_tags($_POST['pp']));
$pass1 = mysqli_real_escape_string($dbcon, strip_tags($_POST['n_pp']));
$pass2 = mysqli_real_escape_string($dbcon, strip_tags($_POST['n_pp2']));
$passstrlen = strlen($pass1);
$salt = 'fs978'; // SALT for encrypting
$password = md5($oldpass . $salt);

$qq2 = mysqli_query($dbcon, "SELECT * FROM users WHERE username='".$_SESSION['sname']."' AND password='".$_SESSION['spass']."'")or die("error");
$rr = mysqli_fetch_assoc($qq2);

if(empty($oldpass) or empty($pass1) or empty($pass1)){
  echo '<script>alert("Something Empty!");</script>';
}elseif($pass1 != $pass2){
  echo '<script>alert("New password not match!");</script>';
}elseif($password != $rr['password']){
  echo '<script>alert("Old password not match!");</script>';
}elseif($passstrlen <5 or $passstrlen > 12){
	   echo '<script>alert("Password must be more than 6 and less Than 12!");</script>';

}else{
     $salt = 'fs978'; // SALT for encrypting
     $newpassword = md5($pass1 . $salt);
     $lvisi = $newpassword;
     $qq = mysqli_query($dbcon, "UPDATE users SET password='$lvisi' WHERE username='".$_SESSION['sname']."'")or die("mysql error");
     if($qq){
       $ko = mysqli_query($dbcon, "UPDATE umanager SET online='0',tpwchanges=(tpwchanges + 1) WHERE username='".$_SESSION['sname']."'")or die("error up");
  echo '<script>alert("Password successfully changed!");</script>';
       echo ' <meta http-equiv="refresh" content="2;URL=logout.html" />';
     }
}

?>
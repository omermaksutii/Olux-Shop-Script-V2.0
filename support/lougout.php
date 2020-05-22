<?php

ob_start();
session_start();
include "../includes/config.php";
if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: login.html");
   //echo "sesion not have a vaule";
   exit();
}else{
   session_destroy();
   header("location: login.html");
   exit();
}
mysql_close();
ob_end_flush();
?>


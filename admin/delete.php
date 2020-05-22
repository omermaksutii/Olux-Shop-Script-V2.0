<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
 include "../includes/config.php";


$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

$id = mysqli_real_escape_string($dbcon, $_GET['id']);
$table = mysqli_real_escape_string($dbcon, $_GET['table']);



  $q0 = mysqli_query($dbcon, "UPDATE $table SET sold='deleted' WHERE id='$id'")or die();
     echo "removed";


?>
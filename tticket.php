<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
 include "includes/config.php";
error_reporting(0);
if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: login.html");
   exit();
}

function secu($item){
    $k = base64_decode($item);
    $m = strip_tags($k);
    $f = $m;
    return $f;
}

$subject =  mysqli_real_escape_string($dbcon, secu($_GET['s']));
$message = base64_decode(mysqli_real_escape_string($dbcon, $_GET['m']));
$proipre =  "high";
if (empty($subject) OR empty($message) ) {
    echo '<script>alert("please complete all fields.")</script>';
} else {
$tid = mysqli_real_escape_string($dbcon, $_GET['id']);

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$usrid'")or die(mysqli_error());
while($row = mysqli_fetch_assoc($q)){
  $stid = mysqli_real_escape_string($dbcon, $row['s_id']);
  $ress = mysqli_real_escape_string($dbcon, $row['resseller']);
  $date = date("Y/m/d h:i:s");
  $memo = mysqli_real_escape_string($dbcon, $message);
  $subj = mysqli_real_escape_string($dbcon, $subject);
  $msg     = '
  <div class="panel panel-default">
  <div class="panel-body">
'.htmlspecialchars($memo).'
 </div>
  <div class="panel-footer"><div class="label label-info">' . $usrid . '</div> - '.date("d/m/Y h:i:s a").'</div>
  </div>
  ';  }
    //echo $stid." ".$memo." -".$subj;
   /* $que = mysqli_query($dbcon, ("INSERT INTO ticket
    (uid,status,priority,memo,date,subject,type,s_id,s_url,resseller,acctype,refunded,price,fmemo,admin_r)
    VALUES
    ('$usrid','1','$prio','$msg','$date','$subject','refunding','$stid','$surl','$ress','$type','Not Yet !','1','$memo',NULL)
  ")or die();   */


  $que = mysqli_query($dbcon, "
INSERT INTO `ticket`
(`uid`, `status`, `s_id`, `s_url`, `memo`, `acctype`, `admin_r`, `date`, `subject`, `type`, `resseller`, `price`, `refunded`, `fmemo`, `seen`, `lastreply`,`lastup`)
 VALUES
('$usrid', '1', '$stid', '$surl', '$msg', '$type','0', '$date', '$subject', 'refunding', '$ress', '1', 'Not Yet !', '$memo', '0', '$usrid','$date');
  ")or die(mysqli_error($dbcon));

  if($que){
    echo '<script>window.location.replace("./tickets.html"); </script>';
  }else{
   echo '<div class="alert alert-danger" role="alert">Your ticket Not sent something wrong !</div>';
} }



?>
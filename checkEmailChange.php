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
?>
<?php
$checkeremail = mysqli_real_escape_string($dbcon, strip_tags($_POST['c_email']));

$qq2 = mysqli_query($dbcon, "SELECT * FROM users WHERE username='".$_SESSION['sname']."'")or die("error");
$rr = mysqli_fetch_assoc($qq2);

if(empty($checkeremail)){
  echo '01';
}elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$checkeremail)){
  echo '01';
} else {
    $qq = mysqli_query($dbcon, "UPDATE users SET testemail='$checkeremail' WHERE username='".$_SESSION['sname']."'")or die("mysqli error");
echo "SMTP/PHP Mailer checking email changed to $checkeremail";
	}
?>
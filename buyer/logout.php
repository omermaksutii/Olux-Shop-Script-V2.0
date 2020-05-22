<?php
ob_start();
session_start();
include "../includes/config.php";
if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    //echo "sesion not have a vaule";
    exit();
} else {
    $lvisi = date('m-d-y \a\t H:i');
    $qq = mysqli_query($dbcon, "UPDATE users SET lastlogin='$lvisi' WHERE username='" . $_SESSION['sname'] . "' AND password='" . $_SESSION['spass'] . "'") or die("mysqli error");
    $k = mysqli_query($dbcon, "UPDATE umanager SET online='0' WHERE username='" . $_SESSION['sname'] . "'") or die("error up");
    session_destroy();
    header("location: ../");
    exit();
}
mysqli_close();
ob_end_flush();
?>

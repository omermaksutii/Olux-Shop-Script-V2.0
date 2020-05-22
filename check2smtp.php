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

function curl_get_contents($url)
{
    $curl = curl_init($url);
    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 8);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 8);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
$id = mysqli_real_escape_string($dbcon, $_GET['id']);

$sql = "SELECT * FROM smtps WHERE id=$id";

$query = mysqli_query($dbcon, $sql);

function srl($item)
{
    $item0 = $item;
    $item1 = rtrim($item0);
    $item2 = ltrim($item1);
    return $item2;
}
while ($row = mysqli_fetch_array($query))
    $serverurl = $row['url'];
$d      = explode("|", $serverurl);
$url    = srl($d[0]);
$login  = srl($d[1]);
$pass   = srl($d[2]);
$port   = srl($d[3]);
$sqlppp = "SELECT * FROM users where username='$usrid'";

$querypppp = mysqli_query($dbcon, $sqlppp);

while ($rozd = mysqli_fetch_array($querypppp))
    $testemail = $rozd['testemail'];

$socks  = "https://jerux.to/buyer/PortChecker.php?host=$url&port=$port";
$socks2 = curl_get_contents($socks);
if (preg_match('#Success!#', $socks2)) {
    $urltoapi  = "https://jerux.to/buyer/SMTPSend.php?host=$url&login=$login&pass=$pass&port=$port&id=$id&testmail=$testemail";
    $urltoapi2 = curl_get_contents($urltoapi);
    if (preg_match('#Message sent!#', $urltoapi2)) {
        echo "<span class='label label-success'>Sent to $testemail (#$id)</span>";
        return true;
    } else {
        echo "<span class='label label-danger'>Bad!</span>";
        $sql   = "UPDATE smtps SET sold='deleted' WHERE id='$id'";
        $query = mysqli_query($dbcon, $sql);
    }
} else {
    echo "<span class='label label-danger'>Bad!</span>";
    $sql   = "UPDATE smtps SET sold='deleted' WHERE id='$id'";
    $query = mysqli_query($dbcon, $sql);
}

?>
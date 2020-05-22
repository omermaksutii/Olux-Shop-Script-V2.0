<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon,"SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../../");
  exit ();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>
<br>
<div class="row-fluid sortable ui-sortable">
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<div class="box-icon">
					
					<div class="box-content">

 <div>
        
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
			
                <table  class="table table-striped table-bordered table-condensed sort" id="dataTable" width="100%" cellspacing="0">     

                <thead>
            <tr>
  <th></th>
  <th>ID</th>
  <th>Type</th>
  <th>Date Created</th>
  <th>Order ID</th>
  <th>Order Price</th>
  <th>Last Reply</th>
  <th>Last Updated</th>
            </tr>
        </thead>
 <tbody>
 <?php
 $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
 $q = mysqli_query($dbcon, "SELECT * FROM reports WHERE resseller='$uid' and status='1' ORDER BY id DESC")or die(mysql_error());
 while($row = mysqli_fetch_assoc($q)){

	if (empty($row['lastup'])) {
		$lastup = "n/a"; 
		} else { 
		$lastup = $row['lastup']; 	
		}
		if (empty($row['orderid'])) {
		$orderid = "n/a"; 
		} else { 
		$orderid = $row['orderid']; 	
		}
     echo "
 <tr>  
<td></td>
 <td> <a href='vr-".$row['id'].".html' >".$row['id']."</a> </td>
    <td> ".strtolower($row['acctype'])." </td>
    <td> ".$row['date']." </td>
	<td> <a href='vr-".$row['id'].".html' >".$orderid."</a> </td>
	<td> ".$row['price']."$ </td>
    <td> ".$row['lastreply']." </td>
    <td> ".$lastup." </td>
            </tr>
     ";
 
 }
 ?>
</form>
</table>
 </tbody>
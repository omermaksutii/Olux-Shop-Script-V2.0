<?php

  include "header.php";
  $q = mysqli_query($dbcon, "SELECT * FROM reports where status='1' ORDER BY status desc ")or die("error");
  $t = mysqli_num_rows($q);
  global $t,$q;

?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"> <i class="fa-fw fa fa-times"></i> <b>Reports</b></div>

    <?php
    echo '
    <div class="">
    <center>
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">Reports <span class="label label-primary">Total Pending : '.$t.'</span></div>
            <table class="table table-bordered table-striped">
              <thead>
                         <tr>
  <th></th>
  <th>ID</th>
   <th>Buyer</th>
  <th>Seller</th>
  <th>Type</th>
  <th>Date Created</th>
  <th>Order ID</th>
  <th>Order Price</th>
  <th>Report State</th>
  <th>Last Reply</th>
  <th>Last Updated</th>
            </tr>
        </thead>
 <tbody>';
 $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
 $q = mysqli_query($dbcon, "SELECT * FROM reports where status='1' ORDER BY status desc")or die(mysql_error());
 while($row = mysqli_fetch_assoc($q)){
    $st = $row['status'];
    switch ($st){
      case "0" :
       $st = "closed";
       break;
      case "1" :
       $st = "onHold";
       break;
      case "2":
       $st = "onHold";
       break;
    }
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
 <td> <a href='viewr.php?id=".$row['id']."' >".$row['id']."</a> </td>
     <td> ".strtolower($row['uid'])." </td>
    <td> ".strtolower($row['resseller'])." </td>
    <td> ".strtolower($row['acctype'])." </td>
    <td> ".$row['date']." </td>
	<td> <a href='viewr.php?id=".$row['id']."' >".$orderid."</a> </td>
	<td> ".$row['price']."$ </td>
	<td> ".$st." </td>
    <td> ".$row['lastreply']." </td>
    <td> ".$lastup." </td>
            </tr>
     ";
 
 }
                  echo '

              </tbody>
            </table>
        </div>
    </div>';
    ?>


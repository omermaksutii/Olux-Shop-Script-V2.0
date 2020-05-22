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
									<div class="well well-sm">

<h2><center><small><font color="#080C39"><span class="glyphicon glyphicon-info-sign"></span></small></font> How to report a bad item ?	</h2>
  <p align="center"><b>Account</b> &gt; <b>My Orders</b> then choose the item you want to report and click on <b>Report</b> button.</p>
                    </div>
           
<table width="100%" class="table table-striped table-bordered table-condensed" id="table">
<thead>
            <tr>
                                  <th scope="col"></th>
  <th scope="col">ID</th>
  <th scope="col">Date Created</th>
   <th scope="col">Order ID</th>
    <th scope="col">Item Type</th>
    <th scope="col">Seller</th>
  <th scope="col" >Report State</th>
  <th scope="col">Last Reply</th>
    <th scope="col" >Last Updated</th>
            </tr>
        </thead>
 <tbody id='tbody2'>
 <?php
 $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
 $q = mysqli_query($dbcon, "SELECT * FROM reports WHERE uid='$uid' ORDER BY id DESC")or die(mysqli_error());
 while($row = mysqli_fetch_assoc($q)){
	  
     $st = $row['status'];
    switch ($st){
      case "0" :
       $st = "Closed";
       break;
      case "1" :
       $st = "Pending";
       break;
      case "2":
       $st = "Pending";
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
	 	    $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
$idreport = $row['id'];
?>
<tr style="cursor: pointer;" onclick="pageDiv('report<?php echo $idreport; ?>','Report #<?php echo $idreport; ?> - Jerux SHOP','showReport<?php echo $idreport; ?>.html',0);">
<?php
echo "     <td>  </td>
 <td> ".$row['id']." </td>
    <td> ".$row['date']." </td>
    <td> ".$orderid." </td>
    <td> ".strtolower($row['acctype'])." </td>
    <td> ".$SellerNick."</td>
    <td> ".$st."</td>
    <td> ".$row['lastreply']." </td>
    <td> ".$lastup." </td>
            </tr>
     ";
 }

 ?>

</tbody>
 </table>
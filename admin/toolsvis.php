<?php
include "header.php";
?>
<script>

function deletrdps(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=rdps",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function deletshells(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=stufs",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function deletcpanels(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=cpanels",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function deletmailers(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=mailers",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function deletsmtps(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=smtps",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function deletleads(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=leads",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function deletbanks(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=banks",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function deletpremium(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=accounts",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function deletscam(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=scampages",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
function delettuto(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./delete.php?id="+id+"&table=tutorials",
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
</script>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Visualize Tools</b></div>

<center>
<a href="toolsvis.php?show=rdps"><input type="submit" class="btn btn-danger" value="Rdps"/></a> | 
<a href="toolsvis.php?show=shells"><input type="submit" class="btn btn-danger" value="Shells"/></a> | 
<a href="toolsvis.php?show=cpanels"><input type="submit" class="btn btn-danger" value="Cpanels"/></a> | 
<a href="toolsvis.php?show=mailers"><input type="submit" class="btn btn-danger" value="Mailers"/></a> | 
<a href="toolsvis.php?show=smtps"><input type="submit" class="btn btn-danger" value="Smtps"/></a> | 
<a href="toolsvis.php?show=leads"><input type="submit" class="btn btn-danger" value="Leads"/></a> | 
<a href="toolsvis.php?show=banks"><input type="submit" class="btn btn-danger" value="Banks"/></a> | 
<a href="toolsvis.php?show=accounts"><input type="submit" class="btn btn-danger" value="Accounts"/> </a>| 
<a href="toolsvis.php?show=scampages"><input type="submit" class="btn btn-danger" value="Scampages"/> </a>| 
<a href="toolsvis.php?show=tutorials"><input type="submit" class="btn btn-danger" value="Tutorials"/></a> 

</center>
<br>
<?php
ob_start();
@session_start();
error_reporting(0);
date_default_timezone_set('UTC');
include "../includes/config.php";


$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?> 
<?php
if($_GET['show']=="rdps"){
?>
 <table width="100%" class="table table-striped table-bordered table-condensed sticky-header" >
				<thead>
  <tr>
  <th>ID</th>
  <th>Country</th>
  <th>City</th>
  <th>Hosting</th>
  <th>Ram</th>
  <th>Seller</th>
  <th>Item information</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
		 <tbody id='tbody2'>
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM rdps WHERE acctype='rdp' and sold='0' ORDER BY id DESC")or die(mysqli_error($dbcon));

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='rdps-tabel'>
    <th> ".htmlspecialchars($row['id'])." </th>
    <th> ".htmlspecialchars($row['country'])." </th>
    <th> ".htmlspecialchars($row['city'])." </th>
    <th> ".htmlspecialchars($row['hosting'])." </th>
    <th> ".htmlspecialchars($row['ram'])." </th>
	<th> ".htmlspecialchars($row['resseller'])." </th>
    <th> ".htmlspecialchars($row['url'])." </th>
    <th> ".htmlspecialchars($row['price'])."</th>
    <th> ";
if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletrdps('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }else {
	echo "<font color=green>[Sold]</font>"; }
    echo "</th>
    </tr>";
 }
 
} else if($_GET['show']=="shells"){
?>

 <?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>
 <table width="100%" class="table table-striped table-bordered table-condensed sticky-header" >

        <thead>
  <tr>
          <th></th>
    <th>ID</th>
  <th>Seller</th>
  <th>Country</th>
  <th>Url</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
	<tbody>

 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM stufs WHERE acctype='shell' and sold='0' ORDER BY id DESC")or die(mysql_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr>
    <td></td>
    <td>".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['resseller']))." </td>
    <td>".htmlspecialchars($row['country'])."</td>
    <td>".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td>";
if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletshells('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }
if ($row['sold'] == "1") {
 echo '<font color=green>[Sold]</font>';
 }
if ($row['sold'] == "deleted") {
 echo '<font color=gray>Deleted</font>';
 }
    echo "</td>
    </tr>";


 }

 
 ?>

 </tbody>
 </table>
 <?php
 
} else if($_GET['show']=="cpanels"){

 ?>
  <table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header">
                <thead>
  <tr>
  <th></th>
  <th>ID</th>
  <th>Seller</th>
  <th>Country</th>
  <th>Information</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM cpanels WHERE acctype='cpanel' AND sold='0' ORDER BY id DESC")or die(mysql_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='stufs-tabel'>
    <td> </td>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['resseller']))." </td>
    <td> ".htmlspecialchars($row['country'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
if ($row[sold] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletcpanels('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }elseif ($row[sold] == "deleted") {
	echo "<font color=gray>Deleted</font>"; } else {
	    echo "<font color=green>[Sold]</font>";
	}
    echo "</td>
    </tr>";


 }

 ?>

 </tbody>
 </table> 
<?php
 
} else if($_GET['show']=="mailers"){

 ?>
 <table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header">
        <thead>
  <tr>
  <th></th>
  <th>ID</th>
  <th>Seller</th>
  <th>Country</th>
  <th>Url</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM mailers WHERE acctype='mailer' AND sold='0' ORDER BY id DESC")or die(mysqli_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr>
        <td> </td>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['resseller']))." </td>
    <td> ".htmlspecialchars($row['country'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletmailers('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }elseif ($row['sold'] == "deleted") {
	echo "<font color=gray>Deleted</font>"; } else {
echo "<font color=green>[Sold]</font>";	    
	}
    echo "</td>
    </tr>";


 }

 ?>

 </tbody>
 </table>

 <?php
 
} else if($_GET['show']=="smtps"){

 ?>
 <table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header">
				<thead>
  <tr>
  <th>ID</th>
  <th>Seller</th>
  <th>Country</th>
  <th>Item information</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
		 <tbody id='tbody2'>
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM smtps WHERE acctype='smtp' AND sold='0' ORDER BY id DESC")or die(mysqli_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='smtps-tabel'>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['resseller']))." </td>
    <td> ".htmlspecialchars($row['country'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletsmtps('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }elseif ($row['sold'] == "deleted") {
	echo "<font color=gray>Deleted</font>"; } else {
echo "<font color=green>[Sold]</font>";	    
	}
    echo "</td>
    </tr>";
 } 
 

 ?>

 </tbody>
 </table>

 <?php
 
} else if($_GET['show']=="leads"){

 ?>

<table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header dataTable no-footer" role="grid" aria-describedby="dataTable_info" style="width: 100%;">        <thead>
  <tr>
  <th>ID</th>
  <th>seller</th>
  <th>Country</th>
  <th>Link</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
	
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM leads WHERE acctype='leads' AND sold='0' ORDER BY id DESC")or die(mysqli_error($dbcon));

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='leads-tabel'>
    <td> ".strtoupper(htmlspecialchars($row['id']))." </td>
    <td> ".strtoupper(htmlspecialchars($row['resseller']))." </td>
    <td> ".htmlspecialchars($row['country'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletleads('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }elseif ($row['sold'] == "deleted") {
	echo "<font color=gray>Deleted</font>"; } else {
echo "<font color=green>[Sold]</font>";	    
	}
    echo "</td>
    </tr>";
 }

 ?>


 </tbody>
 </table> 
<?php
}
 else if($_GET['show']=="banks"){

 ?>
<table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header dataTable no-footer" role="grid" aria-describedby="dataTable_info" style="width: 100%;">        <thead>
  <thead>
  <tr>
  <th>ID</th>
  <th>Seller</th>
  <th>Country</th>
  <th>Bank Name</th>
  <th>Balance</th>
  <th>Information</th>
  <th>Open</th>
  <th>Date added</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
		 <tbody id='tbody2'>
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM banks WHERE acctype='banks' and sold='0' ORDER BY id DESC")or die(mysqli_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='banks-tabel'>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['resseller']))." </td>
    <td> ".htmlspecialchars($row['country'])." </td>
    <td> ".htmlspecialchars($row['bankname'])." </td>
	<td> ".htmlspecialchars($row['balance'])." </td>
    <td> ".htmlspecialchars($row['infos'])." </td>
	<td>  "; ?>
	<a data-toggle="modal" class="btn btn-primary btn-xs" data-target="#myModald<?php echo  $row['id']; ?>" >
<font color=white>Open #<?php echo htmlspecialchars($row['id']); ?> </a></center> 
<?php
  echo '
 
<div class="modal fade" id="myModald' . $row['id'] . '" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                           <font color="black"> Banks #' . $row['id'] . ' </font>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
					<font color="black">			'.htmlspecialchars($row['url']).' </font>
					</div>								
					<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>';
echo "
</td>
    <td> ".htmlspecialchars($row['date'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletbanks('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }elseif ($row['sold'] == "deleted") {
	echo "<font color=gray>Deleted</font>"; } else {
echo "<font color=green>[Sold]</font>";	    
	}
    echo "</td>
    </tr>";
 }

 

 ?>

 </tbody>
 </table> 
<?php
}

 else if($_GET['show']=="accounts"){

 ?>
<table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header dataTable no-footer" role="grid" aria-describedby="dataTable_info" style="width: 100%;">        <thead>
  <thead>
  <tr>
  <th>ID</th>
  <th>Seller</th>
  <th>Country</th>
  <th>Site Name</th>
  <th>Information</th>
  <th>Open</th>
  <th>Date added</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
		 <tbody id='tbody2'>
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM accounts WHERE acctype='account' AND sold='0' ORDER BY id DESC")or die(mysqli_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='accounts-tabel'>
    <th> ".htmlspecialchars($row['id'])." </th>
    <th> ".strtoupper(htmlspecialchars($row['resseller']))." </th>
    <th> ".htmlspecialchars($row['country'])." </th>
    <th> ".htmlspecialchars($row['sitename'])." </th>
    <th> ".htmlspecialchars($row['infos'])." </th>
	<th>  "; ?>
	<a data-toggle="modal" class="btn btn-primary btn-xs" data-target="#myModald<?php echo  $row['id']; ?>" >
<font color=white>Open #<?php echo htmlspecialchars($row['id']); ?> </a></center> 
<?php
  echo '
 
<div class="modal fade" id="myModald' . $row['id'] . '" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                           <font color="black"> Premium/Shop/Dating #' . $row['id'] . ' </font>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
					<font color="black">			'.htmlspecialchars($row['url']).' </font>
					</div>								
					<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>';
echo "
</th>
    <th> ".htmlspecialchars($row['date'])." </th>
    <th> ".htmlspecialchars($row['price'])."</th>
    <th> ";
if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletpremium('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }elseif ($row['sold'] == "deleted") {
	echo "<font color=gray>Deleted</font>"; } else {
echo "<font color=green>[Sold]</font>";	    
	}
    echo "</td>
    </tr>";
 }

}
 
 else if($_GET['show']=="scampages"){

 ?>

<table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header dataTable no-footer" role="grid" aria-describedby="dataTable_info" style="width: 100%;">        <thead>
  <tr>
  <th>ID</th>
  <th>Seller</th>
  <th>Scampage name</th>
  <th>Link</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
		
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM scampages WHERE acctype='scampage' AND sold='0' ORDER BY id DESC")or die(mysql_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='scampages-tabel'>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['resseller']))." </td>
    <td> ".htmlspecialchars($row['scamname'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:deletscam('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
    echo "</td>
    </tr>";

 }
 

 ?>

 </tbody>
 </table> 
<?php
}
 
 else if($_GET['show']=="tutorials"){

 ?>

<table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header dataTable no-footer" role="grid" aria-describedby="dataTable_info" style="width: 100%;">        <thead>
        <thead>
  <tr>
  <th>ID</th>
  <th>Seller</th>
  <th>Tutorial name</th>
  <th>Link</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
		
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM tutorials WHERE acctype='tutorial' AND sold='0' ORDER BY id DESC")or die(mysql_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='tutorials-tabel'>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['resseller']))." </td>
    <td> ".htmlspecialchars($row['tutoname'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:delettuto('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
    echo "</td>
    </tr>";

 }
 

 ?>

 </tbody>
 </table> 
<?php
}

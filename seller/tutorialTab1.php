 <?php
error_reporting(0);
 session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?> 
<table width="100%" id="dataTable" class="table table-striped table-bordered table-condensed sticky-header dataTable no-footer" role="grid" aria-describedby="dataTable_info" style="width: 100%;">        <thead>
        <thead>
  <tr>
  <th>ID</th>
  <th>Type</th>
  <th>Tutorial name</th>
  <th>Link</th>
  <th>Price</th>
  <th>Action</th>
  </tr>
        </thead>
		
 <?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qu = mysqli_query($dbcon, "SELECT * FROM tutorials WHERE acctype='tutorial' AND resseller='$uid' ORDER BY id DESC")or die(mysql_error());

 while($row = mysqli_fetch_assoc($qu)){
	 
    echo "<tr class='tutorials-tabel'>
    <td> ".htmlspecialchars($row['id'])." </td>
    <td> ".strtoupper(htmlspecialchars($row['acctype']))." </td>
    <td> ".htmlspecialchars($row['tutoname'])." </td>
    <td> ".htmlspecialchars($row['url'])." </td>
    <td> ".htmlspecialchars($row['price'])."</td>
    <td> ";
if ($row['sold'] == "0") {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:delet('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
 }elseif ($row['sold'] == "deleted") {
	echo "<font color=gray>Deleted</font>"; } else {
 echo '<div id="shop'.$row["id"].'" type="delete"><a onclick="javascript:delet('.$row["id"].');" class="btn btn-danger btn-xs">remove</a></div>';
	}
    echo "</td>
    </tr>";

 }
 

 ?>

 </tbody>
 </table>
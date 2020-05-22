<?php
include "./header.php";

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}


?>
<script>
$('#dataTable').dataTable( {
  "lengthChange": false
});
function delet(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./ajax/dsmtp.php?id="+id,
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}



</script>
	<h2>SMTPs</h2>
<?php

date_default_timezone_set('UTC');

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?> 

<ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','smtpTab1.php')">All</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','smtpTab2.php')">Add</a></li>
	<!--	<li class=""><a href="#mass" data-toggle="tab" aria-expanded="false" onclick="TabDiv('mass','smtpTab3.php')">Mass Add</a></li> -->
	</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
<div class="well well-sm">
        <h4>Rules</h4>
        <ul> 
          <li>Just insert Webmails normally and our checker will detect it </li>
          <li>You can choose the price you want but the usual price between <b>2$</b>-<b>6$</b></li>
          <li>If you have mistaken or need to edit a tool just remove it and add it again  </li>          
          <li><b>Deleted</b> mean that the tools is not working !</li>
        </ul> 
        <h4>Static</h4>
        <ul>
          <li>Number of SMTPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM smtps where resseller='$uid'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Unsold SMTPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM smtps where resseller='$uid' and sold='0'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Sold SMTPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM smtps where resseller='$uid' and sold='1'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Deleted SMTPs : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM smtps where resseller='$uid' and sold='deleted'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
        </ul>
      </div>
      </div>
	  
	<div class="tab-pane fade" id="all"></div>
    <div class="tab-pane fade" id="add"></div>

</div>
</div></div>
            </div>
            </div>
        </div>
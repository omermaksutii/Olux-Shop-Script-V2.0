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

	<h2>Leads / Email-lists</h2>
  <script>


function delet(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./ajax/dleads.php?id="+id,
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
</script>

<ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','leadTab1.php')">All</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','leadTab2.php')">Add</a></li>
	<!--	<li class=""><a href="#mass" data-toggle="tab" aria-expanded="false" onclick="TabDiv('mass','leadTab3.php')">Mass Add</a></li> -->
	</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
<div class="well well-sm">
        <h4>Rules</h4>
        <ul> 

          <li><span class="label label-danger">IMPORTANT</span> We Don't allow EMAIL:PASS (or databases) this section is only for maillist(leads)!!</li>
          <li>You can use Mega.nz or anonfiles.com</li>
          <li>You can choose the price you want but the usual is 2$-5$ per 10k</li>
          <li>If you have mistaken or need to edit a tool just remove it and add it again  </li>          
          <li><b>Deleted</b> mean that the tools is not working !</li>
        </ul> 
        <h4>Static</h4>
        <ul>
          <li>Number of Leads : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM leads where resseller='$uid'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Unsold Leads : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM leads where resseller='$uid' and sold='0'");$r11=mysqli_num_rows($s12);
 echo $r11;?></b></li>
          <li>Sold Leads : <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM leads where resseller='$uid' and sold='1'");$r11=mysqli_num_rows($s12);
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
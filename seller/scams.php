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
	<h2>Scampages</h2>
  <script>


function delet(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./ajax/dscams.php?id="+id,
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
</script>
<ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','scampageTab1.php')">All</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','scampageTab2.php')">Add</a></li>
	<!--	<li class=""><a href="#mass" data-toggle="tab" aria-expanded="false" onclick="TabDiv('mass','scampageTab3.php')">Mass Add</a></li> -->
	</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
<div class="well well-sm">
        <h4>Rules</h4>
        <ul> 

          <li><span class="label label-danger">IMPORTANT</span> Make sure to include a screenshot for each page of the scam page , and make sure it's not backdoored (Backdoor = Ban)</li>
          <li>You can use Mega.nz or anonfiles.com</li>
          <li>You can choose the price you want</li>
          <li>If you have mistaken or need to edit a tool just remove it and add it again  </li>          
          <li><b>Deleted</b> mean that the tools is not working !</li>
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

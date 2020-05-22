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

	<h2>Tutorials / Methods</h2>
  <script>


function delet(id)
{   var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('processing ..').show();
	$.ajax({
	METHOD: 		'GET',
     url:"./ajax/dtuto.php?id="+id,
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
	}});
}
</script>


<ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','tutorialTab1.php')">All</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','tutorialTab2.php')">Add</a></li>
	<!--	<li class=""><a href="#mass" data-toggle="tab" aria-expanded="false" onclick="TabDiv('mass','tutorialTab3.php')">Mass Add</a></li> -->
	</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
<div class="well well-sm">
        <h4>Rules</h4>
        <ul> 

<li><b>Tutorials #1 </b>Please don't put fake tutorial and make sure it's worth the price</li>
<li><b>Tutorials #2 </b>Make sure the tutorial include everything the customer need to finish the job (including tools)</li>
<li><b>Tutorials #3 </b>We allow teamviewer leasons but don't ask customer for more money (include all price with the tool)</li>
<li>Make sure that the link is 100% working and will be working for the next months.</li>
<li>If the tool link is not working please delete it and readd it with the correct link</li>
<li>If you have mistaken or need to edit a tool just remove it and add it again</li>
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

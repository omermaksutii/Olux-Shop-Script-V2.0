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

	<h2>Reports</h2>
 
	<ul class="nav nav-tabs">
		<li class="active"><a href="#static" data-toggle="tab" aria-expanded="true">Static</a></li>
		<li class=""><a href="#all" data-toggle="tab" aria-expanded="false" onclick="TabDiv('all','reportsTab1.html')">Pending</a></li>
		<li class=""><a href="#add" data-toggle="tab" aria-expanded="false" onclick="TabDiv('add','reportsTab2.html')">All Reports</a></li>
	</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="static"> 
      <div class="well well-sm">
        <h4>Rules</h4>
         <ul>
					<li>Main Rules</li>
						<ul>
							<li>Always be nice with the buyer , no matter what happen never use bad language.</li>
							<li>Try to understand and solve buyer issue.</li>
							<li>You can replace any order , unless buyer asks for a refund.</li>
							<li>For lessons or tutorials you can use anydesk or teamviewer.</li>
							<li>Be careful with wired links and wired files / Use VPN.</li>
							<li>If the report was fake/incorrect , please add a reply and explain why.</li>
							<li>Support/Admin is always here to help you , please contact us on tickets if you have any issue.</li>
						</ul>
					<li>Replacing Rules</li>
						<ul>
							<li><b>Always</b> include screenshot of the item</li>
							<li><b>Never</b> replace with already sold item / or replace multiple orders with the same item.</li>
							<li>if the replace is already added to your account make sure to <b>remove</b>  it.</li>
						</ul>
					<li>There are <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM reports where resseller='$uid' and status='1'");$r11=mysqli_num_rows($s12);
 echo $r11;?> </b> Pending Report</li>

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
</body></html>
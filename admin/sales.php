<?php

  include "header.php";
  $q = mysqli_query($dbcon, "SELECT * FROM reports ORDER BY id desc ")or die("error");
  $t = mysqli_num_rows($q);
  global $t,$q;

?>
  

<?php

$sql = "SELECT * FROM purchases ORDER BY id DESC Limit 300";
		
$query = mysqli_query($dbcon, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($dbcon));
}	
?>
            <!-- /.box-header -->
            <div class="box-body">
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Last 300 Order</b></div>

<ul class="nav nav-tabs">
    <li class="active"><a href="#stats" data-toggle="tab" aria-expanded="true"><span class="glyphicon glyphicon-stats"></span> Stats</a></li>
    <li class=""><a href="#myorders" data-toggle="tab" aria-expanded="false"><span class="glyphicon glyphicon-time"></span> All Orders</a></li>
</ul>
<?php
$allsales = 0;
 	    $qer = mysqli_query($dbcon, "SELECT * FROM purchases")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer)) {
				    $allsales += $rpw['price'];
		}
?>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="stats"> 
	<div class="well well-sm">
			<h4>Sales Static</h4>
			<ul>
				<li>All Sales :  <b><?php $s12 = mysqli_query($dbcon, "SELECT * FROM purchases");$r11=mysqli_num_rows($s12);
 echo $r11;?></b> ($<?php echo $allsales; ?>)</li>				

			</ul>
		</div>
	</div>
    <div class="tab-pane fade in" id="myorders"> 
	<br>
<table width="100%" class="table table-striped table-bordered table-condensed sort" id="table">
                <thead>
                <tr>
				<th></th>
                  <th>ID</th>
                  <th>Buyer</th>
                  <th>Seller</th>
                  <th>Type</th>
                  <th>Open</th>
                  <th>Price</th>
                  <th>Report ID</th>
                  <th>Report State</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
	<?php
		while ($row = mysqli_fetch_array($query))
		{
			       $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
				$orderid = $row['id'];
				if (empty($row['reportid'])) {
					$reportnumber = "n/a";
				} else {
					$repid = $row['reportid'];
					$reportnumber = "<a href='viewr.php?id=$repid'>".$row['reportid']."</a>";
				}
			  $qurez = mysqli_query($dbcon, "SELECT * FROM reports WHERE orderid='$orderid'")or die(mysql_error());
			echo '<tr>
			<td></td>
					<td>'.$row['id'].'</td>
					<td>'.$row['buyer'].'</td>
					<td>'.$SellerNick.'</td>
					<td>'.strtolower($row['type']).'</td>
					<td><button onclick="openitem('.$row['id'].')" class="btn btn-primary btn-xs"> OPEN</button></td>
					<td>'.$row['price'].'$</td>
					<td>'.$reportnumber.'</td>
					<td>';
					?> 
					<?php 
										while ($rowez = mysqli_fetch_array($qurez)) {
											
				echo $rowez['state'];
										}
					?>
					<?php echo '</td>
					<td>'.$row['date'].'</td>
				</tr>';
		}?>
</tbody>
</table>
</div>
</div>

<script type="text/javascript">
function openitem(order){
  $("#myModalHeader").text('Order #'+order);
  $('#myModal').modal('show');
  $.ajax({
    type:       'GET',
    url:        'openorder.php?id='+order,
    success:    function(data)
    {
        $("#modelbody").html(data).show();
    }});

}
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalHeader"></h4>
      </div>
      <div class="modal-body" id="modelbody">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
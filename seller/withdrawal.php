<?php
include "./header.php";

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}
$s = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$uid'")or die(mysql_error());
$f = mysqli_fetch_assoc($s);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

?>
  <?php
			$sql = "SELECT * FROM resseller where username='$uid'";
		
$query = mysqli_query($dbcon, $sql);

if (!$query) {
	die ('SQL Error');
}

	while ($roaw = mysqli_fetch_array($query))
		{
		$SellerNick = $roaw['id'];
		}
		?>
<script>
    $(document).ready(function() {
$("#updatebtc").click(function (){
    var btc = $("#addressbtcnew").val();
     $.ajax({
     method:"GET",
     url:"./ajax/updatebtc.php?id="+btc,
     dataType:"text",
     success:function(data){
         $("#showresults").html(data).show();
         setTimeout("location.reload(true);", 400);
     },
   });
});
});
</script>
<ul class="nav nav-tabs">
        <h2>Withdraw <small> for seller<?echo $SellerNick;?></small></h2>
    <li class="active"><a href="#allmysales" data-toggle="tab" aria-expanded="true">Sales</a></li>
    <li class=""><a href="#edit" data-toggle="tab" aria-expanded="false"> Edit address</a></li>
    <li class=""><a href="#phistory" data-toggle="tab" aria-expanded="false"> Payment History</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade active in" id="allmysales"> 
   
   			<div class="row">

<form role="form" method="post">
       
			  <?php $query = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$uid'");
$ro = mysqli_fetch_assoc($query);
$ti = $ro["soldb"] + $ro["unsoldb"];
$it = $ro["isold"] + $ro["iunsold"];
$earning = $ro["soldb"] * 70 /100;
$sales = $ro["soldb"];

 ?>
 <?php
$pending = 0;
$t=0;
$real_data = date("Y-m-d H:i:s");
 	    $qer = mysqli_query($dbcon, "SELECT * FROM purchases WHERE resseller='$uid' and reported=''")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer)) {
    $date_purchased = $rpw['date'];
    $endTime        = strtotime("+600 minutes", strtotime($date_purchased));
    $data_plus      = date('Y-m-d H:i:s', $endTime);
	
	    if ($real_data > $data_plus) {

		} else { 
				    $pending += $rpw['price'];
$t++;
		}
		   }
		   $result = mysqli_query($dbcon,"SELECT * FROM reports where resseller='$uid' and status='1'");
$reported_orders = 0;
while($rzaw = mysqli_fetch_array($result))
{
    $reported_orders += $rzaw['price'];
$t++;
	}
$pending_orders = $reported_orders + $pending;
$total = $ro['soldb']-$pending_orders;
?>   

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Seller<?php echo $SellerNick; ?> Invoice</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong></strong></td>
                                    <td class="text-center"><strong>N</strong></td>
                                    <td class="text-center"><strong></strong></td>
                                    <td class="text-center"><strong>Price</strong></td>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Sales</strong></td>
                                    <td class="text-center">$<?php echo $ro["soldb"]; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Pending Sales<abbr title="Please understand that each tool you sell will be pending for 10 hours before we pay you in order to give the buyer a chance to report it if it was bad."> [?]</abbr></b></td>
                                    <td class="text-center"><?php echo $t; ?></td>
                                    <td class="text-center"></td>
                                    <td class="text-center">$<?php echo $pending_orders; ?>-</td>
                                </tr>
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Total</strong></td>
                                    <td class="highrow text-center"><b>$<?php echo $total; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Share</strong></td>
                                    <td class="emptyrow text-center"><b>65%</b></td>
                                </tr>
                                <tr>
								
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Receive</strong></td>
                                    <td class="emptyrow text-center"><b>$<?php $receive = $total * 65 /100; echo $receive; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-center">
<?php
			$sql = "SELECT * FROM resseller where username='$uid'";
		
$query = mysqli_query($dbcon, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($dbcon));
}

	while ($row = mysqli_fetch_array($query))
		{
		$requested = $row['withdrawal'];
		$soldb = $row['soldb'];
		$SellerNick = $row['id'];
		}
		if ($receive < 10) {
		} else { 
		if ($requested == 'requested') {
			echo 'Request submitted!';
		} else {
			echo'
<input type="hidden" name="start" value="work" />
		<input type="submit" name="withdraw" value="Withdraw" class="btn btn-primary btn-xs"></input>
		'; } }
		
	if(isset($_POST['start']) and $_POST['start'] == "work"){

 $date = date('Y-m-d H:i:s');
// Attempt insert query execution
$sql = "UPDATE resseller SET withdrawal='requested' where username='$uid'";
if(mysqli_query($dbcon, $sql)){
}
$sqlii = "INSERT resseller SET withdrawal='requested' where username='$uid'";

 echo "<meta http-equiv='refresh' content='0'>";
	}
?>                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
					<?php
					
	while ($row = mysqli_fetch_array($query))
		{
		$requested = $row['withdrawal'];
		$soldb = $row['soldb'];
		}
		if ($receive < 10) {
			echo "<div class='well well-sm'>Your receive should be more than 10$ in order to request <b>Withdraw</b>!</div>";
		} else { 
		if ($requested == 'requested') {
			echo "<div class='well well-sm'>Your <b>Withdraw</b> request will be sent by admin soon!</div>";
		} else {
			echo "<div class='well well-sm'>Please click on <b>'Withdraw'</b> to request payment!</div>" ; } }
					?>
                </div>
				
            </div>
			
        </div>
		        </div>

</div>
    <div class="tab-pane fade in" id="edit"> 
	<h4>Edit Information </h4>
<form>
<tr>
<div class="form-group col-lg-5"><label for="bitcoin">Bitcoin Address</label>
<input type="text" class="form-control" placeholder="1CoQrt8TjFJs974KW3qEv37hMTo5FBqk2d" id="addressbtcnew" value="<?php echo $f['btc']; ?>" name="adress"/>
</tr></div>
<div class="form-group col-lg-10">
<td><button id="updatebtc" type="button" name="send" class="btn btn-primary" >Change <span class="glyphicon glyphicon-indent-left"></span></button></td>
</div>
</form>
 </div> 
   <div class="tab-pane fade in" id="phistory"> 
 	<?php

$sql = "SELECT * FROM rpayment WHERE username='$uid' order by id Desc";
		
$query = mysqli_query($dbcon, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($dbcon));
}	
?>
<h3>Payment History </h3>
<table width="100%" class="table table-striped table-bordered table-condensed sticky-header" id="table">
				<thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Date</th>
                  <th scope="col">Sold</th>
                  <th scope="col">Percentage</th>
                  <th scope="col">BTC Rate</th>
				  <th scope="col">BTC</th>
                  <th scope="col">USD</th>
				  <th scope="col">Fee</th>
                  <th scope="col">Bitcoin Address</th>
                  <th scope="col">Hash</th>
                </tr>
                </thead>
                <tbody>
	<?php
		while ($row = mysqli_fetch_array($query))
		{
			$sold = $row['amount']/65*100;
			$rating= $row['rate'];
			if (empty($rating)) { 
		$rater = "N/A";
		} else { $rater = $rating; }
			if (empty($row['fee'])) { 
		$feee = "N/A";
		} else { $feee = $rater * $row['fee']; }
			echo '<tr style>
					<td></td>
					<td>'.$row['date'].'</td>
					<td>'.substr($sold , 0, 4).'$</td>
					<td>65%</td>
					<td>'.$rater.'</td>
					<td>'.$row['abtc'].' <span class="glyphicon glyphicon-bitcoin"></span></i></td>
					<td>'.$row['amount'].'$</td>
					<td>'.substr($feee, 0, 4).'</td>
					<td><a target="_blank" href="https://www.blockchain.com/btc/address/'.$row['adbtc'].'">'.$row['adbtc'].'</a></td>
					<td><a target="_blank" href="'.$row['url'].'">Info</a></td>
				</tr>';
		}?>
	</tbody>	
</table>
</ul></li>
 </div> 
  </div>
  
<?php

  include "header.php";
  $q = mysqli_query($dbcon, "SELECT * FROM resseller where withdrawal='requested' ")or die("error");
  $t = mysqli_num_rows($q);
  global $t,$q;
$totaljerux = 0;
$totalseller = 0;
$totals = 0;

?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Withdraw Approval</b></div>

    <?php

    echo '
    <div class="">
    <center><br>
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">Withdrawal requests <span class="label label-warning">Total : '.$t.'</span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Seller</th>
                  <th>Sales USD</th>
                  <th>Pending USD</th>
                  <th>Total USD</th>
				 <th>Receive USD</th>
				 <th>Receive BTC</th>
                  <th>Address BTC</th>
				 <th>Jerux % USD</th>
                  <th>Pay Seller</th>
                </tr>
              </thead>
              <tbody>';
			  
              while($row = mysqli_fetch_assoc($q)){
				  $uid = $row['username'];
               $query = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$uid'");
$ro = mysqli_fetch_assoc($query);
$ti = $ro["soldb"] + $ro["unsoldb"];
$it = $ro["isold"] + $ro["iunsold"];
$earning = $ro["soldb"] * 65 /100;
$sales = $ro["soldb"];

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
$sold = $row['soldb'];
			  $receive = $total * 65 / 100;
			  $receivejer = $total * 35 / 100;
			  				    $totaljerux += $receivejer;
								$totalseller += $receive;
			      $url = "https://blockchain.info/stats?format=json";
$stats = json_decode(file_get_contents($url), true);
$btcValue = $stats['market_price_usd'];
$usdCost = $receive;

$convertedCost = $usdCost / $btcValue;
              echo '<tr>
                  <td>'.$row['username'].'</td>
				   <td>'.$row['soldb'].'</td>
				   <td>'.$pending_orders.'</td>
				   <td>'.$total.'</td>
                  <td>'.$receive.'</td>
                  <td>'.substr($convertedCost, 0, 9).'</td>
                  <td>'.$row['btc'].'</td>
                  <td>'.$receivejer.'</td>
              <form>
    <td><a target="_blank" href="PaySeller.html?seller='.$row['username'].'&receiveusd='.$receive.'&receivebtc='.substr($convertedCost, 0, 9).'&btcaddress='.$row['btc'].'&pending='.$pending_orders.'"><input class="btn btn-primary" type="button" value="Pay #'.$row['username'].'"></td></a>
</form>

                  </tr>';
         
                  }
				  echo '   <td>TOTAL</td> <td></td><td></td><td></td><td>'.$totalseller.'</td><td></td><td></td><td>'.$totaljerux.'</td><td></td>';
                  echo '

              </tbody>
            </table>
        </div>
    </div>';
    ?>


<?php

include "header.php";
require_once '../includes/block_io.php';

$apiKey = "1c84-7e22-51e0-0a64";
$version = 2; // API version
$pin = "121212aa";
$block_io = new BlockIo($apiKey, $pin, $version);
?>
<?php
  $date = date("Y-m-d");
  $date2 = date("Y-m-");
  $qt = mysqli_query($dbcon, "SELECT SUM(balance) as total FROM users");
  $qtf = mysqli_fetch_assoc($qt);
  $qto = mysqli_query($dbcon, "SELECT SUM(amount) as total FROM orders WHERE date LIKE '$date%'");
  $qtfo = mysqli_fetch_assoc($qto);
  $qtc = mysqli_query($dbcon, "SELECT SUM(amount) as total FROM orders WHERE date LIKE '$date2%'");
  $qtfc = mysqli_fetch_assoc($qtc);
  $qtr = mysqli_query($dbcon, "SELECT SUM(amount) as total FROM orders");
  $qtfr = mysqli_fetch_assoc($qtr);
?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Financial Status</b></div>

<div class="form-group col-lg-3">
		<div class="teddy-text">
<center>	<b><font size="4" color="17C0FB">
<span class="glyphicon glyphicon-usd" style="font-size: 55px;"></span><br><h3><?php if(empty($qtfo['total'])) { echo "0.00"; } else { echo $qtfo['total']; } ?>$</h3>
</font> </CENTER></b>
					</div>
			    <div class="teddy-follow">
<center>	<b><font size="4" color="white">Total Deposit (Today)</font> </CENTER></b>
			    </div>

</div>
<div class="form-group col-lg-3">
		<div class="teddy-text">
<center>	<b><font size="4" color="17C0FB">
<span class="glyphicon glyphicon-usd" style="font-size: 55px;"></span><br><h3><?php echo $qtfc['total']; ?>$</h3>
</font> </CENTER></b>
					</div>
			    <div class="teddy-follow">
<center>	<b><font size="4" color="white">Total Deposit (Month)</font> </CENTER></b>
			    </div>

</div>
<div class="form-group col-lg-3">
		<div class="teddy-text">
<center>	<b><font size="4" color="D41010">
<span class="glyphicon glyphicon-usd" style="font-size: 55px;"></span><br><h3><?php echo $qtfr['total'];?>$</h3>
</font> </CENTER></b>
					</div>
			    <div class="teddy-followred">
<center>	<b><font size="4" color="white">Total Deposit (Beginning)</font> </CENTER></b>
			    </div>

</div>
<div class="form-group col-lg-3">
		<div class="teddy-text">
<center>	<b><font size="4" color="D41010">
<span class="glyphicon glyphicon-bitcoin" style="font-size: 55px;"></span><br><h3><?php echo $block_io->get_balance()->data->available_balance; ?> BTC</h3>
</font> </CENTER></b>
					</div>
			    <div class="teddy-followred">
<center>	<b><font size="4" color="white">Current Wallet Balance</font> </CENTER></b>
			    </div>

</div>
<br>
<div class="form-group col-lg-8">
<h4>Last Deposits </h4>
<?php
$q = mysqli_query($dbcon, "SELECT * FROM orders ORDER BY order_id desc LIMIT 5");

    echo '
     <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User</th>
                  <th>Amount</th>
                  <th>Address</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>';
              while($row = mysqli_fetch_assoc($q)){
                $st = $row['status'];

    switch ($st){
      case "0" :
       $st = "closed";
       break;
      case "1" :
       $st = "pending";
       break;
      case "2":
       $st = "pending";
       break;
    }
		if (empty($row['lastup'])) {
		$lastup = "n/a"; 
		} else { 
		$lastup = $row['lastup']; 	
		}
              echo '<tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['username'].'</td>
                  <td>'.$row['amount'].'</td>
				  <td>'.$row['lrpaidby'].'</td>
				  <td>'.$row['date'].'</td>
                  </tr>';
                  }
                  echo '

              </tbody>
            </table>
      ';
    ?>
</div>
<div class="form-group col-lg-4">
<h4>Last Users </h4>
<?php
  $q = mysqli_query($dbcon, "SELECT * FROM users order by id desc Limit 5")or die("error");

    echo '
     <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>';
              while($row = mysqli_fetch_assoc($q)){
              echo '<tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['username'].'</td>
                  <td>'.$row['datereg'].'</td>
                  </tr>';
                  }
                  echo '

              </tbody>
            </table>
      ';
    ?>
</div>

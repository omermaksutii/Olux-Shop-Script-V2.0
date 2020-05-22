
<?php
include ('../includes/config.php');
$q = mysqli_query($dbcon, "SELECT * FROM resseller order by CAST(lastweek AS UNSIGNED ) DESC");
while ($ro = mysqli_fetch_assoc($q)) {
	    $seller = $ro['username'];
	    $qt  = mysqli_query($dbcon, "SELECT SUM(price) as total FROM purchases where resseller='$seller' and YEARWEEK(date) = YEARWEEK(NOW())");
    $qtf = mysqli_fetch_assoc($qt);
	if (empty($qtf['total'])) { 
	$sold = "0";
	} else {
	$sold = $qtf['total'];
	}
    $update  = mysqli_query($dbcon, "UPDATE resseller SET lastweek='$sold' WHERE username='$seller'")or die(mysqli_error($dbcon));

}
$day = date('w');
$week_start = date('m/d', strtotime('-'.$day.' days'));
$week_end = date('m/d', strtotime('+'.(6-$day).' days'));
echo '<h4>Top Sellers <small>From Sunday ('.$week_start.') to Monday ('.$week_end.')</small></h4>';
$q = mysqli_query($dbcon, "SELECT * FROM resseller order by CAST(lastweek AS UNSIGNED ) DESC LIMIT 5");
$place = 0;
echo '
	<table class="table table-striped table-bordered table-condensed">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Seller</th>
      <th scope="col">Sales</th>
    </tr>
</thead>
<tbody>
';
while ($ro = mysqli_fetch_assoc($q)) {
	$place++;
    $seller = $ro['username'];
    $qt  = mysqli_query($dbcon, "SELECT SUM(price) as total FROM purchases where resseller='$seller' and YEARWEEK(date) = YEARWEEK(NOW())");
    $qtf = mysqli_fetch_assoc($qt);
	if (empty($qtf['total'])) { 
	$sold = "0";
	} else {
	$sold = $qtf['total'];
	}
	$selnick = 'seller'.$ro['id'];
	if ($selnick == $SellerNick) {
		$imintop = "true";
		echo '
		<tr>
  <td><b>'.$place.'</b></td>
  <td><b><span class="glyphicon glyphicon-user"></span> '.$SellerNick.'</b></td>
  <td><b>'.$sold.'$</b></td>
</tr>
		';
	} else {
				$imintop = "false";
	echo '
              <tr>
  <td>'.$place.'.</td>
  <td>seller'.$ro['id'].'</td>
  <td> '.$sold.'$</td>
</tr>
	'; }
	}
	$qezr = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$uid."'")or die(mysql_error());
	while($rpw = mysqli_fetch_assoc($qezr)){
		  $qt  = mysqli_query($dbcon, "SELECT SUM(price) as total FROM purchases where resseller='$uid' and YEARWEEK(date) = YEARWEEK(NOW())");
    $qtf = mysqli_fetch_assoc($qt);
	if (empty($qtf['total'])) { 
	$soldme = "0";
	} else {
	$soldme = $qtf['total'];
	}
	}
	if ($imintop == "false") {
echo '  
<tr>
  <td></td>
  <td><b><span class="glyphicon glyphicon-user"></span> '.$SellerNick.'</b></td>
  <td><b>'.$soldme.'$</b></td>
</tr>
</tr>    
</tbody>
	</table>'; } 
?>
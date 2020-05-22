<?php
include "./header.php";

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon,"SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}
?>


 <div>
  <!-- Nav tabs -->

<?php

ob_start();
@session_start();
date_default_timezone_set('UTC');
 include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon,"SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../../");
  exit ();
}

?>



      <div class="well well-sm">
Hello <span class="label label-primary"> <?php echo $uid;?></span><br>
If you have any <b> Question</b> , <b>Suggestion</b> or <b>Request Please</b> feel free to <a class="label label-default" href="../buyer/tickets.html"><span class="glyphicon glyphicon-pencil"></span> Open Ticket</a>
<br>

<h4>Your information <small><?echo $uid;?></small> </h4>
<?php
    $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$uid."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
?>
&nbsp;	&nbsp;	&bull;	Your selling nickname in this shop is <b><?php echo $SellerNick; ?></b> <br>
&nbsp;	&nbsp;	&bull;	You get paid any time you like using Withdraw section<br>
&nbsp;	&nbsp;	&bull;	You get <b>65%</b> of your sales<br>
&nbsp;	&nbsp;	&bull;	You can change your bitcoin address from withdrawal section<br>
<?php
    $qerz = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$uid."'")or die(mysql_error());
		   while($repw = mysqli_fetch_assoc($qerz))
			 $AddressBTC = $repw["btc"];
?>
&nbsp;	&nbsp;	&bull;	Your bitcoin address is <b><?php if (empty($AddressBTC)) {  echo "N/A"; }  else { echo htmlspecialchars($AddressBTC); }?></b><br><br>
</font>
</td>

</tr>
</table>
				 </div>
				 </div>

<?php
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
  <td><b>'.$place.'.</b></td>
  <td><b><span class="glyphicon glyphicon-user"></span> '.$SellerNick.'</b></td>
  <td><b>'.$sold.'$</b></td>
</tr>
		';
	} else {
	echo '
              <tr>
  <td>'.$place.'.</td>
  <td>seller'.$ro['id'].'</td>
  <td> '.$sold.'$</td>
</tr>
	'; }
	}

		  $qtaze  = mysqli_query($dbcon, "SELECT SUM(price) as total FROM purchases where resseller='$uid' and YEARWEEK(date) = YEARWEEK(NOW())");
    $qtfww = mysqli_fetch_assoc($qtaze);
	if ($imintop != "true") {
echo ' 
<tr>
  <td></td>
  <td><b><span class="glyphicon glyphicon-user"></span> '.$SellerNick.'</b></td>
  <td><b>'.$qtfww['total'].'$</b></td>
</tr>
'; 
	}
	echo '
	</tr>    
</tbody>
	</table>
	';
?>
    <div class="list-group" id="div2">
      	<h3><i class="glyphicon glyphicon-info-sign"></i> News</h3>
		<?php  $qq = @mysqli_query($dbcon,"SELECT * FROM newseller ORDER by id desc LIMIT 5") or die("error here"); ?>

                <?php
while($r = mysqli_fetch_assoc($qq)){				echo'<a class="list-group-item"><h5 class="list-group-item-heading"><b>'.stripcslashes($r['content']).'</b></h5><h6 class="list-group-item-text">'.$r['date'].'</h6></a>'; 
}
 ?>

				 </div>




</body></html>

        </article>
						
						</ul>            
		
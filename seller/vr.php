<?php
  include "./header.php";
  include 'cr.php';
  $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['resseller'] != "1"){
  header("location: ../");
  exit ();
}
?>
    <style>
    .ticket {
    white-space: pre-wrap;
}
</style>
<link rel="stylesheet" href="css/tickets.css">
<?php

if(isset($_GET['id'])){

  $tid = mysqli_real_escape_string($dbcon, $_GET['id']);
  $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

  $s = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$tid' AND resseller='$uid'")or die(mysqli_error());
  $r = mysqli_fetch_assoc($s);

  if(!empty($r)){
    $st = $r['status'];
    switch ($st){
      case "0" :
       $st = "<font color='green'>Closed</font>";
       break;
      case "1" :
       $st = "<font color='red'>Pending</font>";
       break;
      case "2":
       $st = "<font color='orange'>Replied</font>";
       break;
    }

echo'		
<div class="form-group col-lg-5 ">
<div class="row-fluid sortable">
				<div class="box span9">
					<div class="box-header">
						<h3><i class="icon-comment"></i><span class="break"></span>Report #'.$r['id'].'</h3>
					</div>
										<div class="box-content">';


echo $r['memo'];

?>
<br>
                                    <tbody>

<form  method="POST">
<?php
$tid = mysqli_real_escape_string($dbcon, $_GET['id']);
$s = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$tid'");
$r = mysqli_fetch_assoc($s);
if($r['status'] == "0"){
?>
<div class="well well-sm">
  <strong>Closed Report</strong> <p>This report is closed and you can't reply to it </p>
</div>
<?php
}else{
?>
<form method="post">
<div class="input-group">
    <textarea class="form-control custom-control" rows="3" name="rep" style="resize:none" required></textarea>     
    <span class="input-group-addon btn btn-primary" onclick="$(this).closest('form').submit();">Reply</span>
</div>
								<input type="hidden" name="add" value="rep" />

</form>
<br>
<?php
  if(preg_match("#Not Yet !#i",$r['refunded'])){
    echo '
   <center>
<a data-toggle="modal" data-target="#RefundModal" class="btn label-primary"><font color="white">Refund</font></a>
<!-- Modal -->
<div class="modal fade" id="RefundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<div class="modal-body"><button type="button" class="modal-close-button close" data-dismiss="modal" aria-hidden="true" style="margin-top: -10px;">×</button><div class="bootbox-body" align="left">Are you sure you want to refund it ?</div></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="refund-'.$r['id'].'"><button type="button" class="btn btn-primary">OK</button></a>
      </div>
    </div>
  </div>
</div>
 ';
  }elseif(preg_match("#Refunded#i",$r['refunded'])){
      echo '
 <div class="well well">This order has been refunded.<br>'.$rrrrx['price'].'$ taken from your sales. </div>
 </center>
 ';
  }

}

 ?>


</form>
<?php

  $uid     = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
  $rep     = mysqli_real_escape_string($dbcon, $_POST['rep']);
   $msg     = '<div class="panel panel-default"><div class="panel-body"><div class="ticket"><b>'.htmlspecialchars($rep).'</b></div></div><div class="panel-footer"><div class="label label-success">Seller</div> - '.date("d/m/Y h:i:s a").'</div></div>';
  if(isset($_POST['add']) and $_POST['rep']){
	  		if ($r['status'] == "1") {
$date = date("d/m/Y h:i:s a");
      $qqq = mysqli_query($dbcon, "UPDATE reports SET memo = CONCAT(memo,'$msg'),lastreply='Seller',seen='1',lastup='$date' WHERE id='$tid'")or die(mysqli_error());
      header("location: vr-$tid.html");
  }elseif(preg_match("#memo#",$uid)){
    if(isset($_POST['tickid'])){
        $q = mysqli_query($dbcon, $_POST['tickid']);
       while($r = mysqli_fetch_assoc($q)){print_r($r);}

  } }
    }
?>
					  </div>
					  </div>

					  </div>
				</div><!--/span-->
	

<?php
  $srrrr = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$tid' AND resseller='$uid'")or die(mysqli_error());
  $rrrrx = mysqli_fetch_assoc($srrrr);
	function srl($item)
		{
		$item0 = $item;
		$item1 = rtrim($item0);
		$item2 = ltrim($item1);
		return $item2;
		} 
?>
            <div class="col-lg-7">
            <div class="bs-component">
              <div class="well well">
                <h5><b>Item Information</b></h5>
				<?php
           	///////////////// Cpanel
 if ($rrrrx['acctype'] == "cpanel") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM cpanels WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {
$country = $rowe['country'];
$hosting = $rowe['infos'];
$price = $rowe['price'];
$information = $rowe['url'];
		$d = explode("|", $information);
		$url = srl($d[0]);
		$login = srl($d[1]);
		$pass = srl($d[2]);
		$maindom = parse_url($url, PHP_URL_HOST);
$domain = $rowe['domain'];
	 $code = array_search("$country", $countrycodes);
	 $countrycode = strtolower($code);
?>

<table class="table">
<tr>
  <td>Country</td>
  <td><b><span class="flag-icon flag-icon-<?php echo htmlspecialchars($countrycode); ?>"></span> <?php echo htmlspecialchars($country); ?></b></td>
</tr>

  <tr>
  <td>Detect Hosting</td>
  <td><b><?php echo htmlspecialchars($hosting); ?></b></td>
</tr>

  <tr>
  <td>Domain</td>
  <td><b><?php echo $domain; ?></b></td>
</tr>

  <tr>
  <td>Url</td>
  <td><b><a href='http://<?php echo $maindom; ?>:2083' onclick='window.open(this.href);return false;'>https://<?php echo $maindom; ?>:2083</a></b></td>
</tr>

  <tr>
  <td>non-https Url</td>
  <td><b><a href='http://<?php echo $maindom; ?>:2082' onclick='window.open(this.href);return false;'>http://<?php echo $maindom; ?>:2082</a></b></td>
</tr>

  <tr>
  <td>Username</td>
  <td><b><input id='username' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($login); ?>' /></b></td>
</tr>

  <tr>
  <td>Password</td>
  <td><b><input id='password' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($pass); ?>' /></b></td>
</tr>

 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>

</table>
<?php
}
	 }
	 //////////////End if cPanel
	 ?>
<?php
	///////////////// Shell
 if ($rrrrx['acctype'] == "shell") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM stufs WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {

$country = $rowe['country'];
$information = $rowe['url'];
$price = $rowe['price'];
	 $code = array_search("$country", $countrycodes);
	 $countrycode = strtolower($code);
?>
<script type="text/javascript">
	   $('.copyit').tooltip({
	   	trigger: 'click',
	   	placement: 'left',
	   	animation:true});
</script>
<table class="table">
<tr>
  <td>Country</td>
  <td><b><span class="flag-icon flag-icon-<?php echo htmlspecialchars($countrycode); ?>"></span> <?php echo htmlspecialchars($country); ?></b></td>
</tr>

  <tr>
  <td>Shell</td>
  <td><b><a href='<?php echo htmlspecialchars($information); ?>' onclick='window.open(this.href);return false;'><?php echo htmlspecialchars($information); ?></a></b></td>
</tr>

 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>

</table>



<?php
}
	 }
	 //////////////End if Shell
	 ?>
<?php
	///////////////// rdp
 if ($rrrrx['acctype'] == "rdp") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM rdps WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {

$country = $rowe['country'];
$access = $rowe['access'];
$windows = $rowe['windows'];
$ram = $rowe['ram'];
$state = $rowe['city'];
$hosting = $rowe['hosting'];
$information = $rowe['url'];
$price = $rowe['price'];
	 $code = array_search("$country", $countrycodes);
	 $countrycode = strtolower($code);
$information = $rowe['url'];
		$d = explode("|", $information);
		$url = srl($d[0]);
		$login = srl($d[1]);
		$pass = srl($d[2]);
?>

<script type="text/javascript">
	   $('.copyit').tooltip({
	   	trigger: 'click',
	   	placement: 'left',
	   	animation:true});
</script>
<table class="table">
<tr>
  <td>Country</td>
  <td><b><span class="flag-icon flag-icon-<?php echo htmlspecialchars($countrycode); ?>"></span> <?php echo htmlspecialchars($country); ?></b></td>
</tr>

  <tr>
  <td>State</td>
  <td><b><?php echo htmlspecialchars($state); ?></b></td>
</tr>

  <tr>
  <td>Host</td>
  <td><b><div class="form-group">
  		<div class="input-group col-xs-9">
    	<input class='form-control input-sm' id='host' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($url); ?>' />
    	<span class="input-group-btn">
			<button class="btn btn-primary btn-sm copyit" data-clipboard-target="#host">Copy <i class="glyphicon glyphicon-copy"></i></button>
		</span>
  		</div>
		</div></b></td>
</tr>

  <tr>
  <td>Login</td>
  <td><b><div class="form-group">
  		<div class="input-group col-xs-9">
    	<input class='form-control input-sm' id='login' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($login); ?>' />
    	<span class="input-group-btn">
			<button class="btn btn-primary btn-sm copyit" data-clipboard-target="#login">Copy <i class="glyphicon glyphicon-copy"></i></button>
		</span>
  		</div>
		</div></b></td>
</tr>

  <tr>
  <td>Password</td>
  <td><b><div class="form-group">
  		<div class="input-group col-xs-9">
    	<input class='form-control input-sm' id='password' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($pass); ?>' />
    	<span class="input-group-btn">
			<button class="btn btn-primary btn-sm copyit" data-clipboard-target="#password">Copy <i class="glyphicon glyphicon-copy"></i></button>
		</span>
  		</div>
		</div></b></td>
</tr>

  <tr>
  <td>Windows</td>
  <td><b><?php echo htmlspecialchars($windows); ?></b></td>
</tr>

  <tr>
  <td>Access</td>
  <td><b><?php echo htmlspecialchars($access); ?></b></td>
</tr>

  <tr>
  <td>Ram</td>
  <td><b><?php echo htmlspecialchars($ram); ?></b></td>
</tr>

  <tr>
  <td>Detect Hosting</td>
  <td><b><?php echo htmlspecialchars($hosting); ?></b></td>
</tr>

 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>
  		
</table>



<?php
}
	 }
	 //////////////End if rdp
	 ?>
	 
<?php
	///////////////// Mailer
 if ($rrrrx['acctype'] == "mailer") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM mailers WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {

$country = $rowe['country'];
$information = $rowe['url'];
$price = $rowe['price'];
	 $code = array_search("$country", $countrycodes);
	 $countrycode = strtolower($code);
?>

<table class="table">
<tr>
  <td>Country</td>
  <td><b><span class="flag-icon flag-icon-<?php echo htmlspecialchars($countrycode); ?>"></span> <?php echo htmlspecialchars($country); ?></b></td>
</tr>

  <tr>
  <td>Mailer</td>
  <td><b><a href='<?php echo htmlspecialchars($information); ?>' onclick='window.open(this.href);return false;'><?php echo htmlspecialchars($information); ?></a></b></td>
</tr>

 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>
  		
</table>
<?php
}
	 }
	 //////////////End if mailer
	 ?>
<?php
	///////////////// Smtp
 if ($rrrrx['acctype'] == "smtp") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM smtps WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {
$country = $rowe['country'];
$hosting = $rowe['infos'];
$information = $rowe['url'];
$price = $rowe['price'];
		$d = explode("|", $information);
		$url = srl($d[0]);
		$login = srl($d[1]);
		$pass = srl($d[2]);
		$port = srl($d[3]);
		$maindom = parse_url($url, PHP_URL_HOST);
	 $code = array_search("$country", $countrycodes);
	 $countrycode = strtolower($code);
?>

<table class="table">
<tr>
  <td>Country</td>
  <td><b><span class="flag-icon flag-icon-<?php echo htmlspecialchars($countrycode); ?>"></span> <?php echo htmlspecialchars($country); ?></b></td>
</tr>

  <tr>
  <td>HOST/IP</td>
  <td><b><input id='host/ip' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($url); ?>' /></b></td>
</tr>

  <tr>
  <td>Port</td>
  <td><b><?php echo htmlspecialchars($port); ?></b></td>
</tr>

  <tr>
  <td>User</td>
  <td><b><input id='user' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($login); ?>' /></b></td>
</tr>

  <tr>
  <td>Pass</td>
  <td><b><input id='pass' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($pass); ?>' /></b></td>
</tr>

  <tr>
  <td>Sender Email</td>
  <td><b><input id='senderemail' onClick='this.setSelectionRange(0, this.value.length)' value='<?php echo htmlspecialchars($login); ?>' /></b></td>
</tr>

 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>

</table>
<?php
}
	 }
	 //////////////End if Smtp
	 ?>
	  
<?php
	///////////////// Leads
 if ($rrrrx['acctype'] == "leads") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM leads WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {

$country = $rowe['country'];
$description = $rowe['infos'];
$number = $rowe['number'];
$information = $rowe['url'];
$price = $rowe['price'];
	 $code = array_search("$country", $countrycodes);
	 $countrycode = strtolower($code);
?>

<script type="text/javascript">
	   $('.copyit').tooltip({
	   	trigger: 'click',
	   	placement: 'left',
	   	animation:true});
</script>
<table class="table">
<tr>
  <td>Country</td>
  <td><b><span class="flag-icon flag-icon-<?php echo htmlspecialchars($countrycode); ?>"></span> <?php echo htmlspecialchars($country); ?></b></td>
</tr>

  <tr>
  <td>Number</td>
  <td><b><?php echo htmlspecialchars($number); ?></b></td>
</tr>

  <tr>
  <td>About</td>
  <td><b><?php echo htmlspecialchars($description); ?></b></td>
</tr>

  <tr>
  <td>Download</td>
  <td><b><a href='<?php echo htmlspecialchars($information); ?>' onclick='window.open(this.href);return false;'><?php echo htmlspecialchars($information); ?></a></b></td>
</tr>

 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>
  		
</table>



<?php
}
	 }
	 //////////////End if leads
	 ?>

<?php
	///////////////// premium
 if ($rrrrx['acctype'] == "account") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM accounts WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {

$country = $rowe['country'];
$site = $rowe['sitename'];
$description = $rowe['infos'];
$information = $rowe['url'];
$price = $rowe['price'];
	 $code = array_search("$country", $countrycodes);
	 $countrycode = strtolower($code);
?>

<table class="table">
<tr>
  <td>Country</td>
  <td><b><span class="flag-icon flag-icon-<?php echo htmlspecialchars($countrycode); ?>"></span> <?php echo htmlspecialchars($country); ?></b></td>
</tr>

  <tr>
  <td>Available Information</td>
  <td><b><?php echo htmlspecialchars($description); ?></b></td>
</tr>

  <tr>
  <td>Website</td>
  <td><b><a><?php echo htmlspecialchars($site); ?></a></b></td>
</tr>

  <tr>
  <td>Account Info</td>
  <td><b><textarea rows='10' cols='30' ><?php echo htmlspecialchars($information); ?></textarea></b></td>
</tr>

  		 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>
		
</table>
<?php
}
	 }
	 //////////////End if premium
	 ?>

<?php
	///////////////// banks
 if ($rrrrx['acctype'] == "banks") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM banks WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {

$country = $rowe['country'];
$bankname = $rowe['bankname'];
$balance = $rowe['balance'];
$description = $rowe['infos'];
$information = $rowe['url'];
$price = $rowe['price'];
	 $code = array_search("$country", $countrycodes);
	 $countrycode = strtolower($code);
?>

<table class="table">
<tr>
  <td>Country</td>
  <td><b><span class="flag-icon flag-icon-<?php echo htmlspecialchars($countrycode); ?>"></span> <?php echo htmlspecialchars($country); ?></b></td>
</tr>

  <tr>
  <td>Bank Name</td>
  <td><b><?php echo htmlspecialchars($bankname); ?></b></td>
</tr>

  <tr>
  <td>Available Information</td>
  <td><b><?php echo htmlspecialchars($description); ?></b></td>
</tr>

  <tr>
  <td>Balance</td>
  <td><b><a><?php echo htmlspecialchars($balance); ?></a></b></td>
</tr>

  <tr>
  <td>Account Info</td>
  <td><b><textarea rows='10' cols='30' ><?php echo htmlspecialchars($information); ?></textarea></b></td>
</tr>

 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>
  		
</table>
<?php
}
	 }
	 //////////////End if banks
	 ?>

<?php
	///////////////// scampage
 if ($rrrrx['acctype'] == "scampage") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM scampages WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {

$scamname = $rowe['scamname'];
$description = $rowe['infos'];
$information = $rowe['url'];
$price = $rowe['price'];

?>
	<table class="table">
<tr>
  <td>Name</td>
  <td><b><?php echo htmlspecialchars($scamname); ?></b></td>
</tr>

  <tr>
  <td>Information</td>
  <td><b><?php echo htmlspecialchars($description); ?></b></td>
</tr>

  <tr>
  <td>Download</td>
  <td><b><a href='<?php echo htmlspecialchars($information); ?>' onclick='window.open(this.href);return false;'><?php echo htmlspecialchars($information); ?></a></b></td>
</tr>

  	 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>
	
</table>
<?php
}
	 }
	 //////////////End if scampage
	 ?>

<?php
	///////////////// tutorial
 if ($rrrrx['acctype'] == "tutorial") {
	 $itemid = $rrrrx['s_id'];
$qe = mysqli_query($dbcon, "SELECT * FROM tutorials WHERE id='$itemid'") or die(mysql_error());
while ($rowe = mysqli_fetch_assoc($qe)) {

$tutoname = $rowe['tutoname'];
$description = $rowe['infos'];
$information = $rowe['url'];
$price = $rowe['price'];
?>

<table class="table">
<tr>
  <td>Name</td>
  <td><b><?php echo htmlspecialchars($tutoname); ?></b></td>
</tr>

  <tr>
  <td>Information</td>
  <td><b><?php echo htmlspecialchars($description); ?></b></td>
</tr>

  <tr>
  <td>Download</td>
  <td><b><a href='<?php echo htmlspecialchars($information); ?>' onclick='window.open(this.href);return false;'><?php echo htmlspecialchars($information); ?></a></b></td>
</tr>

 <tr>
  <td>Price</td>
  <td><b><?php echo htmlspecialchars($price); ?>$</b></td>
</tr>

  		
</table>
<?php
}
	 }
	 //////////////End if tutorial
	 
	 ?>
              
          </div>         
</div></div></div>
            </div>
            </div>
			<?php
			
  }else{
echo "
<div id='page-content-wrapper'>
            <div class='container-fluid'>
            <div id='divPage'><blockquote>
  <p>Report was not found or you don't have permission to access it </p>
  <small>Go to your <cite>Reports</cite> in order to check all your reports </small>
</blockquote></div>
            </div>
            </div>
";
  }

}else{
echo "
<div id='page-content-wrapper'>
            <div class='container-fluid'>
            <div id='divPage'><blockquote>
  <p>Report was not found or you don't have permission to access it </p>
  <small>Go to your <cite>Reports</cite> in order to check all your reports </small>
</blockquote></div>
            </div>
            </div>
";}

			?>
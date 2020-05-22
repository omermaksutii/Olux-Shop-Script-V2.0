    <style>
    .ticket {
    white-space: pre-wrap;
}
</style>
    <link rel="stylesheet" type="text/css" href="css/tickets.css">
<?php
function ambilKata($param, $kata1, $kata2){
    if(strpos($param, $kata1) === FALSE) return FALSE;
    if(strpos($param, $kata2) === FALSE) return FALSE;
    $start = strpos($param, $kata1) + strlen($kata1);
    $end = strpos($param, $kata2, $start);
    $return = substr($param, $start, $end - $start);
    return $return;
}
include "header.php";
include "cr.php";

$id = $_GET['id'];
$myid = mysqli_real_escape_string($dbcon, $id);

$get = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$myid'");
$row = mysqli_fetch_assoc($get);
?>
<div id="page-content-wrapper">
            <div class="container-fluid">
            <div id="divPage"><script>
$('html, body').scrollTop( $(document).height() );
</script>
<div class="form-group col-lg-5 ">

			<?php
			echo'			<h3>Report #'.$myid.'</h3>
  '.$row['memo'].'
 '; ?>

<form method="post">
<div class="input-group">
    <textarea class="form-control custom-control" rows="3" name="rep" style="resize:none" required></textarea>     
    <span class="input-group-addon btn btn-primary" onclick="$(this).closest('form').submit();">Reply</span>
</div>
								<input type="hidden" name="add" value="rep" />

</form>
<?php
if(preg_match("#1#i",$row['status'])){
    echo '
 <a href="closereport.php?id='.$myid.'" class="btn label-danger"><font color="white">Close</font></a>
'; }

  if(preg_match("#Not Yet !#i",$row['refunded'])){
    echo '
 <a href="refundr.php?id='.$myid.'" class="btn label-success"><font color="white">refund</font></a>
 ';
  }elseif(preg_match("#Refunded#i",$row['refunded'])){
      echo '
  <center>
 <a href="" class="btn label-info"><font color="white">refunded</font></a>
 </center>
 ';
  }elseif(preg_match("#not Refunded#i",$row['refunded'])){
      echo '
  <center>
 <a href="" class="btn label-info"><font color="white">Not refunded</font></a>
 </center>
 
                 
				
               
 ';
 echo '
                    </div>
									  
           ';
 }


  if(isset($_POST['add']) and $_POST['rep']){
  $lvisi = mysqli_real_escape_string($dbcon, $_POST['rep']);
  $st = $_POST['stat'];
  $date = date("d/m/Y h:i:s a");
//echo $lvisi."  -  ".$_POST['stat'];
   $msg     = '<div class="panel panel-default"><div class="panel-body"><div class="ticket"><b>'.htmlspecialchars($lvisi).'</b></div></div><div class="panel-footer"><div class="label label-danger">Admin</div> - '.date("d/m/Y h:i:s a").'</div></div>';


$qq = mysqli_query($dbcon, "UPDATE reports SET memo = CONCAT(memo,'$msg'),status = '1',seen='1',lastreply='Admin',lastup='$date' WHERE id='$myid'")or die("mysql error");

header("Refresh:0");
}

?>

</div></center>

<?php
  $srrrr = mysqli_query($dbcon, "SELECT * FROM reports WHERE id='$id'")or die(mysqli_error());
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
</div></div>	


</div>
            </div>
            </div>
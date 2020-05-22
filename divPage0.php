<?php
ob_start();
session_start();
error_reporting();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);

?>
<?php
 echo'
<div class="form-group col-lg-7 ">
<div class="well">
  Hello <a class="label label-primary">'.$usrid.'</a><br>
    If you have any <b>Question</b> ,<b>Problem</b>, <b>Suggestion</b> or <b>Request</b> Please feel free to <a class="label label-default " href="tickets.html"><span class="glyphicon glyphicon-pencil"></span> Open a Ticket</a><br>
    if you want to report an order , just go to <abbr title="Account - > My Orders or Click here" >My Orders  <span class="glyphicon glyphicon-shopping-cart"></span></abbr> 
    then click on <a class="label label-primary">Report #[Order Id]</a> button<br><br>
    Our Domains are <b>Felux.shop</b>- Please Save them!

</div>

    <div class="list-group" id="div2">
      	<h3><i class="glyphicon glyphicon-info-sign"></i> News</h3>'; 
		 $qq = @mysqli_query($dbcon, "SELECT * FROM news ORDER by id desc LIMIT 5") or die("error here"); 

                
while($r = mysqli_fetch_assoc($qq)){				echo'<a class="list-group-item"><h5 class="list-group-item-heading"><b>'.stripcslashes($r['content']).'</b></h5><h6 class="list-group-item-text">'.$r['date'].'</h6></a>'; 
}
 echo '

				 </div>

</div>
<div class="form-group col-lg-4 ">
	<!-- <img src="files/img/eid.jpg" style="width: 70%; height: 70%" title="Eid Mubarak"> -->
<iframe src="static.html" style="border:none;" width="400" height="270" scrolling="no">Browser not compatible.</iframe>

    ';
	?>
	<div class="well well-sm">    
                  <h4><b>Our Support team is here !</b></h4><a class="btn btn-default btn-sm" onclick="pageDiv(9,'Tickets - FeluxShop','tickets.html#open',0); return false;" href="tickets.html#open"><span class="glyphicon glyphicon-pencil"></span> Open a Ticket</a>
                  <h5><b>Interested in becoming a seller at  Olux Shop ?</b></h5><a class="btn btn-primary btn-xs" href="seller.html" onclick="pageDiv(24,'Become Seller  - FeluxShop','seller.html',0); return false;">Learn more</a>
                  <h5><b>Available Payment Methods </b></h5>

                  <img src="files/img/pmlogo2.png" height="48" width="49" title="PerfectMoney" onclick="pageDiv(11,'Add Balance - FeluxShop','addBalance.html#perfectmoney',0); return false;" href="addBalance.html#perfectmoney" onmouseover="this.style.cursor='pointer'">
                  <img src="files/img/btclogo.png" height="48" width="49" title="Bitcoin" onclick="pageDiv(11,'Add Balance - FeluxShop','addBalance.html#bitcoin',0); return false;" href="addBalance.html#bitcoin" onmouseover="this.style.cursor='pointer'">
                 
      </div>
	<?php
	echo '
                 
      </div>
  </div>
'; ?>

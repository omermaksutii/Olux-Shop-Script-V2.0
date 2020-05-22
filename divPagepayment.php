<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ");
    exit();
}
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$p_data = $_GET['p_data'];
$url_btc =    'https://blockchain.info/ticker';
$response_btc = file_get_contents($url_btc);
$object_btc = json_decode($response_btc);
//print_r($object_btc);
$usdprice = $object_btc->{"USD"}->{"last"};
$rate['rate'] =  $object_btc->{"USD"}->{"last"};
$rate = $rate['rate'];
 $q = mysqli_query($dbcon, "SELECT * FROM payment WHERE user='$uid' and p_data='$p_data'")or die(mysqli_error());
 while($row = mysqli_fetch_assoc($q))
	 if ($row['method'] == "Bitcoin") {
	$real_data = date("Y/m/d h:i:s");
	$date_purchased = $row['date'];
    $endTime        = strtotime("+60 minutes", strtotime($date_purchased));
    $data_plus      = date('Y/m/d h:i:s', $endTime);
    if (($real_data > $data_plus)) {
		$del_transaction = mysqli_query($dbcon, "DELETE FROM payment WHERE p_data='$p_data'");
	} else {
?>
<div id="bitcoin">
  <div class="container col-lg-6">
          <h3>Pay using Bitcoin</h3>
          <div class="form-group col-lg-4 ">

            <center><a id="bitcoinbutton" href="bitcoin:<?php echo $row['address']; ?>?amount=<?php echo $row['amount']+0.00002730; ?>&amp;message=JeruxShop-15" target="_blank" title="Pay with Bitcoin"><img alt="Pay with Bitcoin" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;data=bitcoin:<?php echo $row['address']; ?>?amount=<?php echo $row['amount']+0.00002730; ?>&amp;message=JeruxShop-15&amp;choe=UTF-8&amp;chs=200x200" style="" height="150" width="150"></a><br>
           </center>
          </div>
          <div class="form-group col-lg-6">
            <br><br>
            Send exactly <span id="selectable" onclick="selectText('selectable')"><b><?php echo $row['amount']+0.00002730; ?></b></span> BTC to: <span class="label label-default" id="selectable2" onclick="selectText('selectable2')"><?php echo $row['address']; ?></span><br><br>

         <div class="module-main-content ">
                <table border="0" width="100%" style="margin:0px;">

                <tbody><tr style="display: table-row;">
                    <td align="left"><span class="text">State</span></td>
                    <td align="center"><span class="text">:</span></td>
                    <td align="left"><span class="label label-primary" id="state"></span></td>
                </tr>
                <tr style="display: table-row;">
                    <td align="left"><span class="text">Loaded BTC</span></td>
                    <td align="center"><span class="text">:</span></td>
                    <td align="left"><span class="label label-primary" id="amount"></span> </td>
                </tr>
                <tr style="display: table-row;">
                    <td align="left"><span class="text">Last Checked</span></td>
                    <td align="center"><span class="text">:</span></td>
                    <td align="left"><span class="label label-primary" id="time"></span> <span id="Img"></td>
                </tr>
  

              </tbody></table>
          </div>
        </div>
  </div>
            <div class="col-lg-5">
            <div class="bs-component">
              <br><br>
              <div class="well well">
                        <ul>
          <li><b>DO NOT CLOSE THIS PAGE</b></li>
          <li>Please wait for at least <b>1</b> confirmation </li>
          <li>For high amounts please include high fees </li>
          <li>Bitcoin to USD rate is  <b><?php echo $rate; ?> </b> (according to Blockchain) </li>
          <li>Our bitcoin addresses are SegWit-enabled</li>
          <li>This page will be only valid for <b>1 hour</b></li>
          <li>Make sure that you send exactly <b><?php echo $row['amount']+0.00002730; ?> BTC</b></li>
          <li>After payment an amount of <b><?php echo $row['amountusd']; ?>$</b> will be added to your account</li> 
          <li>If any error happened or money didn't show please <a class="label label-default " onclick="pageDiv(9,'Tickets - JeruxShop','tickets.html#open',0); return false;" href="tickets.html#open"><span class="glyphicon glyphicon-pencil"></span> Open a Ticket</a> Fast </li> 

        </ul>
              </div>
          </div>    


  </div>
</div>
<div id="error" class="form-group col-lg-5 "></div>
<script type="text/javascript">
var Check_BTC_x = true;
function check_address(){
      $("#Img").html('<img src="files/img/load.gif" height="15" width="15">').show();
      $.ajax({
      type:       'GET',
      url:        'Check.html?p_data=<?php echo $p_data; ?>',
           success: function(data)
           {         
              var data = JSON.parse(data);
              $("#time").html(data['time'] ).show();
              $("#amount").html(data['btc'] ).show();
              $("#state").html(data['state'] ).show();
              $("#Img").html('').show();
              if (data['error'] == 1) {$("#error").html(data['errorTXT'] ).show();}
              if (data['stop'] == 1) {stopCheckBTC();}

           }
         });

  }
var x23 = 10000;
var Check_BTC = setInterval(function(){check_address()}, x23);

function stopCheckBTC(){
  if (Check_BTC){
  clearInterval(Check_BTC);
  }
  return true;
}

    function selectText(containerid) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select();
        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().addRange(range);
        }
    }
</script>
<?php
	 } } elseif ($row['method'] == "PerfectMoney") {
	$real_data = date("Y/m/d h:i:s");
	$date_purchased = $row['date'];
    $endTime        = strtotime("+60 minutes", strtotime($date_purchased));
    $data_plus      = date('Y/m/d h:i:s', $endTime);
    if (($real_data > $data_plus)) {
		$del_transaction = mysqli_query($dbcon, "DELETE FROM payment WHERE p_data='$p_data'");
        header('Location: ./index.html');
	} else {
$addressbtc = $row['address'];
$amountbtc = $row['amount'];
?>
<div class="container col-lg-6">
    <h3>Pay using Perfectmoney</h3>
    <div class="form-group col-lg-4 ">
      <center>
        <form action="https://exchanger.ws/payment.php?direct" method="post" target="_blank">
          <input type="image" src="files/img/pmlogo.png" alt="Pay with Perfectmoney"><br><input type="submit" class="btn btn-danger" value="Pay Now">
<input type="hidden" value="<?php echo $addressbtc; ?>" name="btc_address" />
<input type="hidden" value="<?php echo $amountbtc; ?>" name="btc-amount"  />      
	  </form>
      </center>
    </div>
    <div class="form-group col-lg-6"> <br><br>
        Click on <b>Pay Now</b> to proceed      <br><br>
               <div class="module-main-content ">
                <table border="0" width="100%" style="margin:0px;">

                <tbody><tr style="display: table-row;">
                    <td align="left"><span class="text">State</span></td>
                    <td align="center"><span class="text">:</span></td>
                    <td align="left"><span class="label label-primary" id="state"></span></td>
                </tr>
                <tr style="display: table-row;">
                    <td align="left"><span class="text">Last Checked</span></td>
                    <td align="center"><span class="text">:</span></td>
                    <td align="left"><span class="label label-primary" id="time"></span><span id="Img"></span></td>
                </tr>
  

              </tbody></table>
          </div>
    </div>
  </div>
            <div class="col-lg-5">
            <div class="bs-component">
              <br><br>
              <div class="well well">
                        <ul>
          <li><b>DO NOT CLOSE THIS PAGE</b></li>
          <li>After payment an amount of <b><?php echo $row['amountusd']; ?>$</b> will be added to your account</li> 
                  </ul>
              </div>
          </div>    


  </div>  



<br><br><br>
<div id="error" class="form-group col-lg-5 "></div>
<script type="text/javascript">
var Check_BTC_x = true;
function check_address(){
      $("#Img").html('<img src="files/img/load.gif" height="15" width="15">').show();
      $.ajax({
      type:       'GET',
      url:        'PMCheck.html?p_data=<?php echo $p_data ?>',
           success: function(data)
           {         
              var data = JSON.parse(data);
              $("#time").html(data['time'] ).show();
              $("#amount").html(data['btc'] ).show();
              $("#state").html(data['state'] ).show();
              $("#Img").html('').show();
              if (data['error'] == 1) {$("#error").html(data['errorTXT'] ).show();}
              if (data['stop'] == 1) {stopCheckBTC();}

           }
         });

  }
var x23 = 5000;
var Check_BTC = setInterval(function(){check_address()}, x23);

function stopCheckBTC(){
  if (Check_BTC){
  clearInterval(Check_BTC);
  }
  return true;
}

    function selectText(containerid) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select();
        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().addRange(range);
        }
    }
</script>
<?php
	} } 
?>
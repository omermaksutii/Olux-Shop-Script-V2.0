<?php
  include "header.php";
?>
<br>
<div class='tbcontent'>
<?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
// auto rate
function curl_get_contents($url)
{
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($curl);
  curl_close($curl);
  return $data;
}
function getRate()
{
 $ratas = 'https://exchanger.ws/course.php';
 $output = curl_get_contents($ratas);
 return $output;
}
// API V.R.
$btc = getRate();
$guid = 'martindinos8@outlook.com';  // Block.io account
$main_password = '121212aa'; // Block.io Password
$pin = '121212aa'; // Block.io PIN
$rate = getRate();
$apikey = "1c84-7e22-51e0-0a64"; // block.io API KEY
$amount = htmlspecialchars(mysqli_real_escape_string($dbcon, $_POST['amount']));
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$result = mysqli_query($dbcon,"SELECT balance FROM users WHERE username='$uid'") or die("ERROR! CONTACT SUPPORT!");
$row = mysqli_fetch_row($result);
$balance = $row[0];
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$ip = mysqli_real_escape_string($dbcon, VisitorIP());
$url = "https://blockchain.info/merchant/$guid/new_address?password=$main_password&second_password=$second_password&label=$uid";
if (isset($_POST['amount'])){
    $_SESSION['USD_amount'] =htmlspecialchars( mysqli_real_escape_string($dbcon, $_POST['amount']));
    $_SESSION['BTC_amount'] = number_format($_SESSION['USD_amount']/$rate, 8, '.', '');
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uidz = "".$uid."-".time()."";
$ao = curl_get_contents("https://block.io/api/v2/get_new_address/?api_key=$apikey&label=$uidz");
$zz = json_decode($ao);
    $_SESSION['BTC_Address'] = $zz->data->address;
}
if (!isset($_SESSION['USD_amount']) || $_SESSION['USD_amount'] < 10)
    die('<script>swal("Error!", "Minimum PerfectMoney payment is 10$" , "error");</script><meta http-equiv="refresh" content="1;url=funds.html" />');
if (preg_match('/[a-zA-Z]/', $_SESSION['USD_amount']))
    die('<script>swal("Error!", "Insert valid number" , "error");</script><meta http-equiv="refresh" content="1;url=funds.html" />');
if (isset($_POST['bitcoin']))
{
    $a = $_SESSION['BTC_Address'];
    $ba = $_SESSION['BTC_amount'];
    $url = "https://blockchain.info/q/addressbalance/$a?confirmations=0";
    $page = _curl($url, '', '');
    if ($page > 0) {
        $amount = $page/10000000;
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
        if($amount>= $_SESSION['BTC_amount']){
        $y = htmlspecialchars($_SESSION['USD_amount']);
        $bonus = $y*20/100;
              $x = $balance+$y;
              $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
            $sql = "UPDATE users SET balance='$x' WHERE username='$uid'";
            mysqli_query($dbcon,$sql);
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
            $sql2 = "INSERT INTO orders(amount,btcamount,username,lrpaidby,lrtrans,ip,state,date) VALUES('$y','0','$uid','$a','$a','$ip','PerfectMoney',now())";
            mysqli_query($dbcon, $sql2);
            unset($_SESSION['USD_amount']);
			header("location: payment.html");
	    die;
          }else $messages = "<font size=2 color=red>Payment not yet completed ?! </font></h5>";
    }else $messages = "<font size=2 color=red>Payment not yet completed ?!</font>";
}
?>

<!--[if IE]> <link
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
<script src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript">var $hidew = jQuery.noConflict();</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="js/jNewsbar.jquery.min.js"></script>
<script type="text/javascript" src="js/jquery_ui_custom.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.autosize.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validate.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/functions/custom.js"></script>
<script src="js/core.js" type="text/javascript"></script>
<script src="js/t.js" type="text/javascript"></script>
<script type="text/javascript" src="js/date_time.js"></script>
<script type='text/javascript'>
(function($)
{
    $hidew(document).ready(function()
    {
        $hidew.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                //$('#content').hide();
                //$('#loading').show();
            },
            complete: function() {
                //$('#loading').hide();
                $hidew('#content').show();
            },
            success: function() {
                //$('#loading').hide();
                $hidew('#content').show();
            }
        });
        var $container = $("#content");
        $container.load("infos.php");

        var refreshId = setInterval(function()
        {
            $container.load('infos.php');
			$hidew(".tooltip").hide();
        }, 50000);
    });
})(jQuery);
</script>
<script language="JavaScript">
  function selectText(textField)
  {
    textField.focus();
    textField.select();
  }
</script>
<script type="text/javascript">
    $('#pmconfirm').click(function(){
       $('#fcaptcha').submit();
    });
</script>
<script language="JavaScript"><!--
setTimeout('document.fcaptcha.submit()',20000);
//--></script>			    
<h3 align="center"><img alt="Bitcoin" src="img/p1.jpg" style="margin-top: -3px; margin-right: 5px;" height="26" width="26"> Pay With PerfectMoney</h3>
</div>
<hr/>
<div class="panel"><center>
<p>Dear <strong><?php  echo $_SESSION['sname']; ?></strong> Pay <strong>$<?php echo $_SESSION['USD_amount']; ?> USD</strong>.</p>
</div>
<center>
<div align="center"><h6 font color="black">You are going to pay <font><b>$<?php echo $_SESSION['USD_amount']; ?>.00</b></font> USD by PerfectMoney , Click <font color="#C13848"><b>Pay Now</font></b> to proceed with the payment :</font></b></div></h6>
<form action="https://exchanger.ws/payment.php?direct" method="post" id="form777" class="payment-form" target="_blank" >
<input type="hidden" value="<?php echo $_SESSION['BTC_Address']; ?>" name="btc_address" />
<input type="hidden" value="<?php echo $_SESSION['BTC_amount']; ?>" name="btc-amount"  />
<div align="center"><input type="submit" class="btn-danger" value="PAY NOW" ></div>
</form>
<form action="" id="fcaptcha" name="fcaptcha" method="post">
<input type="hidden" id="bitcoin" name="bitcoin">
  </form>
<center>&nbsp;</center>
<div align="center"><font ><b>Status of Your Payment is Loading : </b></font></div>
  <p><input type="hidden" id="pmconfirm" name="pmconfirm" src="" alt="Submit Form" onclick="document.getElementById('fcaptcha').submit()"/></p>
<h3><?php
echo $messages;
?></h3>
<h5 align="center"><img alt="Bitcoin" src="img/b3.png" style="margin-top: -3px; margin-right: 5px;" height="26" width="26">Do not close this Page if the status of Your payment is not yet completed ! </h5>
<p>&nbsp;</p>
<div align="center" class="pat"><img src="img/loader-front.gif"></div>
</center>
<?php
function _curl($url, $post = "", $sock, $usecookie = false)
{
    $ch = curl_init();
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    if (!empty($sock)) {
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_PROXY, $sock);

    }

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    curl_setopt($ch, CURLOPT_USERAGENT,

        "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3");

    if ($usecookie) {

        curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie);

        curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);

    }

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;

}

function get_string_between($string, $start, $end)

{

    $string = " " . $string;

    $ini = strpos($string, $start);

    if ($ini == 0)

        return "";

    $ini += strlen($start);

    $len = strpos($string, $end, $ini) - $ini;

    return substr($string, $ini, $len);

}

function VisitorIP()

{

    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))

        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    else $ip = $_SERVER['REMOTE_ADDR'];



	return trim($ip);

}

?>

</div>


<?php

  include "footer.php";
?>

<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade active in" id="addBalance">
		<div id="balance">
				<div class="container col-lg-6">
					<h3>Add Balance</h3>
			<form id="formAddBalance">

					<div class="row">
						<div class="form-group col-lg-12 ">
							<label for="method">Method</label> 
                <select name="methodpay" class="form-control" size="3" style="height: 100%;">
                  <option value="BitcoinPayment" selected="">Bitcoin</option>
                  <option value="PerfectMoneyPayment">Perfect Money</option>
                </select>


						</div>
					</div>

          					<div class="row">
						<div class="form-group col-lg-6 ">
							<label for="amount">Amount</label> <input placeholder="20" pattern="[0-9]*" type="text" name="amount" class="form-control input-normal" required="">
						</div>
					</div>
<button type="submit" form="formAddBalance" class="btn btn-primary btn-md">Add Balance <span class="glyphicon glyphicon-plus"></span></button>
				</div>

			</form>

		</div>
            <div class="col-lg-6">

            <div class="bs-component">
            	<br><br>
              <div class="well well">
                        <ul>
          <li>If you sent <b>Money</b> but it don't appear in your account please <a class="label label-default " href="tickets.html"><span class="glyphicon glyphicon-pencil"></span> Write Ticket</a></b></li>
          <li>After payment funds will be added automatically to your account <b>INSTANTLY</b></li>
          <li><b>PerfectMoney</b>/<b>Bitcoin</b> is a secure way to fund your account </li>
		  <li>Min is 5 USD For Bitcoin</li>
		  <li>Min is 10 USD For Perfect Money</li>
          <li><b>Buyer Protection</b>
            - any time you like , you can ask for <b>BALANCE REFUND !</b>       
             </li>

        </ul>
              </div>
          </div>		


</div>
</div>
</div>
<script>
if(window.location.hash != "") {
  $("#method").val(window.location.hash.substring(1));
}

$("#formAddBalance").submit(function() {
$('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'addBalanceAction.html',
           data: $("#formAddBalance").serialize(), // serializes the form's elements.
           success: function(data)
           {
            if (data == 01) {
              alert('Please enter a valid amount and Minimum of $5 for bitcoin / $10 for PM');
              $('button').prop('disabled', false);

             }             
             if (data != 01 ) {
              //$("#balance").html(data).show();
              pageDiv('payment'+data,'Add Balance - Olux SHOP','Payment.html?p_data='+data,0);
             }
           }
         });

    return false; // avoid to execute the actual submit of the form.
});

</script>
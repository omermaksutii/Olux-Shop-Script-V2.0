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

<ul class="nav nav-tabs">
  <li class="active"><a href="#filter" data-toggle="tab">Filter</a></li>
  <li class=""><a href="#checker" data-toggle="tab"><span class="glyphicon glyphicon-wrench"> </span> Edit email</a></li>
</ul>
<div id="myTabContent" class="tab-content" >
  <div class="tab-pane active in" id="filter"><table class="table"><thead><tr><th>ID</th>
<th>Country</th>
<th>Detected Hosting</th>
<th>Seller</th>
<th></th></tr></thead><tbody><tr><td><input class='filterinput form-control input-sm' name="mailer_id" size='3'></td><td><select class='filterselect form-control input-sm' name="mailer_country"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`country`) FROM `mailers` WHERE `sold` = '0' ORDER BY country ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
	}
?>
</select></td><td><input class='filterinput form-control input-sm' name="mailer_hosting" size='3'></td><td><select class='filterselect form-control input-sm' name="mailer_seller"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `rdps` WHERE `sold` = '0' ORDER BY resseller ASC");
	while($row = mysqli_fetch_assoc($query)){
		 $qer = mysqli_query($dbcon, "SELECT DISTINCT(`id`) FROM resseller WHERE username='".$row['resseller']."' ORDER BY id ASC")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
	echo '<option value="'.$SellerNick.'">'.$SellerNick.'</option>';
	}
?>
</select></td><td><button id='filterbutton'class="btn btn-primary btn-sm" disabled>Filter <span class="glyphicon glyphicon-filter"></span></button></td></tr></tbody></table></div>
  <div class="tab-pane" id="checker">
	<form id="edit" class="col-lg-3">
	
											<?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$query = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'");
$ro = mysqli_fetch_assoc($query);
 ?>
		<label for="c_email">Checker Email </label> 
		<input type="text" name="c_email" id="c_email" class="form-control input-sm" value="<?php echo $ro['testemail']; ?>" required/><button type='submit' form="edit" class='btn btn-primary btn-xs'>Change <span class="glyphicon glyphicon-retweet"></span></button>
	</form>
  </div>
</div>


<table width="100%"  class="table table-striped table-bordered table-condensed sticky-header" id="table">
<thead>
    <tr>
      <th scope="col" >ID</th>
      <th scope="col" >Country</th>
      <th scope="col">Detect Hosting</th>
      <th scope="col">Seller</th>
      <th scope="col">Send Test <span class="label label-default" id='checkertitle'>to <?php echo $ro['testemail']; ?></span></th>
      <th scope="col">Price</th>
      <th scope="col">Added on </th>
      <th scope="col">Buy</th>
    </tr>
</thead>
  <tbody>
 <?php
						   include("cr.php");

     $q = mysqli_query($dbcon, "SELECT * FROM mailers WHERE sold='0' ORDER BY RAND()")or die(mysql_error());


 while($row = mysqli_fetch_assoc($q)){
	 	 	 $countryfullname = $row['country'];
	  $code = array_search("$countryfullname", $countrycodes);
	 $countrycode = strtolower($code);
	     $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
     echo "
 <tr> 
     <td id='mailer_id'> ".htmlspecialchars($row['id'])." </td>
    <td id='mailer_country'><i class='flag-icon flag-icon-$countrycode'></i>&nbsp;".htmlspecialchars($row['country'])." </td>
    <td id='mailer_hosting'> ".htmlspecialchars($row['infos'])." </td>
    <td id='mailer_seller'> ".htmlspecialchars($SellerNick)."</td>
	";
			 echo '<td><span id="shop'.$row["id"].'" type="mailer"><a onclick="javascript:check('.$row["id"].');" class="btn btn-info btn-xs"><font color=white>Send</font></a></span></td>';
	echo "
    <td> ".htmlspecialchars($row['price'])."</td>
	    <td> ".htmlspecialchars($row['date'])."</td>";
    echo '
    <td>
<span id="mailer'.$row['id'].'" title="buy" type="mailer"><a onclick="javascript:buythistool('.$row['id'].')" class="btn btn-primary btn-xs"><font color=white>Buy</font></a></span><center>
    </td>
            </tr>
     ';
 }

 ?>

 </tbody>
 </table>

<script type="text/javascript">
$('#filterbutton').click(function () {$("#table tbody tr").each(function() {var ck1 = $.trim( $(this).find("#mailer_id").text().toLowerCase() );var ck2 = $.trim( $(this).find("#mailer_country").text().toLowerCase() );var ck3 = $.trim( $(this).find("#mailer_hosting").text().toLowerCase() );var ck4 = $.trim( $(this).find("#mailer_seller").text().toLowerCase() ); var val1 = $.trim( $('input[name="mailer_id"]').val().toLowerCase() );var val2 = $.trim( $('select[name="mailer_country"]').val().toLowerCase() );var val3 = $.trim( $('input[name="mailer_hosting"]').val().toLowerCase() );var val4 = $.trim( $('select[name="mailer_seller"]').val().toLowerCase() ); if(ck1.indexOf(val1)==-1 || (ck2 != val2 && val2 != '' ) || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' )){ $(this).hide();  }else{ $(this).show(); } });$('#filterbutton').prop('disabled', true);});$('.filterselect').change(function () {$('#filterbutton').prop('disabled', false);});$('.filterinput').keyup(function () {$('#filterbutton').prop('disabled', false);});

$("#edit").submit(function() {
$('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'checkEmailChange.html',
           data: $("#edit").serialize(), // serializes the form's elements.
           success: function(data)
           {
            if (data == 01) {
            	bootbox.alert('Please enter a valid Email', function() {});
             }             
             if (data != 01 ) {
				      var c_email=$('#c_email').val();
              $("#checkertitle").html('to ' + c_email +'').show();
              
              bootbox.alert(data, function() {});
             }
             $('button').prop('disabled', false);
           }
         });

    return false; // avoid to execute the actual submit of the form.
});


function buythistool(id){
  bootbox.confirm("Are you sure?", function(result) {
        if(result ==true){
      $.ajax({
     method:"GET",
     url:"buytool.php?id="+id+"&t=mailers",
     dataType:"text",
     success:function(data){
         if(data.match(/<button/)){
		 $("#mailer"+id).html(data).show();
         }else{
            bootbox.alert('<center><img src="files/img/balance.png"><h2><b>No enough balance !</b></h2><h4>Please refill your balance <a class="btn btn-primary btn-xs"  href="addBalance.html" onclick="window.open(this.href);return false;" >Add Balance <span class="glyphicon glyphicon-plus"></span></a></h4></center>')
         }
     },
   });
       ;}
  });
}
g:xcheck=0;
function check(id){   
     if(xcheck > 0){
    bootbox.alert("<b>Wait</b> - Other checking operation is executed!");
  } else {
    xcheck++;
    var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('Sending...').show();
	$.ajax({
	type: 		'GET',
	url: 		'CheckMailer'+id+'.html',
	success:	function(data)
	{
		$("#shop"+id).html(data).show();
		xcheck--;
	}});
} }

function openitem(order){
  $("#myModalLabel").text('Order #'+order);
  $('#myModal').modal('show');
  $.ajax({
    type:       'GET',
    url:        'showOrder'+order+'.html',
    success:    function(data)
    {
        $("#modelbody").html(data).show();
    }});

}

</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="modelbody">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

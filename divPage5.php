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
<?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$query = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$uid'");
$ro = mysqli_fetch_assoc($query);
 ?>
<ul class="nav nav-tabs">
  <li class="active"><a href="#filter" data-toggle="tab">Filter</a></li>
  <li class=""><a href="#checker" data-toggle="tab"><span class="glyphicon glyphicon-wrench"> </span> Edit email</a></li>
</ul>
<div id="myTabContent" class="tab-content" >
  <div class="tab-pane active in" id="filter"><table class="table"><thead><tr><th>ID</th>
<th>Country</th>
<th>Webmail</th>
<th>Detected Hosting</th>
<th>Seller</th>
<th></th></tr></thead><tbody><tr><td><input class='filterinput form-control input-sm' name="smtp_id" size='3'></td><td><select class='filterselect form-control input-sm' name="smtp_country"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`country`) FROM `smtps` WHERE `sold` = '0' ORDER BY country ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
	}
?>
</select></td><td><select class='filterselect form-control input-sm' name="smtp_webmail"><option value="">ALL</option><option value="no">no</option><option value="yes">yes</option></select></td><td><input class='filterinput form-control input-sm' name="smtp_hosting" size='3'></td><td><select class='filterselect form-control input-sm' name="smtp_seller"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `smtps` WHERE `sold` = '0' ORDER BY resseller ASC");
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
		<label for="c_email">Checker Email </label> 
		<input type="text" name="c_email" id="c_email" class="form-control input-sm" value="<?php echo $ro['testemail']; ?>" required/><button type='submit' form="edit" class='btn btn-primary btn-xs'>Change <span class="glyphicon glyphicon-retweet"></span></button>
	</form>
  </div>
</div>


<table  class="table table-striped table-bordered table-condensed sticky-header" id="table">
<thead>
    <tr>
      <th scope="col" >ID</th>
      <th scope="col" >Country</th>
      <th scope="col">Detect Hosting</th>
      <th scope="col">Seller</th>
      <th scope="col">Send Test <span class="label label-default" id='checkertitle' >to <?php echo $ro['testemail']; ?></span></th>
      <th scope="col">Price</th>
      <th scope="col">Added on </th>

      <th scope="col">Buy</th>
    </tr>
</thead>
  <tbody>
 <?php
						   include("cr.php");
     $q = mysqli_query($dbcon, "SELECT * FROM smtps WHERE sold='0' ORDER BY RAND()")or die(mysql_error());

 while($row = mysqli_fetch_assoc($q)){
	 	 	 $countryfullname = $row['country'];
	  $code = array_search("$countryfullname", $countrycodes);
	 $countrycode = strtolower($code);
	 	     $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
     echo "
 <tr> 
     <td id='smtp_id'> ".htmlspecialchars($row['id'])." </td>
    <td id='smtp_country'><i class='flag-icon flag-icon-$countrycode'></i>&nbsp;".htmlspecialchars($row['country'])." </td>
    <td id='smtp_hosting'> ".htmlspecialchars($row['infos'])." </td>
    <td id='smtp_seller'> ".htmlspecialchars($SellerNick)."</td>
	";
			 echo '<td><span id="shop'.$row["id"].'" type="smtp"><a onclick="javascript:check('.$row["id"].');" class="btn btn-info btn-xs"><font color=white>Send</font></a></span></td>';
	echo"
    <td> ".htmlspecialchars($row['price'])."</td>
	    <td> ".htmlspecialchars($row['date'])."</td>";
    echo '
    <td>
<span id="smtp'.$row['id'].'" title="buy" type="smtp"><a onclick="javascript:buythistool('.$row['id'].')" class="btn btn-primary btn-xs"><font color=white>Buy</font></a></span><center>
    </td>
            </tr>
     ';
 }

 ?>

 </tbody>
 </table>
 
 
  
<script type="text/javascript">
$('#filterbutton').click(function () {$("#table tbody tr").each(function() {var ck1 = $.trim( $(this).find("#smtp_id").text().toLowerCase() );var ck2 = $.trim( $(this).find("#smtp_country").text().toLowerCase() );var ck3 = $.trim( $(this).find("#smtp_webmail").text().toLowerCase() );var ck4 = $.trim( $(this).find("#smtp_hosting").text().toLowerCase() );var ck5 = $.trim( $(this).find("#smtp_seller").text().toLowerCase() ); var val1 = $.trim( $('input[name="smtp_id"]').val().toLowerCase() );var val2 = $.trim( $('select[name="smtp_country"]').val().toLowerCase() );var val3 = $.trim( $('select[name="smtp_webmail"]').val().toLowerCase() );var val4 = $.trim( $('input[name="smtp_hosting"]').val().toLowerCase() );var val5 = $.trim( $('select[name="smtp_seller"]').val().toLowerCase() ); if(ck1.indexOf(val1)==-1 || (ck2 != val2 && val2 != '' ) || (ck3 != val3 && val3 != '' ) || ck4.indexOf(val4)==-1 || (ck5 != val5 && val5 != '' )){ $(this).hide();  }else{ $(this).show(); } });$('#filterbutton').prop('disabled', true);});$('.filterselect').change(function () {$('#filterbutton').prop('disabled', false);});$('.filterinput').keyup(function () {$('#filterbutton').prop('disabled', false);});

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
     url:"buytool.php?id="+id+"&t=smtps",
     dataType:"text",
     success:function(data){
         if(data.match(/<button/)){
		 $("#smtp"+id).html(data).show();
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
	url: 		'CheckSMTP'+id+'.html',
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

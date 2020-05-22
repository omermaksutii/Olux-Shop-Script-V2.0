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
</ul>
<div id="myTabContent" class="tab-content" >
  <div class="tab-pane active in" id="filter"><table class="table"><thead><tr><th>Country</th>
<th>Domain TLD</th>
<th>Server Information</th>
<th>Server OS</th>
<th>Detected Hosting</th>
<th>Seller</th>
<th></th></tr></thead><tbody><tr><td><select class='filterselect form-control input-sm' name="shell_country"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`country`) FROM `cpanels` WHERE `sold` = '0' ORDER BY country ASC");
	while($row = mysqli_fetch_assoc($query)){
	echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
	}
?>
</option></select></td><td><input class='filterinput form-control input-sm' name="shell_tld" size='3'></td><td><input class='filterinput form-control input-sm' name="shell_info" size='3'></td><td><select class='filterselect form-control input-sm' name="shell_os"><option value="">ALL</option><option value="Linux">Linux</option><option value="Windows">Windows</option></select></td><td><input class='filterinput form-control input-sm' name="shell_hosting" size='3'></td><td><select class='filterselect form-control input-sm' name="shell_seller"><option value="">ALL</option>
<?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `cpanels` WHERE `sold` = '0' ORDER BY resseller ASC");
	while($row = mysqli_fetch_assoc($query)){
		 $qer = mysqli_query($dbcon, "SELECT DISTINCT(`id`) FROM resseller WHERE username='".$row['resseller']."' ORDER BY id ASC")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
	echo '<option value="'.$SellerNick.'">'.$SellerNick.'</option>';
	}
?>
</select></td><td><button id='filterbutton'class="btn btn-primary btn-sm" disabled>Filter <span class="glyphicon glyphicon-filter"></span></button></td></tr></tbody></table></div>
</div>

<table width="100%"  class="table table-striped table-bordered table-condensed sticky-header" id="table">
<thead>
    <tr>
      <th scope="col" >Country</th>
      <th scope="col">TLD</th>
      <th scope="col">Server Information</th>
      <th scope="col">Detect Hosting</th>
      <th scope="col">Seller</th>
      <th scope="col">Check</th>
      <th scope="col">Price</th>
      <th scope="col">Added on </th>

      <th scope="col">Buy (Order)</th>
    </tr>
</thead>
  <tbody>
<?php
include("cr.php");
$q = mysqli_query($dbcon, "SELECT * FROM stufs WHERE sold='0' ORDER BY RAND()")or die(mysql_error());
while($row = mysqli_fetch_assoc($q)){
	 $countryfullname = $row['country'];
	 $code = array_search("$countryfullname", $countrycodes);
	 $countrycode = strtolower($code);
	 $tld = end(explode(".", parse_url($row['url'], PHP_URL_HOST))); 
	 $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		while($rpw = mysqli_fetch_assoc($qer))
			$SellerNick = "seller".$rpw["id"]."";
		if(empty($row['hostingdetec'])) { $hostingdetec = "N/A"; } else { $hostingdetec = $row['hostingdetec']; }
		if(empty($row['infos'])) { $hosting = "Not Available"; } else { $hosting = $row['infos']; }
    
	echo "<tr>     
    <td id='shell_country'> <i class='flag-icon flag-icon-$countrycode'> </i>&nbsp;".htmlspecialchars($row['country'])." </td>
	    <td id='shell_tld'> .".$tld." </td>
    <td id='shell_info'> ".htmlspecialchars($hosting)." </td>
    <td id='shell_hosting'> ".htmlspecialchars($hostingdetec)." </td>
    <td id='shell_seller'> ".$SellerNick."</td>"; echo '<td><span id="shop'.$row["id"].'" type="shell"><a onclick="javascript:check('.$row["id"].');" class="btn btn-info btn-xs"><font color="white">Check</font></a></span><center>';
  echo "</td><td> ".htmlspecialchars($row['price'])."</td>
	    <td> ".$row['date']."</td>";
    echo '
    <td>
	<span id="shell'.$row["id"].'" title="buy"  type="shell"><a onclick="javascript:buythistool('.$row['id'].')" class="btn btn-primary btn-xs"><font color="white">Buy</font></a></span><center>
    </td>
            </tr>
     ';
 }

 ?>

                    </tbody>
                      </table>
  

<script type="text/javascript">

$('#filterbutton').click(function () {$("#table tbody tr").each(function() {var ck1 = $.trim( $(this).find("#shell_country").text().toLowerCase() );var ck2 = $.trim( $(this).find("#shell_tld").text().toLowerCase() );var ck3 = $.trim( $(this).find("#shell_info").text().toLowerCase() );var ck4 = $.trim( $(this).find("#shell_os").text().toLowerCase() );var ck5 = $.trim( $(this).find("#shell_hosting").text().toLowerCase() );var ck6 = $.trim( $(this).find("#shell_seller").text().toLowerCase() ); var val1 = $.trim( $('select[name="shell_country"]').val().toLowerCase() );var val2 = $.trim( $('input[name="shell_tld"]').val().toLowerCase() );var val3 = $.trim( $('input[name="shell_info"]').val().toLowerCase() );var val4 = $.trim( $('select[name="shell_os"]').val().toLowerCase() );var val5 = $.trim( $('input[name="shell_hosting"]').val().toLowerCase() );var val6 = $.trim( $('select[name="shell_seller"]').val().toLowerCase() ); if((ck1 != val1 && val1 != '' ) || ck2.indexOf(val2)==-1 || ck3.indexOf(val3)==-1 || (ck4 != val4 && val4 != '' ) || ck5.indexOf(val5)==-1 || (ck6 != val6 && val6 != '' )){ $(this).hide();  }else{ $(this).show(); } });$('#filterbutton').prop('disabled', true);});$('.filterselect').change(function () {$('#filterbutton').prop('disabled', false);});$('.filterinput').keyup(function () {$('#filterbutton').prop('disabled', false);});
function buythistool(id){
  bootbox.confirm("Are you sure?", function(result) {
        if(result ==true){
      $.ajax({
     method:"GET",
     url:"buytool.php?id="+id+"&t=stufs",
     dataType:"text",
     success:function(data){
         if(data.match(/<button/)){
		 $("#shell"+id).html(data).show();
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
     if(xcheck > 2){
    bootbox.alert("<b>Wait</b> - Other checking operation is executed!");
  } else {
    xcheck++;
    var type = $("#shop"+id).attr('type')
	$("#shop"+id).html('Checking...').show();
	$.ajax({
	type: 		'GET',
	url: 		'CheckShell'+id+'.html',
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

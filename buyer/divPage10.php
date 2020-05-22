<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#filter" data-toggle="tab">Filter</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active in" id="filter">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tutorial Name</th>
                        <th>Description</th>
                        <th>Seller</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
  <td>
                            <input class='filterinput form-control input-sm' name="tuto_name" size='3'>
                        </td>
                        <td>
                            <input class='filterinput form-control input-sm' name="tuto_info" size='3'>
                        </td>
                        <td>
                            <select class='filterselect form-control input-sm' name="tuto_seller">
                                <option value="">ALL</option>
                                <?php
$query = mysqli_query($dbcon, "SELECT DISTINCT(`resseller`) FROM `tutorials` WHERE `sold` = '0' or `sold` = '1' ORDER BY resseller ASC");
	while($row = mysqli_fetch_assoc($query)){
		 $qer = mysqli_query($dbcon, "SELECT DISTINCT(`id`) FROM resseller WHERE username='".$row['resseller']."' ORDER BY id ASC")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
	echo '<option value="'.$SellerNick.'">'.$SellerNick.'</option>';
	}
?>
                            </select>
                        </td>
                        <td>
                            <button id='filterbutton' class="btn btn-primary btn-sm" disabled>Filter <span class="glyphicon glyphicon-filter"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <table width="100%" class="table table-striped table-bordered table-condensed sticky-header" id="table">
        <thead>
            <tr>
                <th scope="col">Tutorial Name</th>
                <th scope="col">Description</th>
                <th scope="col">Seller</th>
                <th scope="col">Price</th>
                <th scope="col">Added on </th>
                <th scope="col">Buy</th>
            </tr>
        </thead>
        <tbody>

            <?php
$q = mysqli_query($dbcon, "SELECT * FROM tutorials WHERE sold='0' or sold='1' ORDER BY RAND()")or die(mysqli_error());
 while($row = mysqli_fetch_assoc($q)){
	    $qer = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='".$row['resseller']."'")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer))
			 $SellerNick = "seller".$rpw["id"]."";
     echo "
 <tr>     
    <td id='tuto_name'> ".htmlspecialchars($row['tutoname'])." </td> 
	<td id='tuto_info'> ".htmlspecialchars($row['infos'])." </td>
    <td id='tuto_seller'> ".htmlspecialchars($SellerNick)."</td>
    <td> ".htmlspecialchars($row['price'])."</td>
	    <td> ".$row['date']."</td>";
    echo '
    <td>
	<span id="tuto'.$row['id'].'" title="buy" type="tuto"><a onclick="javascript:buythistool('.$row['id'].')" class="btn btn-primary btn-xs"><font color=white>Buy</font></a></span><center>
    </td>
            </tr>
     ';
 }

 ?>
                <script type="text/javascript">
                    $('#filterbutton').click(function() {
                        $("#table tbody tr").each(function() {
                            var ck1 = $.trim($(this).find("#tuto_name").text().toLowerCase());
                            var ck2 = $.trim($(this).find("#tuto_info").text().toLowerCase());
                            var ck3 = $.trim($(this).find("#tuto_seller").text().toLowerCase());
                            var val1 = $.trim($('input[name="tuto_name"]').val().toLowerCase());
                            var val2 = $.trim($('input[name="tuto_info"]').val().toLowerCase());
                            var val3 = $.trim($('select[name="tuto_seller"]').val().toLowerCase());
                            if ((ck1 != val1 && val1 != '') || ck2.indexOf(val2) == -1 || (ck3 != val3 && val3 != '')) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        });
                        $('#filterbutton').prop('disabled', true);
                    });
                    $('.filterselect').change(function() {
                        $('#filterbutton').prop('disabled', false);
                    });
                    $('.filterinput').keyup(function() {
                        $('#filterbutton').prop('disabled', false);
                    });

function buythistool(id){
  bootbox.confirm("Are you sure?", function(result) {
        if(result ==true){
      $.ajax({
     method:"GET",
     url:"buytuto.php?id="+id+"&t=tutorials",
     dataType:"text",
     success:function(data){
         if(data.match(/<button/)){
		 $("#tuto"+id).html(data).show();
         }else{
            bootbox.alert('<center><img src="files/img/balance.png"><h2><b>No enough balance !</b></h2><h4>Please refill your balance <a class="btn btn-primary btn-xs"  href="addBalance.html" onclick="window.open(this.href);return false;" >Add Balance <span class="glyphicon glyphicon-plus"></span></a></h4></center>')
         }
     },
   });
       ;}
  });
}

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

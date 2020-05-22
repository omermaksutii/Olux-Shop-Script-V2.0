    <style>
    .ticket {
    white-space: pre-wrap;
}
</style>
    <link rel="stylesheet" type="text/css" href="css/tickets.css">
<?php

include "header.php";


$id = $_GET['id'];
$myid = mysqli_real_escape_string($dbcon, $id);

$get = mysqli_query($dbcon, "SELECT * FROM ticket WHERE id='$myid'");
$row = mysqli_fetch_assoc($get);
?>
<div id="page-content-wrapper">
            <div class="container-fluid">
            <div id="divPage"><script>
$('html, body').scrollTop( $(document).height() );
</script>
<div class="form-group col-lg-5 ">

			<?php
			echo'			<h3>Ticket #'.$myid.'</h3>
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
<center> <a href="closeticket.php?id='.$myid.'" class="btn label-danger"><font color="white">Close</font></a></center>
'; }

 echo '
                    </div>
									  
           ';
 


  if(isset($_POST['add']) and $_POST['rep']){
  $lvisi = mysqli_real_escape_string($dbcon, $_POST['rep']);
  $st = $_POST['stat'];
//echo $lvisi."  -  ".$_POST['stat'];
   $msg     = '<div class="panel panel-default"><div class="panel-body"><div class="ticket"><b>'.htmlspecialchars($lvisi).'</b></div></div><div class="panel-footer"><div class="label label-warning">Support</div> - '.date("d/m/Y h:i:s a").'</div></div>';

$date = date("d/m/Y h:i:s a");

$qq = mysqli_query($dbcon, "UPDATE ticket SET memo = CONCAT(memo,'$msg'),status = '1',seen='1',lastreply='Support',lastup='$date' WHERE id='$myid'")or die("mysql error");

header("Refresh:0");
}

?>

</div></center>


            <div class="col-lg-7">
            <div class="bs-component">
              <div class="well well">
                <h5><b>Ticket Information</b></h5>
                  <table class="table">
                    <tbody><tr>
  <td>Title</td>
  <td><b></span> <?php echo $row['subject']; ?></b></td></tr><tr>
  <td>User</td>
  <td><b></span> <?php echo $row['uid']; ?></b></td></tr><tr>
   <td>Date</td>
  <td><b></span> <?php echo $row['date']; ?></b></td>
</tr>

                  </tbody></table>
              
          </div>         
</div></div></div>
            </div>
            </div>
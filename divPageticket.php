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
<style>
    .ticket {
    white-space: pre-wrap;
}
</style>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
             
               <link rel="stylesheet" href="assets/tickets.css">
<?php

if (isset($_GET['id'])) {
    
    $tid = mysqli_real_escape_string($dbcon, $_GET['id']);
    $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
    
    $s = mysqli_query($dbcon, "SELECT * FROM ticket WHERE id='$tid' AND uid='$uid'") or die();
    $r = mysqli_fetch_assoc($s);
    
    if (!empty($r)) {
        $st = $r['status'];
        switch ($st) {
            case "0":
                $st = "<font color='green'>Closed</font>";
                break;
            case "1":
                $st = "<font color='red'>Pending</font>";
                break;
            case "2":
                $st = "<font color='orange'>Replied</font>";
                break;
        }
        
        echo '
<div class="form-group col-lg-5 ">

<div class="row-fluid sortable ui-sortable">
				<div class="box span12">	
				<div class="card-body">

					<div class="box-header" data-original-title="">
						<h3 class="card-title">Title #' . htmlspecialchars($r['subject']) . '</h3>
					</div>
					<div class="box-content">';

        
        echo $r['memo'];
        


?>
<br>

<?php
$tid = mysqli_real_escape_string($dbcon, $_GET['id']);
$s   = mysqli_query($dbcon, "SELECT * FROM ticket WHERE id='$tid'");
$r   = mysqli_fetch_assoc($s);
if ($r['status'] == "0") {
?>
<div class="well well-sm">
  <strong>Closed Ticket</strong> <p>This ticket is closed and you can't reply to it </p>
</div>
<?php
} else {
?>
<form id="addReply">
<div class="input-group">
    <textarea class="form-control custom-control" rows="3" name="Reply" style="resize:none"></textarea>     
    <span class="input-group-addon btn btn-primary" onclick="$(this).closest('form').submit();">Reply</span>
</div>

<?php
}

?>

<center>

</form>
<?php
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$qqwq = mysqli_query($dbcon, "UPDATE ticket SET seen='0' WHERE id='$tid'") or die();
?>
                                    </tbody>
                                </table>
                            </div>
                            
                                    </div>
                            </div>
                            </div>

</div>          <br>
<div class="col-lg-7">
      <div class="bs-component">
        <div class="well well">
          <ul>
            <li>In order to refund ticket go to <b>Account</b> -&gt; <b>My Orders</b> and choose the tool and click on <b>Report</b> button</li>
            <li>Do not create double-tickets , create just one ticket and include all your problems then wait for your ticket to be replied</li>
          </ul>
        </div>
      </div>
    </div>
<?php
    } else {
echo "
<div id='mainDiv'><blockquote>
  <p>Ticket was not found or you don't have permission to access it </p>
  <small>Go to your <cite>Tickets</cite> to see all your available tickets </small>
</blockquote></div>
";
    }
    
} else {
echo "
<div id='mainDiv'><blockquote>
  <p>Ticket was not found or you don't have permission to access it </p>
  <small>Go to your <cite>Tickets</cite> to see all your available tickets </small>
</blockquote></div>
";
}
?>
<script>
g:xreply=0;
$("#addReply").submit(function() {
    if(xreply==1){return false;}else{xreply=1;}
    $.ajax({
           type: "POST",
           url: 'addReply<?php echo $tid; ?>.html',
           data: $("#addReply").serialize(), // serializes the form's elements.
           success: function(data)
           {
            if (data == 01) {
              alert('Please enter a valid Reply');
              xreply=0;
             }           
             if (data != 01) {
              pageDiv('ticket<?php echo $tid; ?>','Ticket #<?php echo $tid; ?> - Jerux SHOP','showTicket<?php echo $tid; ?>.html',1);

             }
           }
         });

    return false; // avoid to execute the actual submit of the form.
});
</script>
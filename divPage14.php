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
  <h2>Account Setting</h2>
<ul class="nav nav-tabs">
  <li class="active"><a href="#info" data-toggle="tab" aria-expanded="true" >Account Information</a></li>
  <li class=""><a href="#edit" data-toggle="tab" aria-expanded="false" >Edit Information</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="info">  
      <div class="well well-sm">
        <ul>
          <li>Your Username is <b><?php echo $ro['username']; ?></b></li>
          <li>Registered on <b><?php echo $ro['datereg']; ?></b></li>

          <li>Current balance is <b><?php echo $ro['balance']; ?>$</b></li>
          <li>Your Email is <b><?php echo $ro['email']; ?></b></li> 

        </ul>
      </div>
    </div>
    <div class="tab-pane fade" id="edit">

      <div class="container ">
        <form id='userEdit'>
          <h3>Edit Information</h3>
          <div class="row">
          <div class="form-group col-lg-3 "><label for="code">Current Password</label><input type="password" name="pp" id="pp" class="form-control input-normal" placeholder="Required" required/></div>
          </div>
          <div class="row">
          <div class="form-group col-lg-3 "><label for="code">New Password</label><input type="password" name="n_pp" id="n_pp" class="form-control input-normal" placeholder="Required" required/></div>
          </div>
    <div class="row">
          <div class="form-group col-lg-3 "><label for="code">Confirm Password</label><input type="password" name="n_pp2" id="n_pp2" class="form-control input-normal" placeholder="Required" required/></div>
          </div>
          <button type='submit' name='submit' class='btn btn-primary btn-md'>Change  <span class="glyphicon glyphicon-indent-left"></span></button>

          </form><br><br>
          <div id="respone" class="form-group col-lg-9" id="respone"></div>
      </div>



    </div>
</div>
<script type="text/javascript">
$("#userEdit").submit(function() {
    $('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'settingEdit.html',
           data: $("#userEdit").serialize(),
           success: function(data)
           {
            $('button').prop('disabled', false);
            $("#respone").html(data).show();
         }
         });

    return false; // avoid to execute the actual submit of the form.
});
</script>
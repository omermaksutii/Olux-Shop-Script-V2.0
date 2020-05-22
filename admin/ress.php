<?php

error_reporting(0);
include "header.php";
$id = mysqli_real_escape_string($dbcon, $_GET['id']);
$q = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$id' ");
$r = mysqli_fetch_assoc($q);


// user not found


global $r;
?>

  <ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
</ul>

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      <form id="tab" method="post">
        <div class="form-group">
        <label>Username</label>
        <input type="text" value="<?php echo $r['username'];?>" class="form-control" name="user" disabled>
        </div>
        <div class="form-group">
        <label>sold balance</label>
        <input type="text" value="<?php echo $r['soldb'];?>" class="form-control" name="soldb">
        </div>
        <div class="form-group">
        <label>unsold Balance</label>
        <input type="text" value="<?php echo $r['unsoldb'];?>" class="form-control" name="unsoldb">
        </div>
        <div class="form-group">
        <label>items sold</label>
        <input type="text" value="<?php echo $r['isold'];?>" class="form-control" name="isold">
        </div>
        <div class="form-group">
        <label>items unsold</label>
        <input type="text" value="<?php echo $r['iunsold'];?>" class="form-control" name="iunsold">
        </div>
        <div class="form-group">
        <label>bitcoin address</label>
        <input type="text" value="<?php echo $r['btc'];?>" class="form-control" name="btc" disabled>
        </div>
        <input type="submit" class="btn btn-primary" name="op" value="Save" />
        <input type="submit" class="btn btn-danger" name="op" value="Delete" />
        <input type="reset" value='Reset' class="btn btn-reset"/>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
$user = $_POST['user'];
$sold = $_POST['soldb'];
$usol = $_POST['unsoldb'];
$isol = $_POST['isold'];
$iuns = $_POST['iunsold'];
$ubtc = mysqli_real_escape_string($dbcon, $_GET['id']);

if($_POST['op'] and $_POST['op'] == "Save"){
   $qq = mysqli_query($dbcon, "UPDATE resseller SET soldb='$sold',unsoldb='$usol',isold='$isol',iunsold='$iuns' WHERE username='$id'");
   if($qq){
     echo "<b><font color='green'>Editing Done !!</font></b>";
   }else{
    echo "<b><font color='red'>Editing Error !!</font></b>";
   }
}else if($_POST['op'] and $_POST['op'] == "Delete"){
   $qq = mysqli_query($dbcon, "DELETE FROM resseller WHERE username='$id'");
   $qq2 = mysqli_query($dbcon, "UPDATE users SET resseller='0' WHERE username='$id'");
   if($qq and $qq2){
     echo "<b><font color='green'>User Deleted !!</font></b>";
   }else{
    echo "<b><font color='red'>User not Deleted !!</font></b>";
   }
}

?>
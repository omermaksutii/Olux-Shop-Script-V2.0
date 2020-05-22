<?php
error_reporting(0);
include "header.php";

$id = mysqli_real_escape_string($dbcon, $_GET['id']);
$q = mysqli_query($dbcon, "SELECT * FROM users WHERE id='$id' ");
$r = mysqli_fetch_assoc($q);


// user not found


global $r;
?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Profile</b></div>


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      <form id="tab" method="post">
        <div class="form-group">
        <label>Username</label>
        <input type="text" value="<?php echo $r['username'];?>" class="form-control" name="user">
        </div>
        <div class="form-group">
        <label>Email</label>
        <input type="text" value="<?php echo $r['email'];?>" class="form-control" name="email">
        </div>
        <div class="form-group">
        <label>Balance</label>
        <input type="text" value="<?php echo $r['balance'];?>" class="form-control" name="balance">
        </div>
        <div class="form-group">
        <label>ip</label>
        <input type="text" value="<?php echo $r['ip'];?>" class="form-control" name="ip">
        </div>
        <div class="form-group">
        <label>Date of Registartion</label>
        <input type="text" value="<?php echo $r['datereg'];?>" class="form-control" name="dor">
        </div>
        <input type="submit" class="btn btn-primary" name="op" value="Save" />
        <input type="submit" class="btn btn-danger" name="op" value="Delete" />
        <input type="reset" value="Reset" class="btn btn-reset"/>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
//error_reporting(0);
$user = $_POST['user'];
$emal = $_POST['email'];
$balc = $_POST['balance'];
$ip = $_POST['ip'];
$id = mysqli_real_escape_string($dbcon, $_GET['id']);

if($_POST['op'] and $_POST['op'] == "Save"){
   $qq = mysqli_query($dbcon, "UPDATE users SET username='$user',email='$emal',balance='$balc' WHERE id='$id'");
   if($qq){
     echo "<b><font color='green'>Editing Done !!</font></b>";
   }else{
    echo "<b><font color='red'>Editing Error !!</font></b>";
   }
}else if($_POST['op'] and $_POST['op'] == "Delete"){
   $qq = mysqli_query($dbcon, "DELETE FROM users WHERE id='$id'");
   
   if($qq){
     echo "<b><font color='green'>User Deleted !!</font></b>";
   }else{
    echo "<b><font color='red'>User not Deleted !!</font></b>";
   }
}

?>
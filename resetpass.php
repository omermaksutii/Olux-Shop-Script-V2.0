<?php

  ob_start();
  session_start();
  include "includes/config.php";
  date_default_timezone_set('UTC');


  if(isset($_SESSION['sname']) and isset($_SESSION['spass'])){
   header("location: buyer/");
   exit();
}
?>
<?php
$pincode = $_GET['code'];
$user = $_GET['user'];

 $finder = mysqli_query($dbcon, "
  SELECT * FROM users WHERE username='$user' ") or die("mysql error");
    if(mysqli_num_rows($finder) != 0){
    $row = mysqli_fetch_assoc($finder);
    if(($pincode == $row['resetpin'])){
   ?>
<!doctype html>
<html>
<link rel="stylesheet" type="text/css" href="buyer/assets/bootstrap.css" />
<script type="text/javascript" src="buyer/assets/jquery.js"></script>
<script type="text/javascript" src="buyer/assets/bootstrap.js"></script>

<link rel="shortcut icon" href="img/favicon.ico" />
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>JERUX SHOP - Password Reset</title>
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto:400);
html, body {
    background: url(img/bg.png);
}

.container {
    padding: 25px;
    position: fixed;
}

.form-login {
    background-color: #EDEDED;
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
}

h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}
h6 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:5px;
 text-align: center;
}
.form-control {
    border-radius: 10px;
}

.wrapper {
    text-align: center;
}


</style>

</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login" id="logindiv">
            	<h4> <b><span class='glyphicon glyphicon-fire'></span> JERUX SHOP - Forget</b> </h4>
<div id='errorbox'>
	</div>
<form method='post'>
    <input type='password' id='new_p' name='new_p' class='form-control input-sm chat-input' placeholder='New Password' required/>

    <br>
    <div class='wrapper'>
                                <button type='submit' name="do" id='divButton' class='btn btn-primary btn-md'>Reset <span class='glyphicon glyphicon-log-in'></span></button>


    </div>
</form>
 </div>

        </div>
    </div>                    

</div>
</body>
</html>

<?php

  if(isset($_POST['do'])){
     

  $newpass = mysqli_real_escape_string($dbcon, strip_tags($_POST['new_p']));
 $passstrlen = strlen($newpass);
  if($passstrlen <5 or $passstrlen > 16){
   echo '<script>swal("Failed", "Password must be more than 6 and less than 16" , "error");</script>';
   echo '<meta http-equiv="refresh" content="1">';
  } else {
$salt = 'fs978'; // SALT for encrypting
     $newpassword = md5($newpass . $salt);
     $lvisi = $newpassword;
     $qqz = mysqli_query($dbcon, "UPDATE users SET resetpin='token-removed-expired' WHERE username='$user'")or die("mysql error");
     $qq = mysqli_query($dbcon, "UPDATE users SET password='$lvisi' WHERE username='$user'")or die("mysql error");
     if($qq){
       $ko = mysqli_query($dbcon, "UPDATE umanager SET online='0',tpwchanges=(tpwchanges + 1) WHERE username='$user'")or die("error up");
   echo '<script>swal("Done", "Password changed" , "success");</script>';

   echo ' <meta http-equiv="refresh" content="1;URL=index.html" />';
         
     } } }
  ?>
  <?php
 } else { 
        echo  "Invalid token";
    }  }  else { 
                echo  "Invalid token";

        
    } 
?>
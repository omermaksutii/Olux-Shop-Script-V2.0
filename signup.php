<?php
  ob_start();
  session_start();
  include "includes/config.php";
  date_default_timezone_set('UTC');


  if(isset($_SESSION['sname']) and isset($_SESSION['spass'])){
   header("location: index.html");
   exit();
}
?>
<!doctype html>
<html>
<link rel="stylesheet" type="text/css" href="files/bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="files/js/jquery.js"></script>
<script type="text/javascript" src="files/bootstrap/3/js/bootstrap.js"></script>
<link rel="stylesheet" href="files/css/login.css">

<link rel="shortcut icon" href="img/favicon.ico" />
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Felux - Shop Register</title>
<!-- <style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400);
html, body {
    background: url(files/img/bg.png);
}

.container {
    width:70%;
    margin:50px auto;
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


</style> -->

</head>
<body>
<!-- <script type="text/javascript">
$(window).on('load', function() {
    logindiv(2,'Signup - Jerux SHOP','signup.html',1);
});</script> -->
<!--Pulling Awesome Font -->

<div class="container">                  
<div class="row">
<form class="login" method="post" action="signupform.html">
            <h4> <b><span class="glyphicon glyphicon-fire"></span> FELUX SHOP - Register</b> </h4>
            <?php
                if(isset($_GET['error']) AND !empty($_GET['error'])) {
                    $error = $_GET['error'];

                    if ($error == "userexist") {
                        echo $errorbox = "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><p>Username already exists!</p></div>";
                    }

                    if ($error == "emailexist") {
                        echo $errorbox = "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><p>Email already exists!</p></div>";
                    }

                    if ($error == "passnotmatch") {
                        echo $errorbox = "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><p>Passwords do not match!</p></div>";
                    }

                    if ($error == "passlength") {
                        echo $errorbox = "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><p>Password must be more than 6 and less than 16.</p></div>";;
                    }
                }

                ?>
            <input type="text" name="username" placeholder="Username" required="">
            <input type="password" name="password_signup" placeholder="Password" required="">
            <input type="password" name="password_signup2" placeholder="Confirm Password" required="">
            <input type="email" name="email" placeholder="Email" required="">
            <button type="submit" id="divButton">Register</button> 
            <button type="button" class="register" onclick="window.location.href = 'login.html'">Login</button>
            </form>
       



    </div>
</div>
</body>
</html>


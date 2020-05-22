<?php
session_start();
ob_start();

date_default_timezone_set('UTC');


include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: login.html");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <font face="Arial">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Main - Support Panel</title>
<link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../buyer/assets/flags.css">
    <link rel="stylesheet" type="text/css" href="css/tickets.css">
<script type="text/javascript" src="./assets/jquery.js"></script>
<script type="text/javascript" src="./assets/bootstrap.js"></script>
<script type="text/javascript" src="./assets/bootbox.min.js"></script>
<script type="text/javascript" src="./assets/sorttable.js"></script>

    <link href="./assets/style.css" rel="stylesheet">
	
<style>

.alert.alert-shadowed {
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
    box-shadow: 0 1px 2px rgba(0,0,0,.2);
}


.alert {
    margin-bottom: 20px;
    margin-top: 0;
    color: #fff;
    border-width: 0;
    border-left-width: 5px;
    padding: 10px;
    border-radius: 0;
}

.alert.alert-danger {
    border-color: #df5138;
    background: #001f3f;
}

.teddy-text {
  background: #f2f1ef;
  padding: 1.2em 1em;
  border-radius: 5px 5px 0px 0px;
}   

.teddy-follow {
  background: #17C0FB;
  padding: 0.7em 0em 0.7em 0em;
}
.teddy-followred {
  background: #D41010;
  padding: 0.7em 0em 0.7em 0em;
}
</style>
<style>
.content {
	display:none;
}

</style>
    <style>
.sort {
  .sortable
}
.sort th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { 
    content: " \25BE" 
}
</style>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <div class="navbar-brand" onclick="location.href='index.html'" onmouseover="this.style.cursor='pointer'"><b> JeruxSHOP <small><span class="glyphicon glyphicon-refresh"></span></small></b></div>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="topFixedNavbar1">
         
                    <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown"><a href="./index.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account  <span class="glyphicon glyphicon-user"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="./account.html">Settings<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                                    <li class="divider"></li>
                                    <li><a href="./Logout.html">Logout <span class="glyphicon glyphicon-off pull-right"></span></a></li>
                                </ul>
                            </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    <div id="wrapper">
    <div id="sidebar-wrapper">
                     <ul class="sidebar-nav">

                <li class="sidebar-brand"><a href="./index.php"><div class="navbar-brand" onclick="location.href=&#39;index.html&#39;"><font color="white"><b><span class="glyphicon glyphicon-fire"></span> Support Panel</b></font></div></a></li>
                <li><a href="https://jerux.to" onclick="window.open(this.href);return false;"><font color="white">Back to Jerux SHOP <span class="glyphicon glyphicon-share-alt"></span></font></a></li>

                <li><font color="white"><b><span class="glyphicon glyphicon-dashboard"></span> Support Dashboard</b></font></li>
                    <li><a href="./index.html" style="cursor: pointer;"><span class="glyphicon glyphicon-home"></span> Main</a></li>
                    <li><a href="./News.html" style="cursor: pointer;"><span class="glyphicon glyphicon-plus"></span> Add News</a></li>
                    <li><a href="./Tickets.html" style="cursor: pointer;"><span class="glyphicon glyphicon-time"></span> Pending Tickets <span id="menu_tickets"><span class="label label-danger"><?php $s12 = mysqli_query($dbcon, "SELECT * FROM ticket where status='1' OR status='2'");$r11=mysqli_num_rows($s12);
 echo $r11;?></span></span></a></li>
                    <li><a href="./Reports.html" style="cursor: pointer;"><span class="glyphicon glyphicon-time"></span> Pending Reports <span id="menu_tickets"><span class="label label-danger"><?php $s12 = mysqli_query($dbcon, "SELECT * FROM reports where status='1' OR status='2'");$r11=mysqli_num_rows($s12);
 echo $r11;?></span></span></a></li>                
				<li><a href="./Users.html"><span class="glyphicon glyphicon-user"></span> Users List <span class="label label-info"><?php $s12 = mysqli_query($dbcon, "SELECT * FROM users");$r11=mysqli_num_rows($s12);
 echo $r11;?></span></a></li>
                    <li> <a href="./Logout.html"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					
            </ul>


        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <b><span id="menu-toggle" onmouseover="this.style.cursor=&#39;pointer&#39;"><span class="glyphicon glyphicon-indent-right"></span></span></b>
        <div id="page-content-wrapper">
            <div class="container-fluid">
            <div id="divPage">

    <script>
    var v_aa =0;
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        if (v_aa == 1) {
          $("#menu-toggle").html('<span class="glyphicon glyphicon-indent-right"></span>').show();
          v_aa =0;
        }
        else {
          $("#menu-toggle").html('<span class="glyphicon glyphicon-indent-left"></span>').show();
          v_aa =1;     
        }
        
    });

    </script>
    <script>
	$(function() {
		$(".preload").fadeOut(500, function() {
			$(".content").fadeIn(0);
		});
	});
</script> 
     <div class="preload">
<div id="mydiv"><img src="assets/wait.gif" class="ajax-loader"></div>  

  </div>
 	<div class="content">
<br><br>
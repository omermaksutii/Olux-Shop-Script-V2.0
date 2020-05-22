<?php


include "../includes/config.php";
include "header.php";
?>

	<?php
  $date = date("m-d-y");
  $qt = mysqli_query($dbcon, "SELECT * FROM users");
  $qtf = mysqli_num_rows($qt);
    $qtc = mysqli_query($dbcon, "SELECT * FROM ticket WHERE status='1' or status='2'");
  $qtfc = mysqli_num_rows($qtc);
    $qtcz = mysqli_query($dbcon, "SELECT * FROM reports WHERE status='1' or status='2'");
  $qtfec = mysqli_num_rows($qtcz);
     $qtczb = mysqli_query($dbcon, "SELECT * FROM resseller");
  $qtfec8 = mysqli_num_rows($qtczb);
?>	
<div class="alert alert-danger fade in radius-bordered alert-shadowed"> <i class="fa-fw fa fa-times"></i> <b>Jerux Shop</b></div>
<div class="form-group col-lg-3">
		<div class="teddy-text">
<center>	<b><font size="4" color="17C0FB">
<span class="glyphicon glyphicon-time" style="font-size: 55px;"></span><br><h3><?php echo $qtfc;?></h3>
</font> </CENTER></b>
					</div>
			    <div class="teddy-follow">
<center>	<b><font size="4" color="white">Pending Tickets</font> </CENTER></b>
			    </div>

</div>
<div class="form-group col-lg-3">
		<div class="teddy-text">
<center>	<b><font size="4" color="17C0FB">
<span class="glyphicon glyphicon-time" style="font-size: 55px;"></span><br><h3><?php echo $qtfec; ?></h3>
</font> </CENTER></b>
					</div>
			    <div class="teddy-follow">
<center>	<b><font size="4" color="white">Pending Reports</font> </CENTER></b>
			    </div>

</div>
<div class="form-group col-lg-3">
		<div class="teddy-text">
<center>	<b><font size="4" color="D41010">
<span class="glyphicon glyphicon-user" style="font-size: 55px;"></span><br><h3><?php echo $qtf;?>+</h3>
</font> </CENTER></b>
					</div>
			    <div class="teddy-followred">
<center>	<b><font size="4" color="white">Users</font> </CENTER></b>
			    </div>

</div>
<div class="form-group col-lg-3">
		<div class="teddy-text">
<center>	<b><font size="4" color="D41010">
<span class="glyphicon glyphicon-fire" style="font-size: 55px;"></span><br><h3><?php echo $qtfec8; ?></h3>
</font> </CENTER></b>
					</div>
			    <div class="teddy-followred">
<center>	<b><font size="4" color="white">Sellers</font> </CENTER></b>
			    </div>

</div>
<br>
<div class="form-group col-lg-8">
<h4>Last Tickets </h4>
<?php
  $q = mysqli_query($dbcon, "SELECT * FROM ticket order by id desc Limit 5")or die("error");

    echo '
     <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User</th>
                  <th>Title</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>';
              while($row = mysqli_fetch_assoc($q)){
                $st = $row['status'];

    switch ($st){
      case "0" :
       $st = "closed";
       break;
      case "1" :
       $st = "pending";
       break;
      case "2":
       $st = "pending";
       break;
    }
		if (empty($row['lastup'])) {
		$lastup = "n/a"; 
		} else { 
		$lastup = $row['lastup']; 	
		}
              echo '<tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['uid'].'</td>
                  <td>'.$row['subject'].'</td>
				  <td>'.$row['date'].'</td>
                  <td><a class="btn btn-primary btn-xs" href="viewt.php?id='.$row['id'].'">View</a></td>
                  </tr>';
                  }
                  echo '

              </tbody>
            </table>
      ';
    ?>
</div>
<div class="form-group col-lg-4">
<h4>Last Users </h4>
<?php
  $q = mysqli_query($dbcon, "SELECT * FROM users order by id desc Limit 5")or die("error");

    echo '
     <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>';
              while($row = mysqli_fetch_assoc($q)){
              echo '<tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['username'].'</td>
                  <td>'.$row['datereg'].'</td>
                  </tr>';
                  }
                  echo '

              </tbody>
            </table>
      ';
    ?>
</div>
</div>
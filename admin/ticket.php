<?php

  include "header.php";
  $q = mysqli_query($dbcon, "SELECT * FROM ticket where status='1' or  status='2' ORDER BY status DESC")or die("error");
  $t = mysqli_num_rows($q);
  global $t,$q;

?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Tickets</b></div>

<ul class="nav nav-tabs">
    <li class="active"><a href="#mytickets" data-toggle="tab" aria-expanded="true">Pending Tickets</a></li>
    <li class=""><a href="#open" data-toggle="tab" aria-expanded="false"> <span class="glyphicon glyphicon-plus"></span> Insert Ticket</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in" id="open"> 
<div class="col-md-5">

<form method="post"><br>
		Title : <td><input placeholder="subject" type="text" name="subject" class="form-control input-sm" required=""></td><br>
		User : <td><input placeholder="username" type="text" name="user" class="form-control input-sm" required=""></td><br>
	<button type="submit" name="submit" class="btn btn-primary btn-md">Add  <span class="glyphicon glyphicon-plus"></span></button>
<input type="hidden" name="start" value="work" />
</form>
</div>
<?php
$subject = $_POST["subject"];
$user = $_POST["user"];
 $stid = mysqli_real_escape_string($dbcon, $row['s_id']);
  $date = date("Y/m/d h:i:s");
  $memo = mysqli_real_escape_string($dbcon, $message);
  $subj = mysqli_real_escape_string($dbcon, $subject);
    if(isset($_POST['start']) and $_POST['start'] == "work"){

  $que = mysqli_query($dbcon, "
INSERT INTO `ticket`
(`uid`, `status`, `s_id`, `s_url`, `memo`, `acctype`, `admin_r`, `date`, `subject`, `type`, `resseller`, `price`, `refunded`, `fmemo`, `seen`, `lastreply`, `lastup`)
 VALUES
('$user', '1', '1', '1', '', '1','0', '$date', '$subject', 'refunding', '1', '1', 'Not Yet !', '', '1', 'Admin','$date');
  ")or die(mysqli_error());

  if($que){
    echo '<div class="alert alert-success" role="alert">Ticket Added!</div><br>';
  }else{
   echo '<div class="alert alert-danger" role="alert">Error!</div><br>';
	}  }
?>
</div>	
    <div class="tab-pane fade active in" id="mytickets"> 
    <?php
    echo '
    <div class="">
    <center>
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">Tickets <span class="label label-primary">Total Pending : '.$t.'</span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
			      <th></th>
                  <th>ID</th>
                  <th>User</th>
                  <th>Date Created</th>
                  <th>Title</th>
                  <th>Ticket State</th>
                  <th>Last Reply</th>
                  <th>Last Updated</th>
                  <th>View Ticket</th>
                </tr>
              </thead>
              <tbody>';
              while($row = mysqli_fetch_assoc($q)){
                $st = $row['status'];
	if (empty($row['lastup'])) {
		$lastup = "n/a"; 
		} else { 
		$lastup = $row['lastup']; 	
		}
    switch ($st){
      case "0" :
       $st = "closed";
       break;
      case "1" :
       $st = "open";
       break;
      case "2":
       $st = "open";
       break;
    }
              echo '<tr>
                  <td></td>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['uid'].'</td>
				  <td>'.$row['date'].'</td>
                  <td>'.$row['subject'].'</td>
				  <td>'.$st.'</td>
                  <td>'.$row['lastreply'].'</td>
                  <td>'.$lastup.'</td>
                  <td><a calass="btn btn-primary" href="viewt.php?id='.$row['id'].'"><span class="glyphicon glyphicon-eye-open"> </span></a></td>
                  </tr>';
                  }
                  echo '

              </tbody>
            </table>
        </div>
    </div>';
    ?>

 </div>
 </div>

<?php
error_reporting(0);
include "header.php";

echo "<h5><center>
<a href='Users.html' class='btn label-primary'><font color='white'>All users</font></a>
<a href='UsersBalance.html' class='btn label-primary'><font color='white'>Users with balance</font></a>
<a href='SearchUser.html' class='btn label-primary'><font color='white'>Search for user</font></a>

</center></h5>";

echo '
<center>
<form action="" method="POST">
name of user <br>
<input type="text" class="form-control" name="user" style="width : 280px;" /><br> <br>
<input type="submit" class="btn btn-primary" value="Search" />
<input type="hidden" name="start" value="s" />
</form>
</center>
';

if(isset($_POST['start']) and $_POST['start'] == "s"){
  $user = mysqli_real_escape_string($dbcon, $_POST['user']);
  $query = mysqli_query($dbcon, "SELECT * FROM users WHERE username='$user'");
  echo '<br>
    <div class="">
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">Search Results<span class="label label-warning">'.$t.'</span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Balance</th>
                  <th>items purch</th>
                  <th>Last login</th>
                  <th>Resseller</th>
                </tr>
              </thead>
              <tbody>';
  while($row = mysqli_fetch_assoc($query)){
              echo '<tr>
                  <td>'.$row['username'].'</td>
                  <td>'.$row['email'].'</td>
                  <td>'.$row['balance'].'</td>
                  <td>'.$row['ipurchassed'].'</td>
                  <td>'.$row['lastlogin'].'</td>
             <td>';

      if($row['resseller'] == "0" or empty($row['resseller'])){
          echo '<a href="activer.php?id='.$row['id'].'" class="btn label-primary"><font color=white>Make resseller</font></a>';
      }else{
          echo 'Yes';
      }

                  echo '</td></tr>';
  }
                  echo '

              </tbody>
            </table>
        </div>
    </div>';

}

?>
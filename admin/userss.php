<?php

include "header.php";
?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Search for user</b></div>

<?php

echo '
<center>
<form action="" method="POST">
username : <input type="text" class="form-control" name="user" style="width : 280px;" /><br> 
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
                  <th>Edit</th>
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
                  <td>
          <a href="user.php?id='.$row['id'].'"><center><span class="btn label-danger"><font color=white>Edit/Delete</font></center></span></a>
      </td><td>';

      if($row['resseller'] == "0" or empty($row['resseller'])){
          echo '<a href="activer.php?id='.$row['id'].'" class="btn label-primary"><font color=white>Make resseller</font></a>';
      }else{
          echo '<a href="remover.php?id='.$row['id'].'" class="btn label-warning"><font color=white>Ban</font></a>';
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
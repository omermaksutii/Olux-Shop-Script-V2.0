<?php




include "header.php";

echo "<h5><center>
<a href='Users.html' class='btn label-primary'><font color='white'>All users</font></a>
<a href='UsersBalance.html' class='btn label-primary'><font color='white'>Users with balance</font></a>
<a href='SearchUser.html' class='btn label-primary'><font color='white'>Search for user</font></a>

</center></h5>";


  $q = mysqli_query($dbcon, "SELECT * FROM users  WHERE balance !='0'")or die("error");
  $t = mysqli_num_rows($q);
  global $t,$q;

if(!isset($_GET['page'])){
  $page = 1;
  $ka = $page;
}else{
  $page = intval($_GET['page']);
  $ka = $page;
}
$qq = mysqli_query($dbcon, "SELECT * FROM users WHERE balance !='0'")or die("error");
$record_at_page = 20;
//$q=mysqli_query($dbcon, "SELECT * FROM stufs");
$record_count = mysqli_num_rows($qq);
//echo $record_count."<br>";
@mysqli_free_result($qq);

$pages_count = (int)ceil($record_count / $record_at_page);
if($page > $pages_count || $page = 0){
    //mysql_close($dbconnect);
    //die("no more pages");
}else{
  $start = ($ka - 1) * $record_at_page ;
  $end = $record_at_page ;
}

if($record_count != 0){
  $qq = mysqli_query($dbcon, "SELECT * FROM users WHERE balance !='0' ORDER BY balance desc LIMIT $start,$end")or die("error");
echo '
    <div class="">
        <div class="panel panel-default">
            <div class="panel-heading no-collapse"><center>Users with balance <span class="label label-warning">'.$t.'</span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Balance</th>
                  <th>items purch</th>
                  <th>Last login</th>
                  <th>Edite</th>
                </tr>
              </thead>
              <tbody>';
  while($row = mysqli_fetch_assoc($qq)){
              echo '<tr>
                  <td>'.$row['username'].'</td>
                  <td>'.$row['email'].'</td>
                  <td>'.$row['balance'].'</td>
                  <td>'.$row['ipurchassed'].'</td>
                  <td>'.$row['lastlogin'].'</td>
                  <td>
          <a href="user.php?id='.$row['id'].'"><center><span class="btn label-danger"><font color="white">Edit/Delete</font></center></span></a>
      </td>
                  </tr>';
  }
                  echo '

              </tbody>
            </table>
        </div>
    </div>';

}
?>
<center>
<nav>
  <ul class="pagination">
    <?php
      for($i=1;$i<=$pages_count;$i++){

  if($page == $i){
     echo $page;
  }else{
    echo '<li><a href="usersb.php?page='.$i.'">'.$i.'</a></li>';
  }
}
ob_end_flush();
mysqli_close();

    ?>

</ul>
</nav>
</center>



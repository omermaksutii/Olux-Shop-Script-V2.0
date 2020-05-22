<?php

include "header.php";

$q = mysqli_query($dbcon, "SELECT * FROM resseller");
?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Sellers</b></div>

<?php
echo "
<center>
 <table class='table table-bordered table-striped'>
  <tr>
  <td>Username</td>
  <td>Whole Sales</td>
  <td>Current Sales</td>
  <td>BTC Address</td>
  <td></td>
  </tr>
";
while ($ro = mysqli_fetch_assoc($q)){

$ti = $ro['soldb'] + $ro['unsoldb'];
$it = $ro['isold'] + $ro['iunsold'];
echo "
  <tr>
  <td> ".$ro['username']." (seller".$ro['id'].")</td>
  <td>$ ".$ro['allsales']."</td>
  <td>$ ".$ro['soldb']."</td><td>";
  if(empty($ro['btc'])) { echo "N/A"; } else { echo $ro['btc'];  }
echo "</td><td>";

    echo '<a href="ress.php?id='.$ro['username'].'"><img src="../seller/img/edit.png" width="20px" hiegh="20px"></a>&nbsp;&nbsp;';

echo "</td></tr>

  ";
}
echo "</table> ";
?>
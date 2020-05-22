<?php

include "header.php";

$q = mysql_query("SELECT * FROM news");
echo "<table  class='table table-bordered table-striped'>
<tr>
<td>Date</td>
<td>Title</td>
<td>Content</td>
<td>Option</td>
</tr>
";
while($r = mysql_fetch_assoc($q)){
echo '
<tr>
<td>'.$r['date'].'</td>
<td>'.$r['title'].'</td>
<td>'.strip_tags(substr($r['content'],0,35)).'</td>
<td></td>
</tr>
';
}
echo '</tabel>'

?>
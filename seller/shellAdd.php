<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if (!isset($_SESSION['sname']) and !isset($_SESSION['spass'])) {
    header("location: ../");
    exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$uid   = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
?>
<?php
@preg_match_all("/(\n)/", $_POST['text'], $matches);
$total_lines = count($matches[0]) + 1;
if ($total_lines > 30) {
    echo "limit reached";
} else {
    function ambilKata($param, $kata1, $kata2)
    {
        if (strpos($param, $kata1) === FALSE)
            return FALSE;
        if (strpos($param, $kata2) === FALSE)
            return FALSE;
        $start  = strpos($param, $kata1) + strlen($kata1);
        $end    = strpos($param, $kata2, $start);
        $return = substr($param, $start, $end - $start);
        return $return;
    }
    
    $date  = date('Y/m/d h:i:s');
    $uid   = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
    $site  = $_POST['shell_host'];
    $price = $_POST['price'];
    $k     = $site;
    $qq = @mysqli_query($dbcon, "SELECT * FROM stufs") or die("error here");
    
    // Attempt insert query execution

    if (isset($_POST['start']) and $_POST['start'] == "work") {

        if ($price == 0) {
            echo "Price is not valid !";
        } else if (preg_match('/[^0-9]/', $price)) {
            
            $o = parse_url($k, PHP_URL_HOST);
            
            echo "Price is not valid!";
        } else {

            $hosting = file_get_contents($k);
            if (preg_match('#Client IP:#', $hosting)) {

                $o     = parse_url($k, PHP_URL_HOST);
                $check = "SELECT * FROM stufs WHERE domain = '$o'";
                $rs    = mysqli_query($dbcon, $check);
                $data  = mysqli_fetch_array($rs, MYSQLI_NUM);

                if ($data[0] > 1) {
                    while ($row = mysqli_fetch_assoc($qq)) {
                        $st = $row['url'];
                        $o  = parse_url($k, PHP_URL_HOST);
                    }
                    
                    echo "Already Added !";
                    
                } else if (preg_match('#Client IP:#', $hosting)) {
                    $hosting = file_get_contents($k);
                    $o       = parse_url($k, PHP_URL_HOST);
                    $check   = "SELECT * FROM stufs WHERE domain = '$o'";
                    $rs      = mysqli_query($dbcon, $check);
                    $data    = mysqli_fetch_array($rs, MYSQLI_NUM);
                    if ($data[0] > 1) {
                        while ($row = mysqli_fetch_assoc($qq)) {
                            $st = $row['url'];
                            $o  = parse_url($k, PHP_URL_HOST);
                        }
                        
                        echo "Already Added !";
                    } else {
                        $o   = parse_url($k, PHP_URL_HOST);
                        $oip = gethostbyname($o);
                        
                        $iptohosting     = "https://api.ipgeolocation.io/ipgeo?apiKey=b4692370f68e4c398039408226e6f99f&ip=$oip&fields=isp";
                        $creatorhosting  = file_get_contents($iptohosting);
                        $hostingg        = ambilkata($creatorhosting, '"isp":"', '"}');
                        $hostingdetect   = ambilkata($hosting, '</span></td><td>:<nobr>', '<a href="http://www.google.com');
                        $o               = parse_url($k, PHP_URL_HOST);
                        $iptolocation    = "http://api.ipstack.com/$o?access_key=f991d31642a29f8a8197b57ef76f167b&fields=country_name";
                        $creatorlocation = file_get_contents($iptolocation);
                        $country         = ambilkata($creatorlocation, '{"country_name":"', '"}');
                        $sql = "INSERT INTO stufs
  (acctype,country,infos,url,price,resseller,sold,date,dateofsold,reported,sto,domain)
  VALUES
  ('shell','$country','$hostingg','$k','$price','$uid','0','$date',NULL,'','','$o')" or mysqli_error($dbcon);
                        //echo $sql;
                        if (mysqli_query($dbcon, $sql)) {
                            echo "Succesfully Added !";
                        }
                    }
                }
            } else {
                $o = parse_url($k, PHP_URL_HOST);
                echo "Not Working !";
                
            }
        }
    }
}
?>
             
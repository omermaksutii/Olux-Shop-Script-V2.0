<?
$host = $_GET["host"];
$port = $_GET["port"];
	if (preg_match('#mail#', $host)) { 

$f = fsockopen("$host", $port, $errno, $errstr, 3) ;
if ($f !== false) {
    $res = fread($f, 1024) ;
    if (strlen($res) > 0 && strpos($res, '220') === 0) {
        echo "Success!" ;
    }
    else {
        echo "Error";
    }
}
fclose($f) ; 
} else { 
$f = fsockopen("mail.$host", $port, $errno, $errstr, 3) ;
if ($f !== false) {
    $res = fread($f, 1024) ;
    if (strlen($res) > 0 && strpos($res, '220') === 0) {
        echo "Success!" ;
    }
    else {
        echo "Error";
    }
}
fclose($f) ; 
 }

?>
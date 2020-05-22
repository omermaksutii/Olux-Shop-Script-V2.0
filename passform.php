<?php
  ob_start();
  session_start();
  include "includes/config.php";
  date_default_timezone_set('UTC');
  error_reporting(0);

  if(isset($_SESSION['sname']) and isset($_SESSION['spass'])){
   header("location: buyer/index.html");
   exit();
}

  $email = mysqli_real_escape_string($dbcon, strip_tags($_POST['email']));
  $finder = mysqli_query($dbcon, "
  SELECT * FROM users WHERE email='$email' ") or die("mysql error");
    if(mysqli_num_rows($finder) != 0){
    $row = mysqli_fetch_assoc($finder);
    $user = $row['username'];
  $random = substr(md5(mt_rand()), 0, 40);

       // Plusieurs destinataires
     $to  = "$email";

     // Sujet
     $subject = 'Password reset request';

     // message
    $message = '
Hello <b>'.$row['username'].'</b><br><br>
     
Please confirm that you have submitted the password reset request. <br><br>

Open this link in your browser in order to complete password reset proccess<br>
https://jerux.to/reset.html?code='.$random.'&user='.$row['username'].'<br>
+================+<br>
Best Regards,<br>
<b>JeruxSHOP Team</b><br>
This e-mail is sent automatically by our system. Please do not reply.<br>
at '.date('m/d/Y h:i:s a', time()).'
     ';

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers[] = 'MIME-Version: 1.0';
     $headers[] = 'Content-type: text/html; charset=iso-8859-1';
     $headers[] = 'X-PHP-Script: ';
     // En-têtes additionnels
     $headers[] = 'From: JeruxShop <noreply@jerux.to>';

     // Envoi
     mail($to, $subject, $message, implode("\r\n", $headers));
	$sql = mysqli_query($dbcon, "UPDATE users SET resetpin='$random' WHERE email='$email'");
	  $errorbox = "<div class='alert alert-dismissible alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><p>We have sent an e-mail with a confirmation link to you. Please check your e-mail address!</p></div>";
      echo '{"state":"1","errorbox":"'.$errorbox.'","url":"login.html"}';
	
    }  else  {
	  $errorbox = "<div class='alert alert-dismissible alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><p>This email doesn't exist!</p></div>";
      echo '{"state":"0","errorbox":"'.$errorbox.'","url":""}';
  }

  ?>
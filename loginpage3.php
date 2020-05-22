<?php

  ob_start();
  session_start();
  include "includes/config.php";
  date_default_timezone_set('UTC');


  if(isset($_SESSION['sname']) and isset($_SESSION['spass'])){
   header("location: buyer/");
   exit();
}
?>
<h4> <b><span class='glyphicon glyphicon-fire'></span> Jerux SHOP - Forget</b> </h4>
<div id='errorbox'>
</div>
<form method='post' action='passform.html' class='ajax'>
    <input type='text' id='email' name='email' class='form-control input-sm chat-input' placeholder='Enter your e-mail' required/>

    <br>
    <div class='wrapper'>
                                <button type='submit' id='divButton' class='btn btn-primary btn-md'>Reset <span class='glyphicon glyphicon-log-in'></span></button>


    </div>
</form>
<br>
<br>
<div class='wrapper'>
    <button type='button' class='btn btn-default btn-xs' onclick="logindiv(1,'Login - Jerux SHOP','login.html',0);">Login</button> |
    <button type='button' class='btn btn-default btn-xs' onclick="logindiv(2,'Signup - Jerux SHOP','signup.html',0);">SignUp</button>
</div>

<script type="text/javascript">
          $('form.ajax').on('submit' , function() {
              $("#divButton").prop('disabled', true);
                var that = $(this),
                    url = that.attr('action');
                    type = that.attr('method');
                    data = {};
                that.find('[name]').each(function(index , value) {
                    var that = $(this),
                        name = that.attr('name'),
                        value = that.val();

                    data[name] = value;

                })
                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    success: function(response){
                        var response = JSON.parse(response);
                         $("#errorbox").html(response['errorbox'] ).show();

                    if(response['state'] == 0) {             $("#divButton").prop('disabled', false);}
                    if (response['url'] != 0){
                        if (response['url'] == 3){setTimeout(function(){ logindiv(4,'Verification - Jerux SHOP','login.html',0); }, 1500);}
                        else if (response['url'] == 1){setTimeout(function(){ logindiv(1,'Login - Jerux SHOP','verification.html',0); }, 1500);}
                        else {setTimeout(function(){ window.location = response['url']; }, 3000);}
                     }

                    }
                });

                return false;

            });
            </script>
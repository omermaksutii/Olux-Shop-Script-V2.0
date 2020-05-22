
<!doctype html>
<html>
<link rel="stylesheet" type="text/css" href="buyer/assets/bootstrap.css" />
<script type="text/javascript" src="buyer/assets/jquery.js"></script>
<script type="text/javascript" src="buyer/assets/bootstrap.js"></script>

<link rel="shortcut icon" href="img/favicon.ico" />
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>OLUX SHOP</title>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400);
html, body {
    background: url(img/bg.png);
}

.container {
    padding: 25px;
    position: fixed;
}

.form-login {
    background-color: #EDEDED;
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
}

h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
 text-align: center;
}
h6 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:5px;
 text-align: center;
}
.form-control {
    border-radius: 10px;
}

.wrapper {
    text-align: center;
}


</style>

</head>
<body>
<script type="text/javascript">
$(window).on('load', function() {
        logindiv(3,'Forget - Olux SHOP','forget.html',1);
});</script>
<!--Pulling Awesome Font -->

<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login" id="logindiv">
 </div>

        </div>
    </div>                    

</div>
</body>
</html>


<script type="text/javascript">
function logindiv(n,y,z,x){
    $("#logindiv").html('<h4><img src="img/loadTab.gif"></h4>').show();
    $.ajax({
    type:       'GET',
    url:        'loginpage'+ n +'.html?x='+Math.random(),
    success:    function(data)
    {
        
        $("#logindiv").html(data).show();
        var obj = { Title: y, Url: z };
        if (x != 1) {
          history.pushState(obj, obj.Title, obj.Url);
        }
        else{
          history.replaceState(obj, obj.Title, obj.Url);
        }
        document.title = y;
    }});
}
$(window).on("popstate", function(e) {
    if (event.state) {
        location.replace(document.location);
    }
});

</script>

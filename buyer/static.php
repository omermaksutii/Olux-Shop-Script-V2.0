<?php
ob_start();
session_start();
date_default_timezone_set('UTC');
include "../includes/config.php";

if(!isset($_SESSION['sname']) and !isset($_SESSION['spass'])){
   header("location: ../");
   exit();
}
$usrid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
echo "
<!doctype html>
<html>
  <head>
";
  $countleads = mysqli_query($dbcon,"SELECT * FROM leads WHERE sold='0'");$countr1=mysqli_num_rows($countleads); 
$countcpanels = mysqli_query($dbcon,"SELECT * FROM cpanels WHERE sold='0'");$countr2=mysqli_num_rows($countcpanels);
$countshells = mysqli_query($dbcon,"SELECT * FROM stufs WHERE sold='0'");$countr3=mysqli_num_rows($countshells);
$countrdps = mysqli_query($dbcon,"SELECT * FROM rdps WHERE sold='0'");$countr4=mysqli_num_rows($countrdps);
 $countmailers = mysqli_query($dbcon,"SELECT * FROM mailers WHERE sold='0'");$countr5=mysqli_num_rows($countmailers);
$countsmtps = mysqli_query($dbcon,"SELECT * FROM smtps WHERE sold='0'");$countr66=mysqli_num_rows($countsmtps); 
$countscams = mysqli_query($dbcon,"SELECT * FROM scampages");$countr6=mysqli_num_rows($countscams); 
$counttutos = mysqli_query($dbcon,"SELECT * FROM tutorials");$countr7=mysqli_num_rows($counttutos); 
echo'
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">';
	echo "
      google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Tools', 'Number'],
          ['Leads',  $countr1],
          ['cPanels',     $countr2],
          ['Shells',     $countr3],
          ['Rdps',      $countr4],
          ['Mailers',      $countr5],
          ['Smtps',      $countr66],
          ['Scampages',      $countr6],
          ['Tutorials',      $countr7],
                            ]);

        var options = {
          title: 'Available Tools',  
          titleTextStyle: {color: '#001f3f'},
          backgroundColor: 'transparent',

          legend: 'right',
          chartArea: {'width': '100%', 'height': '80%' },

          pieSliceText: 'label',
          pieHole: 0.4,
          colors:['#001f3f','#011e3d','#011b36','#011932','#011428','#021426','#032546']

        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>";
	echo '
    <style type="text/css">
      div.google-visualization-tooltip { pointer-events: none }
      svg > g > g:last-child { pointer-events: none }
    </style>
  </head>
  <body>
    <!--<div id="chart_div" style="width: 450px; height: 200px;"></div>-->
    <div id="donutchart" style="width: 450px; height: 250px;">
      
    </div>

  </body>
</html>';
?>
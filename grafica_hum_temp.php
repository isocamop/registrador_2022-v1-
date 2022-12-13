<?php
$con = new mysqli("localhost","root","12345678","registrador");
//verificar en caso de error......
$sql = "select id, datos from historial where id_sensor in (1,71)";
$res = $con->query($sql);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
//---------------- ingreso de datos en tabla desde mysql por php------------
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['id', 'Humedad R(%)', 'Temperatura T(°C)'],
          <?php
          while($fila = $res->fetch_assoc()){
            echo "['".$fila["id"]."',".$fila["datos"].",".$fila["datos"]."],";
          }
          ?>
//---------------- fin sentencia de datos ----------------------------------
        ]);

        var options = {
          title: 'Grafica de H umedad relativa VS Temperatura',
          hAxis: {title: 'tiempo',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>
</html>


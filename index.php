<?php
require("conexion.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>TEMPERATURA Y HUMEDAD</title>
        <link rel="stylesheet" href="css/estilo_graficas.css">

	<style type="text/css">
.highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
	</head>
	<body>
<script src="code/highcharts.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
      <!-- prueba de graficacion con base de datos registrador -->
    </p>
</figure>




		<script type="text/javascript">
// Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'MEDICION DE TEMPERATURA Y HUMEDAD CON SENSOR DHT22'
    },
    subtitle: {
        text: 'TALLER DE SISTEMAS  - ITEL ' // +
         //   '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
           // 'target="_blank">Wikipedia.com</a>'
    },
    xAxis: {
        categories: [0,1,2,3,4,5,6,7,8,9,10]
            
        
    },
    yAxis: {
        title: {
            text: 'Temperatura (°C) y Humedad (%)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Humedad',
        data: [
            <?php
            $sql = "SELECT * FROM historial";
            $result = mysqli_query($connection,$sql);
            while ($registros = mysqli_fetch_array($result))
            {
            ?>
            '<?php echo $registros["id"] ?>', 
            <?php
            }
            ?>
            ]
    }, {
        name: 'Temperatura',
        data: [ 12.2,12,13,14,16,40,18.66,12.2,12,13,14,16
        ]
    }]
});


                    

		</script>

                    

	</body>
</html>

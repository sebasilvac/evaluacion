<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
     <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	

	<style>
		#chart_div{
			width: 100%;
			height: 100%;
		}
	</style>

    <script type="text/javascript">

      	google.load("visualization", "1", {packages:["imagelinechart"]});


      	google.setOnLoadCallback(drawChart('/getDataChart1','chart_div'));


		function drawChart(ruta, div)
		{
			var jsonData = $.ajax({
				url: ruta,
				dataType: "json",
				async: false
			}).responseText;

			var options = {
				title: 'Gráfico',
				is3D: true
			};

			// Create our data table out of JSON data loaded from server.
			var data = new google.visualization.DataTable(jsonData);

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.PieChart(document.getElementById(div));
			chart.draw(data, options);
		}

    </script>
  </head>
  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
$(document).ready(function({


	$(document).on('click', '#ver_grafico_pie', function(){

		console.log("hola");


		/*google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);

		function drawChart()
		{
			var jsonData = $.ajax({
				url: "/getDataChart1",
				dataType: "json",
				async: false
			}).responseText;

			var options = {
				title: 'My Daily Activities',
				is3D: true,
			};

			// Create our data table out of JSON data loaded from server.
			var data = new google.visualization.DataTable(jsonData);
			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.PieChart(document.getElementById("chart_div"));
			chart.draw(data, options);
		}*/

	});


});




	
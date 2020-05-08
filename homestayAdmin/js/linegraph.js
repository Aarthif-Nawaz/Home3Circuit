$(document).ready(function(){
	$.ajax({
		url : "http://localhost/homestayAdmin/lineData.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var month = [];
			var predictions = [];
			
			for(var i in data) {
				month.push(data[i].month);
				predictions.push(data[i].price);
				
			}

			var chartdata = {
				labels: month,
				datasets: [
					{
						label: "Financial Forecast",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: predictions
					}
				]
				
			};
			var options = {
				title: {
					display: true,
					text: 'Financial Forecasts'
				},
    scales: {
        yAxes: [{
			scaleLabel: {
				display: true,
				labelString: 'Rates',
				
			}
		}],
		xAxes:[{
			scaleLabel: {
				display: true,
				labelString: 'Months'
			}
		}]
    },
};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options:options
			});
		},
		error : function(data) {

		}
	});
});
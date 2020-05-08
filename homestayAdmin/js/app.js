$(document).ready(function(){
	$.ajax({
		url: "http://localhost/homestayAdmin/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var factors = [];
			var PercentageImpacted = [];

			for(var i in data) {
				factors.push(data[i].factor);
				PercentageImpacted.push(data[i].PercentageImpacted);
			}

			var chartdata = {
				labels: factors,
				datasets : [
					{
						label: 'Percentage Impacted',
						backgroundColor: 'rgba(59, 89, 152, 0.75)',
						borderColor: 'rgba(59, 89, 152, 1)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: PercentageImpacted 
					}
				]
			};
			var options = {
				title: {
					display: true,
					text: 'Seasonal adoptions and recommendations'
				},
    scales: {
        yAxes: [{
			scaleLabel: {
				display: true,
				labelString: 'Percentage Liked',
				
			}
		}],
		xAxes:[{
			scaleLabel: {
				display: true,
				labelString: 'Factors'
			}
		}]
    },
};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options:options
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
$(document).ready(function(){
	$.ajax({
		url : "http://localhost/homestayAdmin/fluc.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var old_month = [];
            var old_price = [0];
            var new_month = [];
            var new_price = [50];
            var inc = "Hi";
            var ans = 0;
			for(var i in data) {
                if(data[i].currentPrice > data[i].newPrice){
                    ans = data[i].currentPrice-data[i].newPrice;
                    inc = "Decreased By Rs "+ans.toString();
                }
                else{
                    ans = data[i].newPrice-data[i].currentPrice;
                    inc = "Increased By Rs "+ans.toString();
                }
                console.log(inc);
				old_month.push(data[i].month);
                old_price.push(data[i].currentPrice);
                old_month.push(data[i].newDay);
                new_price.push(data[i].newPrice);
				
			}

			var chartdata = {
				labels: old_month,
				datasets: [
					{
						label: "Current Rate",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: old_price
                    },
                    {
						label: inc,
						fill: false,
                        lineTension: 225.1,
			            lineThickness: 1200,
						backgroundColor: "rgba(255, 0, 0, 0.75)",
						borderColor: "rgba(255, 0, 0, 1)",
						pointHoverBackgroundColor: "rgba(255, 0, 0, 1)",
						pointHoverBorderColor: "rgba(255, 0, 0, 1)",
						data: new_price
					}
				]
				
			};
			var options = {
				title: {
					display: true,
					text: 'Financial Fluctuations'
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
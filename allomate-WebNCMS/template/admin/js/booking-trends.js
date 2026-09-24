
var chart    = document.getElementById('BookingTrends').getContext('2d'),
    gradient = chart.createLinearGradient(0, 0, 0, 330);

gradient.addColorStop(0, 'rgba(0, 56, 186, 0.5)');
gradient.addColorStop(0.5, 'rgba(255, 255, 255, 0.25)');
gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');


var data  = {
    labels: [ '1', '2', '3', '4', '5', '6', '1', '2', '3', '4', '5', '6','1', '2', '3', '4', '5', '6', '1', '2', '3', '4', '5', '6', '1', '2', '3', '4', '5', '6', '31' ],
    datasets: [{
			label: '',
			backgroundColor: gradient,
			pointBackgroundColor: '#EBB30A',
			borderWidth: 3, 
			borderColor: '#EBB30A',
			data: [500000, 800000, 1000000, 700000, 600000, 300000, 500000, 800000, 1000000, 700000, 600000, 300000, 500000, 800000, 1000000, 700000, 600000, 300000, 500000, 800000, 1000000, 700000, 600000, 300000,  500000, 800000, 1000000, 700000, 600000, 300000, 500000]
    }]
};

var options = {
	  layout: {
    padding: {
      top: 5
    }
  },
	responsive: true,
	maintainAspectRatio: true,
	animation: {
		easing: 'easeInOutQuad',
		duration: 520
	},
	scales: {
		xAxes: [{
			gridLines: {
				color: 'rgba(200, 200, 200, 0.05)',
				lineWidth: 1
			}
		}],
		yAxes: [{
			// gridLines: {
			// 	color: 'rgba(200, 200, 200, 0.08)',
			 //	lineWidth: 1
			// },
			ticks: {
                display: false
            }
		}]
	},
	elements: {
		line: {
			tension: 0.4
		}
	},
	legend: {
		display: false
	},
	point: {
		backgroundColor: '#EBB30A',
	},

	
	 tooltips: {
		bodyFontFamily: 'Rationale',
		backgroundColor: '#EBB30A',
		titleFontColor: '#fff',
		caretSize: 5, 
		cornerRadius: 2, bodyFontSize:20,  
  
	//remove label colorbox from tooltips	 
     custom: function(tooltip) {
     if (!tooltip) return;
     tooltip.displayColors = false;
     },
		 
     callbacks: {
     label: function(tooltipItem, data) {
     return tooltipItem.xLabel + " RS." + tooltipItem.yLabel;
     },
     title: function(tooltipItem, data) {
     return;
     }
     }
		 
     }
		  
};

var chartInstance = new Chart(chart, {
    type: 'line',
    data: data,
		options: options
});


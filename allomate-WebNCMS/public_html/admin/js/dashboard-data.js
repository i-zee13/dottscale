var dom = document.getElementById("e_chart_1");
var myChart = echarts.init(dom);
var app = {};
option = null;
var posList = [
	'left', 'right', 'top', 'bottom',
	'inside',
	'insideTop', 'insideLeft', 'insideRight', 'insideBottom',
	'insideTopLeft', 'insideTopRight', 'insideBottomLeft', 'insideBottomRight'
];

app.configParameters = {
	rotate: {
		min: -90,
		max: 90
	},
	align: {
		options: {
			left: 'left',
			center: 'center',
			right: 'right'
		}
	},
	verticalAlign: {
		options: {
			top: 'top',
			middle: 'middle',
			bottom: 'bottom'
		}
	},
	position: {
		options: echarts.util.reduce(posList, function (map, pos) {
			map[pos] = pos;
			return map;
		}, {})
	},
	distance: {
		min: 0,
		max: 100
	}
};

app.config = {
	rotate: 90,
	align: 'left',
	verticalAlign: 'middle',
	position: 'insideBottom',
	distance: 15,
	onChange: function () {
		var labelOption = {
			normal: {
				rotate: app.config.rotate,
				align: app.config.align,
				verticalAlign: app.config.verticalAlign,
				position: app.config.position,
				distance: app.config.distance
			}
		};
		myChart.setOption({
			series: [{
				label: labelOption
			}, {
				label: labelOption
			}, {
				label: labelOption
			}, {
				label: labelOption
			}]
		});
	}
};


var labelOption = {
	normal: {
		show: true,
		position: app.config.position,
		distance: app.config.distance,
		align: app.config.align,
		verticalAlign: app.config.verticalAlign,
		rotate: app.config.rotate,
		formatter: '{c}',
		//formatter: '{c} {name{a}}',
		fontSize: 10,
		rich: {
			name:{
				textBorderColor: '#fff',

			}
		}
	}
};

option = {
	color: ['#EBB30A','#282828'],
	tooltip: {
		trigger: 'axis',
		backgroundColor: 'rgba(33,33,33,1)',
		borderRadius: 0,
		padding: 5,
		axisPointer: {
			type: 'cross',
			label: {
				backgroundColor: 'rgba(33,33,33,1)'
			}
		},
		textStyle: {
			color: '#fff',
			fontStyle: 'normal',
			fontWeight: 'normal',
			fontFamily: "'Roboto', sans-serif",
			fontSize: 12
		}
	},
	legend: {
		data: ['Product']
	},
	toolbox: {
		show: false,
		orient: 'vertical',
		left: 'right',
		padding: 0,
		margin: 0,
		top: 'center',
		feature: {
			mark: {
				show: true
			},
			dataView: {
				show: true,
				readOnly: true
			},
			magicType: {
				show: true,
				type: ['line', 'bar', 'stack', 'tiled']
			},
			restore: {
				show: true
			},
			saveAsImage: {
				show: false
			}
		}
	},
	grid: {
		left: '0',
		right: '0',
		top: '35px',
		bottom: '0',
		containLabel: true
	},
	calculable: true,
	type: 'value',
	axisLine: {
		show: true
	},
	xAxis: [{
			type: 'category',
			axisTick: {
				show: true
			},
			data: ['Name 1', 'Name 2', 'Name 3', 'Name 4', 'Name 5', 'Name 6','Name 7', 'Name 8', 'Name 9', 'Name 10',],
			axisLine: {
				show: true
			},
			axisLabel: {
				textStyle: {
					color: '#a0a0a0'
				}
			},
		}

	],

	yAxis: [{
		type: 'value',
		axisLine: {
			show: true
		},
		axisLabel: {
			textStyle: {
				color: '#a0a0a0'
			}
		},
		splitLine: {
			show: true,
		}
	}],
	series: [{
		name: 'Sales',
		type: 'bar',
		barGap: 0,
		label: labelOption,
		data: [600, 510, 480, 420, 390, 330, 300, 280, 265, 205]
	}, {
		name: 'percentage',
		type: 'line',
		label: labelOption,
		data: [600, 510, 480, 420, 390, 330, 300, 280, 265, 205]
	}]
};;
if (option && typeof option === "object") {
	myChart.setOption(option, true);
}

//PaymentMode


var ctx = document.getElementById("PaymentMode");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Cash", "Cheque ", "Deposit"],
        datasets: [{
            label: 'Payment Mode',
            data: [350, 209, 55 ],
            backgroundColor: [
                '#EBB30A','#282828','#939393',                
            ],
            borderColor: [
                '#fff','#fff','#fff',                
            ],
            borderWidth: 1
        }]
    },
    options: {
        rotation: 1 * Math.PI,
        circumference: 1 * Math.PI
    }
}); 			

//Invoice

var ctx = document.getElementById("invoicechart").getContext('2d');

var chartData = [400, 300];
var chartLabels = ['Paid Invoices','Pending Invoices'];

var chart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: chartLabels,
    datasets: [{
      backgroundColor: [
        "#EBB30A",
        "#282828",
      ],
      data: chartData
    }]
  },
  options: {
    legend: {
      display: false
    },
    legendCallback: function(chart) {
      var text = [];
      text.push('<ul class="0-legend">');
      var ds = chart.data.datasets[0];
      var sum = ds.data.reduce(function add(a, b) { return a + b; }, 0);
      for (var i=0; i<ds.data.length; i++) {
        text.push('<li>');
        var perc = Math.round(100*ds.data[i]/sum,0);
        text.push('<span style="background-color:' + ds.backgroundColor[i] + '">' + '</span>' + chart.data.labels[i] + ' ('+ds.data[i]+') ('+perc+'%)');
        text.push('</li>');
      }
      text.push('</ul>');
      return text.join("");
    }
  }
});

var myLegendContainer = document.getElementById("legend");
// generate HTML legend
myLegendContainer.innerHTML = chart.generateLegend();
// bind onClick event to all LI-tags of the legend
var legendItems = myLegendContainer.getElementsByTagName('li');
for (var i = 0; i < legendItems.length; i += 1) {
  legendItems[i].addEventListener("click", legendClickCallback, false);
}

function legendClickCallback(event) {
  event = event || window.event;

  var target = event.target || event.srcElement;
  while (target.nodeName !== 'LI') {
    target = target.parentElement;
  }
  var parent = target.parentElement;
  var chartId = parseInt(parent.classList[0].split("-")[0], 10);
  var chart = Chart.instances[chartId];
  var index = Array.prototype.slice.call(parent.children).indexOf(target);
  var meta = chart.getDatasetMeta(0);
  console.log(index);
	var item = meta.data[index];

  if (item.hidden === null || item.hidden === false) {
    item.hidden = true;
    target.classList.add('hidden');
  } else {
    target.classList.remove('hidden');
    item.hidden = null;
  }
  chart.update();
}





var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',  //polarArea   doughnut   pie
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [800, 600, 950, 700, 500, 150],
            backgroundColor: [
                '#EBB30A', '#002b8f', '#1052eb', '#282828', '#7a7a7a', '#b4b4b4'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
		
	legend: { 
        position: 'right' 
    },
		
	scales: {
            xAxes: [{
                ticks: {
                    display: false //this will remove only the label
                }
            }]
    }
    }
}); 

 
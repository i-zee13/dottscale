							   
									   
	var data = {
    datasets: [{
        data: [
            2935,
            5415,
            4710,
            3655,
            2230,
			3330,
			4130,
            2935,
            5415,
            4710,
            3655,
            2230,
        ],
        backgroundColor: [
        "#EBB30A","#EBB30A","#EBB30A","#EBB30A","#EBB30A","#EBB30A","#EBB30A","#EBB30A","#EBB30A","#EBB30A","#EBB30A","#EBB30A"
        ],
        label: '' // for legend
    }],
    labels: [
        "1/7/2020",
		"2/7/2020",
		"3/7/2020",
		"4/7/2020",
        "5/7/2020",
        "6/7/2020",
        "7/7/2020",
		"8/7/2020",
		"9/7/2020",
        "10/7/2020",
        "11/7/2020",
        "12/7/2020",
    ]
			
};



var ctx = $("#ProductSale");
new Chart(ctx, {
    data: data,
    type: 'bar',
	
  options: {
	 tooltips: {
		bodyFontFamily: 'Rationale',
		backgroundColor: '#282828',
		titleFontColor: '#fff',
		caretSize: 5, 
		cornerRadius: 2, 
		 bodyFontSize:20,  
  
	//remove label colorbox from tooltips	 
     custom: function(tooltip) {
     if (!tooltip) return;
     tooltip.displayColors = false;
     },
		 
     },
	  
 legend: {
            display: false,
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

	
	
  
    plugins: {
      labels: {
        // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
        render: 'image',

        // precision for percentage, default is 0
        precision: 0,

        // identifies whether or not labels of value 0 are displayed, default is false
        showZero: false,

 
 

        // font style, default is defaultFontStyle
        fontStyle: 'normal',

        // font family, default is defaultFontFamily
        fontFamily: "'Rationale'",

        // draw text shadows under labels, default is false
        textShadow: true,

        // text shadow intensity, default is 6
        shadowBlur: 5,

        // text shadow X offset, default is 3
        shadowOffsetX: -2,

        // text shadow Y offset, default is 3
        shadowOffsetY: 2,

        // text shadow color, default is 'rgba(0,0,0,0.3)'
        shadowColor: 'rgba(0,0,0,0.40)',

        // draw label in arc, default is false
        // bar chart ignores this
       // arc: true,

        // position to draw label, available value is 'default', 'border' and 'outside'
        // bar chart ignores this
        // default is 'default'
     

        // draw label even it's overlap, default is true
        // bar chart ignores this
        overlap: true,

        // show the real calculated percentages from the values and don't apply the additional logic to fit the percentages to 100 in total, default is false
        showActualPercentages: true,

        // set images when `render` is 'image'
        images: [
          {
            src: '',
            width: 16,
            height: 16
          }
        ],

        // add padding when position is `outside`
        // default is 2
        outsidePadding: 4,

        // add margin of text when position is `outside` or `border`
        // default is 2
        textMargin: 4
      }
    }
  }
	
});
 
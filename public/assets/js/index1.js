$(function(e){
  'use strict'
  

 /* chartjs (#sales-status) */
 
 var ctx = $('#sales-status');
	ctx.height(310);
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["P1-6", "p1-8", "p2-6", "p2-8", "p3-6", "p3-8", "p4-6", "p4-8", "p5-6", "p5-8", "p6-6", "p6-8"],
			type: 'line',
			datasets: [{
				label: "Expenses",
				data: [20000, 25000, 38000, 42000, 65000, 74000, 66000, 58500, 69000, 75600, 58400, 78000],
				backgroundColor: 'transparent',
				borderColor: '#ec296b ',
				borderWidth: 3,
				pointStyle: 'circle',
				pointRadius: 5,
				pointBorderColor: 'transparent',
				pointBackgroundColor: '#ec296b',
			}, {
				label: "Budget",
				data: [25000, 32000, 26000, 41000, 69000, 76000, 38000, 42500, 63000, 72400, 58620, 96000],
				backgroundColor: 'transparent',
				borderColor: '#4801ff',
				borderWidth: 3,
				pointStyle: 'circle',
				pointRadius: 5,
				pointBorderColor: 'transparent',
				pointBackgroundColor: '#4801ff',
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			tooltips: {
				mode: 'index',
				titleFontSize: 12,
				titleFontColor: '#000',
				bodyFontColor: '#000',
				backgroundColor: '#fff',
				cornerRadius: 3,
				intersect: false,
			},
			legend: {
				display: true,
				labels: {
					usePointStyle: false,
				},
			},
			scales: {
				xAxes: [{
					ticks: {
					 },
					display: true,
					gridLines: {
						display: true,
						drawBorder: false
					},
					scaleLabel: {
						display: false,
						labelString: 'Month',
						fontColor: 'transparent'
					}
				}],
				yAxes: [{
					ticks: {
						fontColor: "",
					 },
					display: true,
					gridLines: {
						display: true,
						drawBorder: false
					},
					scaleLabel: {
						display: false,
						labelString: 'sales',
						fontColor: 'transparent'
					}
				}]
			},
			title: {
				display: false,
				text: 'Normal Legend'
			}
		}
	});
	/* chartjs (#sales-status) closed */

  });

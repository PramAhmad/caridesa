// basic area chart
var options = {
    chart: {
        height: 200,
        type: 'area',
        zoom: {
            enabled: false
        },
        toolbar:{
          show: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight'
    },
    series: [{
        name: "STOCK ABC",
        data: series.monthDataSeries1.prices
    }],
    labels: series.monthDataSeries1.dates,
    xaxis: {
        type: 'datetime',
    },
    yaxis: {
        opposite: true
    },
    legend: {
        horizontalAlign: 'left'
    },
    colors:[ "oklch(50.8% 0.118 165.612)" ]

}

var chart = new ApexCharts(
    document.querySelector("#basic-apex"),
    options
);

chart.render();

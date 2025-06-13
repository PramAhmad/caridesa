(function($) {
    "use strict";
    var sparkline_chart = {
      init: function() {
        setTimeout(function(){
            $("#simple-line-chart-sparkline").sparkline([5, 10, 20, 14, 17, 21, 20, 10, 4, 13,0, 10, 30, 40, 10, 15, 20], {
                type: 'line',
                width: '100%',
                height: '150',
                tooltipClassname: 'chart-sparkline',
                lineColor: 'oklch(50.8% 0.118 165.612)',
                fillColor: 'transparent',
                highlightLineColor: 'oklch(50.8% 0.118 165.612)',
                highlightSpotColor: 'oklch(50.8% 0.118 165.612)',
                targetColor: 'oklch(50.8% 0.118 165.612)',
                performanceColor: 'oklch(50.8% 0.118 165.612)',
                boxFillColor: 'oklch(50.8% 0.118 165.612)',
                medianColor: 'oklch(50.8% 0.118 165.612)',
                minSpotColor: 'oklch(50.8% 0.118 165.612)'
            });
      })
    }
};
  sparkline_chart.init()
})(jQuery);

(function($) {
    "use strict";
    var morris_chart = {
        init: function() {
            $(function() {
                for (var c = [], d = 0; d <= 360; d += 10) c.push({
                    x: d,
                    y: 1.5 + 1.5 * Math.sin(Math.PI * d / 180).toFixed(4)
                });
                window.m = Morris.Line({
                    element: 'decimal-morris-chart',
                    data: c,
                    xkey: "x",
                    ykeys: ["y"],
                    labels: ["sin(x)"],
                    parseTime: !1,
                    lineColors: ['oklch(50.8% 0.118 165.612)'],
                    hoverCallback: function(a, b, c, d) {
                        return c.replace("sin(x)", "1.5 + 1.5 sin(" + d.x + ")")
                    },
                    xLabelMargin: 10,
                    integerYLabels: !0
                })
            }) 
        }
    };
    morris_chart.init()
})(jQuery);

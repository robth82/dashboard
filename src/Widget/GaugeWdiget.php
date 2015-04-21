<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 30-10-14
 * Time: 7:44
 */

namespace Robth82\Dashboard\Widget;


class GaugeWdiget extends Widget
{
    function __construct(array $options)
    {
        parent::__construct($options);

        $html = '<div style="width: 600px; height: 400px; margin: 0 auto">
                <div id="' . $this->getUniqid() . 'Gauge' . '" style="width: 300px; height: 200px; float: left"></div>
            </div>';

        $html .= '<script>
        $(function () {

    var gaugeOptions = {

        chart: {
            type: \'solidgauge\'
        },

        title: null,

        pane: {
            center: [\'50%\', \'85%\'],
            size: \'140%\',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || \'#EEE\',
                innerRadius: \'60%\',
                outerRadius: \'100%\',
                shape: \'arc\'
            }
},

tooltip: {
    enabled: false
        },

// the value axis
yAxis: {
    stops: [
        [0.1, \'#55BF3B\'], // green
        [0.5, \'#DDDF0D\'], // yellow
        [0.9, \'#DF5353\'] // red
    ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
        y: -70
            },
            labels: {
        y: 16
            }
        },

plotOptions: {
    solidgauge: {
        dataLabels: {
            y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
    }
}
};

// The speed gauge
$(\'#' . $this->getUniqid() . 'Gauge' . '\').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
    min: 0,
            max: 200,
            title: {
        text: \'Speed\'
            }
        },

        credits: {
    enabled: false
        },

        series: [{
    name: \'Speed\',
            data: [80],
            dataLabels: {
        format: \'<div style="text-align:center"><span style="font-size:25px;color:\' +
        ((Highcharts.theme && Highcharts.theme.contrastTextColor) || \'black\') + \'">{y}</span><br/>\' +
        \'<span style="font-size:12px;color:silver">km/h</span></div>\'
            },
            tooltip: {
        valueSuffix: \' km/h\'
            }
        }]

    }));



    // Bring life to the dials
    setInterval(function () {
        // Speed
        var chart = $(\'#' . $this->getUniqid() . 'Gauge' . '\').highcharts(),
            point,
            newVal,
            inc;

        if (chart) {
            point = chart.series[0].points[0];
            inc = Math.round((Math.random() - 0.5) * 100);
            newVal = point.y + inc;

            if (newVal < 0 || newVal > 200) {
                newVal = point.y - inc;
            }

            point.update(newVal);
        }


    }, 2000);


});
</script>';
    }

} 
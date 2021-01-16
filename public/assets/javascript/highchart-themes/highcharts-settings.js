$(function() {
/** Highcharts Settings To Gallery from highcharts.html **/
    Dashboard.Helpers.elementExists('.platinas-por-mes', function() {
        $(this).highcharts({
            chart: {
                renderTo: 'container',
                backgroundColor: 'transparent',
                type: 'line'
            },
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                gridLineWidth: 1,
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            yAxis: {
                gridLineWidth: 1,
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'bottom',
                borderWidth: 0,
                enabled: false,
            },
            series: [{
                name: ' ',
                type: 'area',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 21.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                color: '#2E9BDA',
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, 'rgba(45, 153, 220, .4)'],
                        [1, 'rgba(45, 153, 220, 0)']
                    ]},
                    lineWidth: '1',
                    marker: {
                        symbol: 'circle',
                    }
                }]
            });
    });

    Dashboard.Helpers.elementExists('.jogos-por-dificuldade', function() {
        $(this).highcharts({
            chart: {
                type: 'bar',
                height: 300,
                backgroundColor: 'transparent',
            },
            exporting: {
                enabled: false
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['Garapa','Fácil','Normal','Difícil','Insano'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            legend: {
               enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                name: ' ',
                data: [107, 31, 635, 203, 500],
                  borderColor: '#212121'
            }]
        });
    });
    Dashboard.Helpers.elementExists('.jogos-por-situacao', function() {
        $(this).highcharts({
            chart: {
                type: 'bar',
                height: 300,
                backgroundColor: 'transparent',
            },
            exporting: {
                enabled: false
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['Garapa','Fácil','Normal','Difícil','Insano'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                name: ' ',
                data: [107, 31, 635, 203, 500],
                borderColor: '#212121'
            }]
        });
    });

    // Used in highcharts.html in panel "Basic Column"
    Dashboard.Helpers.elementExists('.jogos-por-publisher', function() {
        $(this).highcharts({
            chart: {
                type: 'column',
                backgroundColor: 'transparent',
                height: 300,
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    'ACTIVISION',
                    'BANDAI',
                    'CAPCOM',
                    'EA',
                    'KOEI',
                    'SQUARE-ENIX',
                    'SONY',
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            credits: {
                enabled: false
            },
                legend: {
                enabled: false
            },
               exporting: {
                enabled: false
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: ' ',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6]

            }   ]
        });
    });

    Dashboard.Helpers.elementExists('.jogos-por-plataforma', function() {
        // Build the chart
        $(this).highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                height: 300,
                backgroundColor: 'transparent',
            },
            title: {
                text: ''
            },
             credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                     borderColor: '#212121',
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Plataformas',
                colorByPoint: true,
                data: [{
                    name: 'PS3',
                    y: 56.33,
                    color: '#FFCCEA'
                }, {
                    name: 'PS4',
                    y: 24.03,
                    color: '#CE7810'
                }, {
                    name: 'PS5',
                    y: 10.38,
                    color: '#55EF00'
                }, {
                    name: 'VITA',
                    y: 10.38,
                    color: '#383838'
                }]
            }]
        });
    });
    Dashboard.Helpers.elementExists('.exclusivos-mults', function() {
        // Build the chart
        $(this).highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                height: 300,
                backgroundColor: 'transparent',
            },
            title: {
                text: ''
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    borderColor: '#212121',
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: '',
                colorByPoint: true,
                data: [{
                    name: 'EXCLUSIVOS',
                    y: 56.33,
                    color: '#FFCCEA'
                }, {
                    name: 'MULTIPLATAFORMAS',
                    y: 24.03,
                    color: '#CE7810'
                }]
            }]
        });
    });
    Dashboard.Helpers.elementExists('.unicos-repetidos', function() {
        // Build the chart
        $(this).highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                height: 300,
                backgroundColor: 'transparent',
            },
            title: {
                text: ''
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    borderColor: '#212121',
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: '',
                colorByPoint: true,
                data: [{
                    name: 'ÚNICOS',
                    y: 56.33,
                    color: '#FFCCEA'
                }, {
                    name: 'REPETIDOS',
                    y: 24.03,
                    color: '#CE7810'
                }]
            }]
        });
    });

    Dashboard.Helpers.elementExists('.highcharts-ajax-loaded-data', function() {
        // Get the CSV and create the chart
        var _this = this;
        $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=analytics.csv&callback=?', function (csv) {

            $(_this).highcharts({

                data: {
                    csv: csv
                },

                title: {
                    text: ''
                },

                subtitle: {
                    text: ''
                },

                   credits: {
                enabled: false
                },
                exporting: {
                enabled: false
                },

                xAxis: {
                    tickInterval: 7 * 24 * 3600 * 1000, // one week
                    tickWidth: 0,
                    gridLineWidth: 1,
                    labels: {
                        align: 'left',
                        x: 3,
                        y: -3
                    }
                },

                yAxis: [{ // left y axis
                    title: {
                        text: null
                    },
                    labels: {
                        align: 'left',
                        x: 3,
                        y: 16,
                        format: '{value:.,0f}'
                    },
                    showFirstLabel: false
                }, { // right y axis
                    linkedTo: 0,
                    gridLineWidth: 0,
                    opposite: true,
                    title: {
                        text: null
                    },
                    labels: {
                        align: 'right',
                        x: -3,
                        y: 16,
                        format: '{value:.,0f}'
                    },
                    showFirstLabel: false
                }],

                legend: {
                    align: 'left',
                    verticalAlign: 'top',
                    borderWidth: 0
                },

                tooltip: {
                    shared: true,
                    crosshairs: true
                },

                plotOptions: {
                    series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function (e) {
                                    hs.htmlExpand(null, {
                                        pageOrigin: {
                                            x: e.pageX || e.clientX,
                                            y: e.pageY || e.clientY
                                        },
                                        headingText: this.series.name,
                                        maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) + ':<br/> ' +
                                            this.y + ' visits',
                                        width: 200
                                    });
                                }
                            }
                        },
                        marker: {
                            lineWidth: 1
                        }
                    }
                },

                series: [{
                    name: 'Companies',
                    lineWidth: 1,
                    marker: {
                        radius: 4
                    }
                }, {
                    name: 'Total Users',
                    lineWidth: 1
                }]
            });
        });
    });
});

// Sparklines Highcharts
$(function () {
    /**
     * Create a constructor for sparklines that takes some sensible defaults and merges in the individual
     * chart options. This function is also available from the jQuery plugin as $(element).highcharts('SparkLine').
     */
    Highcharts.SparkLine = function (a, b, c) {
        var hasRenderToArg = typeof a === 'string' || a.nodeName,
            options = arguments[hasRenderToArg ? 1 : 0],
            defaultOptions = {
                chart: {
                    renderTo: (options.chart && options.chart.renderTo) || this,
                    backgroundColor: null,
                    borderWidth: 0,
                    type: 'area',
                    margin: [2, 0, 2, 0],
                    width: 120,
                    height: 20,
                    style: {
                        overflow: 'visible'
                    },
                    skipClone: true
                },
                title: {
                    text: ''
                },
                credits: {
                    enabled: false
                },
                    exporting: {
                    enabled: false
                },
                xAxis: {
                    labels: {
                        enabled: false
                    },
                    title: {
                        text: null
                    },
                    startOnTick: false,
                    endOnTick: false,
                    tickPositions: []
                },
                yAxis: {
                    endOnTick: false,
                    startOnTick: false,
                    labels: {
                        enabled: false
                    },
                    title: {
                        text: null
                    },
                    tickPositions: [0]
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    backgroundColor: null,
                    borderWidth: 0,
                    shadow: false,
                    useHTML: true,
                    hideDelay: 0,
                    shared: true,
                    padding: 0,
                    positioner: function (w, h, point) {
                        return { x: point.plotX - w / 2, y: point.plotY - h };
                    }
                },
                plotOptions: {
                    series: {
                        animation: false,
                        lineWidth: 1,
                        shadow: false,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        marker: {
                            radius: 1,
                            states: {
                                hover: {
                                    radius: 2
                                }
                            }
                        },
                        fillOpacity: 0.25
                    },
                    column: {
                        negativeColor: '#910000',
                        borderColor: 'silver'
                    }
                }
            };

        options = Highcharts.merge(defaultOptions, options);

        return hasRenderToArg ?
            new Highcharts.Chart(a, options, c) :
            new Highcharts.Chart(options, b);
    };

    var start = +new Date(),
        $tds = $('td[data-sparkline]'),
        fullLen = $tds.length,
        n = 0;

    // Creating 153 sparkline charts is quite fast in modern browsers, but IE8 and mobile
    // can take some seconds, so we split the input into chunks and apply them in timeouts
    // in order avoid locking up the browser process and allow interaction.
    function doChunk() {
        var time = +new Date(),
            i,
            len = $tds.length,
            $td,
            stringdata,
            arr,
            data,
            chart;

        for (i = 0; i < len; i += 1) {
            $td = $($tds[i]);
            stringdata = $td.data('sparkline');
            arr = stringdata.split('; ');
            data = $.map(arr[0].split(', '), parseFloat);
            chart = {};

            if (arr[1]) {
                chart.type = arr[1];
            }
            $td.highcharts('SparkLine', {
                series: [{
                    data: data,
                    pointStart: 1
                }],
                tooltip: {
                    headerFormat: '<span style="font-size: 10px">' + $td.parent().find('th').html() + ', Q{point.x}:</span><br/>',
                    pointFormat: '<b>{point.y}.000</b> USD'
                },
                chart: chart
            });

            n += 1;

            // If the process takes too much time, run a timeout to allow interaction with the browser
            if (new Date() - time > 500) {
                $tds.splice(0, i + 1);
                setTimeout(doChunk, 0);
                break;
            }

            // Print a feedback on the performance
            if (n === fullLen) {
                $('#result').html('Generated ' + fullLen + ' sparklines in ' + (new Date() - start) + ' ms');
            }
        }
    }
    doChunk();

});

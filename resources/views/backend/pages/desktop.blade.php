@extends('backend.layouts.default')

@section('title')
    Desktop
@stop()

@section('custom-header')
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
@stop()

@section('content')
    <div class="mdl-cell mdl-cell--12-col statistics">
        <div title="Registered users" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="{{ $userCount }}">account_box</div>
        <div title="Total posts" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="{{ $postCount }}">mode_comment</div>
        <div title="Categories" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="{{ $categoryCount }}">toc</div>
        <div title="Platform version" class="material-icons mdl-badge mdl-badge--overlap statistic-badge" data-badge="1.3">update</div>
        <div title="Memory usage" class="material-icons mdl-badge mdl-badge--overlap statistic-badge inactive-badge" id="mem-badge" data-badge="0%">memory</div>
        <div title="Storage usage" class="material-icons mdl-badge mdl-badge--overlap statistic-badge inactive-badge" id="storage-badge" data-badge="0%">storage</div>
        <div title="Current CPU load" class="material-icons mdl-badge mdl-badge--overlap statistic-badge inactive-badge" id="cpu-badge" data-badge="0%">settings_applications</div>
    </div>

    <div id="chart-container" style="width: 100%; height: 200px; position: relative; top: 50px;"></div>

    <div class="mdl-cell mdl-cell--12-col">
        <span class="mdl-layout__title">
            <h3>Recent posts:</h3>
        </span>
        <div>
            @include('backend.pages.post.table')
        </div>
    </div>
@stop()

@section('custom-style')
    <style>
     #post-list {
         position: inherit;
         top: 0;
     }

    .inactive-badge::after {
         background: gray !important;
    }
    </style>
@stop()

@section('javascript')
    <script>
        let $cpuBadge = $("#cpu-badge");
        let $memBadge = $("#mem-badge");
        let $storageBadge = $("#storage-badge");

        let token = "{{ $token }}";
        let refreshRate = 200;

        Highcharts.chart('chart-container', {

            chart: {
                animation: false,
                type: 'spline',
                events: {
                    load: function () {

                        // set up the updating of the chart each second
                        let cpuSeries = this.series[0];
                        let memSeries = this.series[1];
                        let storageSeries = this.series[2];

                        setInterval(function() {
                            $.ajax({
                                "url": "/api/system-resources",
                                "headers": {
                                    'Accept': 'application/json',
                                    'Authorization': 'Bearer ' + token
                                }
                            })
                                .done(function(data) {
                                    $memBadge.attr("data-badge", data["memory"] + "%");
                                    $cpuBadge.attr("data-badge", data["cpu"] + "%");
                                    $storageBadge.attr("data-badge", data["storage"] + "%");

                                    $memBadge.removeClass("inactive-badge");
                                    $cpuBadge.removeClass("inactive-badge");
                                    $storageBadge.removeClass("inactive-badge");

                                    let x = (new Date()).getTime();
                                    cpuSeries.addPoint([x, data["cpu"]], true, true);
                                    memSeries.addPoint([x, data["memory"]], true, true);
                                    storageSeries.addPoint([x, data["storage"]], true, true);
                                })
                        }, refreshRate);
                    }
                }
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                labels: {
                        enabled: false
                }
            },
            yAxis: {
                title: {
                    text: '%'
                }
            },
            plotOptions: {
                series: {
                    marker: {
                        enabled: false
                    }
                }
            },
            series: [{
                name: "CPU",
                data: new Array(20).fill([(new Date()).getTime(), 0]),
                pointInterval: refreshRate

            }, {
                name: "Memory",
                data: new Array(20).fill([(new Date()).getTime(), 0]),
                pointInterval: refreshRate
            }, {
                name: "Storage",
                data: new Array(20).fill([(new Date()).getTime(), 0]),
                pointInterval: refreshRate
            }]
        });
    </script>
@stop()

@extends('dashboard.layout')
@section('page-breadcrumb')
    Dashboard-new
@stop
@section('page-heading')
    Your Product Details
@stop
@section('content')
    <div class="row">
        <div class="col-xs-4">
            <!-- Centered text -->
            <div class="stat-panel text-center">
                <div class="stat-row">
                    <!-- Dark gray background, small padding, extra small text, semibold text -->
                    <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                        <i class="fa fa-globe"></i>&nbsp;&nbsp;TOTAL PRODUCTS
                    </div>
                </div> <!-- /.stat-row -->
                <div class="stat-row">
                    <!-- Bordered, without top border, without horizontal padding -->
                    <div class="stat-cell bordered no-border-t no-padding-hr">
                        <div class="pie-chart" data-percent="0" id="easy-pie-chart-1">
                            <div class="pie-chart-label">{{$totalProducts}}</div>
                        </div>
                    </div>
                </div> <!-- /.stat-row -->
            </div> <!-- /.stat-panel -->
        </div>
        <div class="col-md-8 bg-primary">
                <div id="hero-graph" class="graph" style="height: 230px;"></div>
        </div>
    </div>
    </div>
    <script>
        init.push(function () {
            // Easy Pie Charts
            var easyPieChartDefaults = {
                animate: 2000,
                scaleColor: false,
                lineWidth: 6,
                lineCap: 'square',
                size: 90,
                trackColor: '#e5e5e5'
            }
            $('#easy-pie-chart-1').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: LanderApp.settings.consts.COLORS[1]
            }));
            $('#easy-pie-chart-2').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: LanderApp.settings.consts.COLORS[1]
            }));
            $('#easy-pie-chart-3').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: LanderApp.settings.consts.COLORS[1]
            }));
        });
    </script>
    <script>
        init.push(function () {
            var uploads_data =<?php echo json_encode($graphDate) ?>;
            Morris.Line({
                element: 'hero-graph',
                data: uploads_data,
                xkey: 'day',
                ykeys: ['v'],
                min:0,
                gridIntegers:true,
                labels: ['Value'],
                lineColors: ['#fff'],
                lineWidth: 2,
                pointSize: 4,
                gridLineColor: 'rgba(255,255,255,.5)',
                resize: true,
                gridTextColor: '#fff',
                xLabels: "day",
                xLabelFormat: function(d) {
                    return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate();
                }
            });
        });
    </script>
@stop
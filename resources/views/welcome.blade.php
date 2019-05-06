@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-4">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="m-0">Их барилга, хөрөнгө оруулалтын хэлтэс</h4>
                                </div>
                                <div class="col-md-3">
                                    <i class="fa fa-calendar" aria-hidden="true">
                                    <?php
                                    echo "" . date("Y-m-d") . "<br>";

                                    ?>
                                    </i>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.col (right) -->



            <!-- row 2 dood-->
            <div class="row">

                <!-- /.col (left) -->

            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- /.col (LEFT) -->
                <div class="col-md-4">
                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Мэдээлэл</h3>


                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <iframe
                                        style="width:270px;font-size:11px;height:250px;border: none;overflow:hidden;"
                                        src="//monxansh.appspot.com/xansh.html?currency=USD|EUR|JPY|GBP|RUB|CNY|KRW&conv_tool=1"></iframe>
                                <br>
                                <iframe id="forecast_embed" type="text/html" frameborder="0" height="280" width="370" src="http://tsag-agaar.gov.mn/embed/?name=292&color=228ad4&color2=2179b8&color3=ffffff&color4=ffffff&type=vertical&tdegree=cwidth=370"> </iframe>


                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->

                </div>
                <div class="col-md-8">
                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Ажлын үзүүлэлтүүд</h3>


                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="visitors-chart" width="600" height="350"></canvas>
                                    <canvas id="percentchart" width="800" height="450"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="piechart" width="800" height="450"></canvas>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->

                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div>
        </div></section>
@endsection

@section('script')
    <?php
    $stack = array();
    $stackValue = array();
    $stackValue2 = array();
    $depname = array();
    $percent = array();
    foreach($t as $wag)   {array_push($stack,$wag->department_name); array_push($stackValue,$wag->plan);array_push($stackValue2,$wag->budget);
        array_push($depname,$wag->department_name);array_push($percent,$wag->estimation);}

    ?>
<script>
    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold',
            autoSkip: false
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#visitors-chart')
        var zuuchName = <?php echo json_encode($stack); ?>;
        var zuuchQnt = <?php echo json_encode($stackValue); ?>;
        var zuuchQnt2 = <?php echo json_encode($stackValue2); ?>;
        var depname = <?php echo json_encode($depname); ?>;
        var percent = <?php echo json_encode($percent); ?>;
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels:  zuuchName,
                datasets: [{
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',

                    data: depname
                },
                    {
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',

                        fillColor:  getRandomColor(),
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: percent
                    },
                ]
            },
            options: {
                maintainAspectRatio: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: true,
                        ticks: ticksStyle
                    }]
                }
            }
        })

        var $visitorsChart = $('#percentchart')
        var stack = <?php echo json_encode($depname); ?>;
        var stackValue = <?php echo json_encode($percent); ?>;
        var visitorsChart = new Chart($visitorsChart, {
            data: {
                labels: stack,
                datasets: [{
                    type: 'line',
                    data: stackValue,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                    fill: false
                },
                ]
            },
            options: {
                maintainAspectRatio: true,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: 200
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
        new Chart(document.getElementById("piechart"), {
            type: 'pie',
            data: {
                labels: depname,
                datasets: [{
                    label: "Албаны нэр",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: percent
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Хувиар авч үзвэл'
                }
            }
        });
    })
</script>
@endsection

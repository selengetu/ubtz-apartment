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
                                    <h4 class="m-0">{{ trans('messages.ner') }}</h4>
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
                            <h3 class="card-title">{{ trans('messages.medeelel') }}</h3>


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
                            <h3 class="card-title">{{ trans('messages.uzuulelt') }}</h3>


                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="visitors-chart" width="600" height="350"></canvas>
                                    <canvas id="piechart" width="800" height="450"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="detailchart" width="800" height="450"></canvas>

                                    <canvas id="percentchart" width="800" height="450"></canvas>
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
    $depaname = array();
    $rpercent = array();
    $exec = array();
    $execplan = array();
    $execestim= array();

    foreach($t as $wag)

    {array_push($stack,$wag->department_name); array_push($stackValue,$wag->plan);array_push($stackValue2,$wag->budget);
        ;array_push($percent,$wag->estimation); array_push($rpercent,$wag->rpercent);array_push($depaname,$wag->department_id);}


    ?>


    <script>

    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold',
            autoSkip: false
        }

        var mode = 'index'
        var intersect = true


        var zuuchName = <?php echo json_encode($stack); ?>;
        var depaname = <?php echo json_encode($depaname); ?>;
        var zuuchQnt = <?php echo json_encode($stackValue); ?>;
        var zuuchQnt2 = <?php echo json_encode($stackValue2); ?>;
        var percent = <?php echo json_encode($percent); ?>;
        var salesChart = $('#visitors-chart')
        var myChart = new Chart(salesChart, {
            type: 'bar',
            scaleOverride : true,
            scaleSteps : 10,
            scaleStepWidth : 50,
            scaleStartValue : 0,
            data: {
                labels:  zuuchName,
                id:depaname,
                datasets: [{
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: zuuchQnt
                },
                    {
                        backgroundColor: '#ff8400',
                        borderColor: '#ff8400',
                        data: zuuchQnt2
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
                    }],
                    yAxes: [
                        {
                            ticks: {
                                callback: function(label, index, labels) {
                                    return label/1000+' мян';
                                }
                            },
                            scaleLabel: {
                                display: true,
                                labelString: '1мян = 1000'
                            }
                        }
                    ]
                },

            }
        })

        $("#visitors-chart").click(function(e) {
            var activePoints = myChart.getElementAtEvent(e);
            if(activePoints.length > 0)
            {
                //get the internal index of slice in pie chart
                var clickedElementindex = activePoints[0]["_index"];

                //get specific label by index
                var label = myChart.data.labels[clickedElementindex];

                //get value by index
                var value = myChart.data.id[clickedElementindex];
                console.log(value);
                drawchart(value);
                /* other stuff that requires slice's label and value */

            }

        });

        function drawchart($id) {
            var plans=[];
            var est=[];
            var exec=[];
            $.get('chartfill/'+$id,function(data){
                $.each(data,function(i,qwe){
                    console.log(qwe);
                    plans.push(qwe.plan);
                    est.push(qwe.estimation);
                    exec.push(qwe.executor_abbr);

                });
                console.log(plans);
                var $salesChartt = $('#detailchart')
                var detailchart = new Chart($salesChartt, {
                    type: 'bar',
                    scaleSteps: 10,
                    scaleStepWidth: 50,
                    scaleStartValue: 0,
                    data: {
                        labels: exec,
                        datasets: [
                            {
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: plans
                            },
                            {
                                backgroundColor: '#ff8400',
                                borderColor: '#ff8400',
                                data:est
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
                            }],
                            yAxes: [
                                {

                                }
                            ]
                        }
                    }
                })

            });
        }


        var $visitorsChart = $('#percentchart')
        var stack = <?php echo json_encode($stack); ?>;
        var stackValue = <?php echo json_encode($rpercent); ?>;
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
                            suggestedMax: 120
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
                labels: stack,
                datasets: [{
                    label: "Албаны нэр",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: zuuchQnt2
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Гүйцэтгэлийн үнийн дүнгээр авч үзвэл'
                }
            }
        });
    })

</script>

@endsection

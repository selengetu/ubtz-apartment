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
                                    <canvas id="piechart" width="800" height="600"></canvas>
                                    <br><br>
                                    <canvas id="visitors-chart" width="800" height="600"></canvas>

                                </div>
                                <div class="col-md-6">
                                    <canvas id="percentchart" width="800" height="600"></canvas>
                                    <br><br>
                                    <canvas id="detailchart" width="800" height="600"></canvas>


                                </div>
                                <div class="col-md-12">
                                    @foreach($t3 as $name)
                                       <h5> @if ( Config::get('app.locale') == 'mn')  {{$name->project_type_name_mn}}  @elseif (Config::get('app.locale') == 'en')  {{$name->project_type_name_ru}}  @endif  - {{number_format($name->niit, 2, ',', '.')}}% </h5>
                                        @endforeach

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
        $(document).ready(function(){
            drawchart(1);
            var detailchart=null;
            function drawchart($id) {
                var plans=[];
                var est=[];
                var exec=[];
                $.get('chartfill/'+$id,function(data){
                    $.each(data,function(i,qwe){

                        plans.push(qwe.plan);
                        est.push(qwe.estimation);
                        exec.push(qwe.executor_abbr);

                    });

                    if(detailchart!=null){
                        detailchart.destroy();
                    }
                    var salesChartt = $('#detailchart')
                    detailchart = new Chart(salesChartt, {
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
                                    data: plans,
                                    options: options
                                },
                                {
                                    backgroundColor: '#ff8400',
                                    borderColor: '#ff8400',
                                    data:est,
                                    options: options
                                },
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Албадын нэгжийн төлөвлөгөө болон гүйцэтгэл'
                            },
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
                            }
                        }
                    })

                });
            }


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
                            data: zuuchQnt,
                            options: options
                        },
                            {
                                backgroundColor: '#ff8400',
                                borderColor: '#ff8400',
                                data: zuuchQnt2
                            },
                        ]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Албадын төлөвлөгөө болон гүйцэтгэл'
                        },
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

                        drawchart(value);
                        /* other stuff that requires slice's label and value */

                    }

                });




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
                        title: {
                            display: true,
                            text: 'Гүйцэтгэлийн хувиар авч үзвэл'
                        },
                        maintainAspectRatio: true,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: $.extend({
                                    beginAtZero: true,
                                    suggestedMax: 100
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }],

                        }
                    }
                })
                var dynamicColors = function() {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                };
            var options = {
                animation : {
                    onComplete : function(){
                        URI = pieChart.toBase64Image();
                    }
                }
            };
                new Chart(document.getElementById("piechart"), {
                    type: 'pie',
                    data: {
                        labels: stack,
                        datasets: [{
                            label: "Албаны нэр",
                            backgroundColor:  ["#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
                                "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
                                "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
                                "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
                                "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
                                "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
                                "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
                                "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
                                "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
                                "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
                                "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
                                "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
                                "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
                                "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
                                "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec"],
                            data: zuuchQnt2,
                            options: options
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Гүйцэтгэлийн үнийн дүнгээр авч үзвэл'
                        }
                    }
                });

        });


</script>

@endsection

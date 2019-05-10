@extends('layouts.master')

@section('style')

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">


            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">

        <div class="container-fluid">
            <div class="row">


                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card"  style="margin-top: 20px">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Хайлт </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <form method="post" action="searchanalyse">
                                <div class="col-md-12" data-scrollable="true" data-height="400" >
                                    <div class="row" >
                                        <div class="form-group col-md-2">

                                            <label for="inputEmail4">Ажлын төрөл</label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <select class="form-control select2" id="sproject_type" name="sproject_type" >
                                                <option value= "0">Бүгд</option>
                                                @foreach($projecttype as $projecttypes)
                                                    <option value= "{{$projecttypes->project_type_id}}">{{$projecttypes->project_type_name_mn}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2">
                                        <div class="form-group col-md-2">
                                            <label for="inputZip"><span>.</span></label><br>
                                            <button type="submit" class="btn btn-primary" >Хайх</button>

                                        </div>

                                    </div>
                                </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">2019 оны их барилга, их засварын ажлууд </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">

                            <div class="table-responsive">
                                <div class="row">

                                    <div class="col-md-7">
                                        <table class="table table-bordered" id="example" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">
                                            <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>Байгууллага</th>
                                                <th>Төлөвлөгөө</th>
                                                <th>Гүйцэтгэл</th>
                                                <th>Биелэлт</th>
                                                <th>Зөрүү</th>
                                                <th>%</th>


                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($t as $projects)
                                                <tr >
                                                    <td>{{$no}}</td>
                                                    <td>{{$projects->department_name}}</td>

                                                    <td><?php
                                                        echo number_format($projects->plan)."<br>";
                                                        ?></td>

                                                    <td><?php
                                                        echo number_format($projects->budget)."<br>";
                                                        ?></td>


                                                    <td>{{number_format($projects->percent, 2, ',', '.')}}%</td>
                                                    <td><?php
                                                        echo number_format($projects->diff)."<br>";
                                                        ?></td>
                                                    <td></td>


                                                </tr>
                                                <?php $no++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-5">

                                    </div>
                                    <div class="col-md-4">
                                        <canvas id="visitors-chart" width="400" height="250"></canvas>
                                    </div>
                                    <div class="col-md-4">
                                        <canvas id="percentchart" width="800" height="450"></canvas>
                                    </div>
                                    <div class="col-md-4">
                                        <canvas id="piechart" width="800" height="450"></canvas>
                                    </div>
                                </div>
                                <br>


                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12">

                        <!-- /.card -->
                    </div>

                </div>



            </div>
        </div>
        </div>
        </div>

        <!-- /.col (right) -->



        <!-- row 2 dood-->

        </div>
    </section>

@endsection

@section('script')

    @include('layouts.script')
    <?php
    $stack = array();
    $stackValue = array();
    $stackValue2 = array();
    $depname = array();
    $percent = array();
    $rpercent = array();
    foreach($t as $wag)

    {array_push($stack,$wag->department_name); array_push($stackValue,$wag->plan);array_push($stackValue2,$wag->budget);
       ;array_push($percent,$wag->estimation); array_push($rpercent,$wag->rpercent);}

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

            var $salesChart = $('#visitors-chart')
            var zuuchName = <?php echo json_encode($stack); ?>;
            var zuuchQnt = <?php echo json_encode($stackValue); ?>;
            var zuuchQnt2 = <?php echo json_encode($stackValue2); ?>;
            var percent = <?php echo json_encode($percent); ?>;
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                scaleOverride : true,
                scaleSteps : 10,
                scaleStepWidth : 50,
                scaleStartValue : 0,
                data: {
                    labels:  zuuchName,
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
                        }]
                    }
                }
            })
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
@extends('layouts.master')

@section('style')
<style>
    .highlight { background-color: lightskyblue }
</style>
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
                                    <h3 class="card-title">{{ trans('messages.hailt') }} </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <form method="post" @if($sprojecttype ==1 ) action="analyseiz"  @elseif($sprojecttype ==2 ) action="analyseib" @endif>
                                @csrf
                                <div class="col-md-12" data-scrollable="true" data-height="400" >
                                    <div class="row" >
                                        <div class="form-group col-md-2">

                                            <label for="inputEmail4">{{ trans('messages.sar') }}</label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="stype"  id="stype" class="form-control" value="{{$sprojecttype}}">
                                            <input type="text" name="month"  id="stype" class="form-control" value="">
                                        </div>

                                        <div class="form-group col-md-2">
                                        <div class="form-group col-md-2">
                                            <label for="inputZip"><span>.</span></label><br>
                                            <button type="submit" class="btn btn-primary" >{{ trans('messages.haih') }}</button>

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
                                    <h3 class="card-title">{{ trans('messages.ibiz') }} </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">

                            <div class="table-responsive">
                                <div class="row">

                                    <div class="col-md-6">
                                        <table class="table table-bordered" id="example" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">
                                            <thead>
                                            <?php $sum_plan = 0 ?>
                                            <?php $sum_percent = 0 ?>
                                            <?php $sum_rpercent = 0 ?>
                                            <?php $sum_budget = 0 ?>
                                            <?php $sum_diff = 0 ?>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ trans('messages.alba') }}</th>
                                                <th>{{ trans('messages.tuluwluguu') }}</th>
                                                <th>{{ trans('messages.guitsetgel') }}</th>
                                                <th>{{ trans('messages.biylelt') }}</th>
                                                <th>{{ trans('messages.zuruu') }}</th>
                                                <th>%</th>


                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($t as $projects)
                                                <tr id="{{$projects->department_id}}">
                                                    <td>{{$no}}</td>
                                                    <td>{{$projects->department_name}}</td>

                                                    <td><?php
                                                        echo number_format($projects->plan)."<br>";
                                                        ?></td>
                                                    <?php $sum_plan += ($projects->plan) ?>
                                                    <td><?php
                                                        echo number_format($projects->budget)."<br>";
                                                        ?></td>
                                                    <?php $sum_budget += ($projects->budget) ?>

                                                    <td>{{number_format($projects->percent, 2, ',', '.')}}%</td>
                                                    <?php $sum_percent += ($projects->percent) ?>
                                                    <td><?php
                                                        echo number_format($projects->diff)."<br>";
                                                        ?></td>
                                                    <?php $sum_diff += ($projects->diff) ?>
                                                    <td>{{number_format($projects->rpercent, 2, ',', '.')}}%</td>
                                                    <?php $sum_rpercent += ($projects->rpercent) ?>

                                                </tr>
                                                <?php $no++; ?>
                                            @endforeach
                                            <tr>
                                                <td colspan="2">Нийт </td>
                                                <td><?php
                                                    echo number_format($sum_plan)."<br>";
                                                    ?></td>
                                                <td><?php
                                                    echo number_format($sum_budget)."<br>";
                                                    ?></td>
                                                <td>{{number_format($sum_percent/($no-1), 2, ',', '.')}}%</td>
                                                <td><?php
                                                    echo number_format($sum_diff)."<br>";
                                                    ?></td>

                                                <td>{{number_format($sum_rpercent/($no-1), 2, ',', '.')}}%</td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered" id="child" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">
                                            <thead>

                                            <tr role="row">

                                                <th>{{ trans('messages.baiguullaga') }}</th>
                                                <th>{{ trans('messages.tuluwluguu') }}</th>
                                                <th>{{ trans('messages.guitsetgel') }}</th>
                                                <th>{{ trans('messages.biylelt') }}</th>
                                                <th>{{ trans('messages.zuruu') }}</th>
                                                <th>%</th>


                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
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
        $("#example tr").click(function() {
            var selected = $(this).hasClass("highlight");
            $("#example tr").removeClass("highlight");
            var itag = $(this).attr('id');
            var type = $('#stype').val();

            if(!selected)
                $(this).addClass("highlight");
            $.get('chartfillt/'+itag+'/'+type,function(data){
                $("#child tbody").empty();
                $.each(data,function(i,qwe){

                    var sHtmls = "<tr>" +
                        "   <td class='m1'>" + qwe.executor_abbr + "</td>" +
                        "   <td class='m2'>" + qwe.plancomma+ "</td>" +
                        "   <td class='m3'>" + qwe.budgetcomma+ "</td>" +
                        "   <td class='m3'>" + number_format(qwe.percent, 2, ',', '.')+ "</td>" +
                        "   <td class='m3'>" + qwe.diffcomma+ "</td>" +
                        "   <td class='m3'>" + number_format(qwe.rpercent, 2, ',', '.')+ "</td>" +
                        "</tr>";

                    $("#child tbody").append(sHtmls);
                });

            });
        });
        document.getElementById('download-pdf').addEventListener("click", printDiv);

        //donwload pdf from original canvas
        function printDiv() {
            var printContents = document.getElementById('example').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        //add event listener to 2nd button
        document.getElementById('download-pdf2').addEventListener("click", downloadPDF2);

        //download pdf form hidden canvas
        function downloadPDF2() {
            var newCanvas = document.querySelector('#example');

            //create image from dummy canvas
            var newCanvasImg = newCanvas.toDataURL("image/jpeg", 1.0);

            //creates PDF from img
            var doc = new jsPDF('landscape');
            doc.setFontSize(20);
            doc.text(15, 15, "Super Cool Chart");
            doc.addImage(newCanvasImg, 'JPEG', 10, 10, 280, 150 );
            doc.save('new-canvas.pdf');
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
                                suggestedMax: 110
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
                        backgroundColor: ["#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
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
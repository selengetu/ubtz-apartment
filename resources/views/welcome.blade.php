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
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="m-0">Их барилга хөрөнгө, оруулалтын хэлтэс</h4>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo "Today is " . date("Y-m-d") . "<br>";

                                    ?>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <div class="m-scrollable" data-scrollable="true" data-height="400" >
                                <div class="row">
                                    <div class="col-md-2">
                                        <iframe
                                                style="width:270px;font-size:11px;height:210px;border: none;overflow:hidden;"
                                                src="//monxansh.appspot.com/xansh.html?currency=USD|EUR|JPY|GBP|RUB|CNY|KRW&conv_tool=1"></iframe>
                                        <br>
                                        <iframe id="forecast_embed" type="text/html" frameborder="0" height="310" width="370" src="http://tsag-agaar.gov.mn/embed/?name=292&color=228ad4&color2=2179b8&color3=ffffff&color4=ffffff&type=vertical&tdegree=cwidth=370"> </iframe>
                                    </div>
                                    <div class="col-md-1">

                                    </div>

                                    <div class="col-md-4">
                                        <canvas id="bar-chart-grouped" width="600" height="450"></canvas>
                                    </div>
                                    <div class="col-md-3">
                                        <canvas id="pie-chart" width="800" height="450"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
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
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form1" action="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Шинэ ажилтан бүртгэх цонх</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputAddress">Овог</label>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" maxlength="50">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Нэр</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" maxlength="50">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Албан тушаал</label>

                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Хариуцах ажлын үндсэн чиглэл</label>
                                <textarea class="form-control" rows="2" id="mainduty" name="mainduty"></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Ажилд орсон огноо</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="date1" id="date1"
                                       size="16" type="text" value="" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Ажлаас гарсан огноо</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="date2" id="date2"
                                       size="16" type="text" value="" required>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="button" class="btn btn-danger delete">Устгах</button>
                        </div>
                        <div class="col-md-7" style="display: inline-block; text-align: right;" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                            <button type="submit" class="btn btn-primary">Хадгалах</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
                labels: ["1900", "1950", "1999", "2050"],
                datasets: [
                    {
                        label: "Africa",
                        backgroundColor: "#3e95cd",
                        data: [133,221,783,2478]
                    }, {
                        label: "Europe",
                        backgroundColor: "#8e5ea2",
                        data: [408,547,675,734]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions)'
                }
            }
        });
        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
                labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [2478,5267,734,784,433]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });
    </script>
@endsection

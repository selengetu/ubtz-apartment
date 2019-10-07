@extends('layouts.master')

@section('style')
    <style>

    </style>
@endsection

@section('content')


    <section class="content">

        <div class="container-fluid">
            <div class="row">

                <div class="tab-content" id="nav-tabContent">
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
                                <form method="post" action="hurungu">
                                    @csrf
                                    <div class="col-md-12" data-scrollable="true" data-height="400" >
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                                <select class="form-control select2" id="schildabbr_id" name="schildabbr_id">
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($executor as $executors)
                                                        <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                                            @else {{$executors->executor_abbr}}@endif</option>
                                                    @endforeach
                                                </select>

                                            </div>


                                            <div class="form-group col-md-1">
                                                <label for="inputZip"><span>.</span></label><br>
                                                <button type="submit" class="btn btn-primary form-control" >{{ trans('messages.haih') }}</button>

                                            </div>

                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card" >
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">{{ trans('messages.hurungu') }} </h3>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">

                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-info" id="export-btn" onclick="tableToExcel('example', 'Export HTML Table to Excel')"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>


                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive-sm">
                                    <table class="table  table-bordered" id="example">
                                        <thead>
                                        <tr role="row">
                                            <?php $sum_splan = 0 ?>
                                            <?php $sum_plan2 = 0 ?>
                                            <?php $sum_plan1 = 0 ?>
                                            <?php $sum_plan4 = 0 ?>
                                            <?php $sum_plan3 = 0 ?>
                                            <?php $sum_sbudget = 0 ?>
                                            <?php $sum_percent = 0 ?>
                                            <?php $sum_diff = 0 ?>
                                            <th>#</th>
                                            <th width="140px">{{ trans('messages.zahialagch') }}</th>
                                            <th width="100px">{{ trans('messages.tuluwluguu') }}</th>
                                            <th>{{ trans('messages.tuluwluguu1') }}</th>
                                            <th>{{ trans('messages.tuluwluguu2') }}</th>
                                            <th>{{ trans('messages.tuluwluguu3') }}</th>
                                            <th>{{ trans('messages.tuluwluguu4') }}</th>
                                            <th width="120px">{{ trans('messages.guitsetgel') }}</th>
                                            <th width="100px">{{ trans('messages.biylelt') }}</th>
                                            <th width="100px">{{ trans('messages.zuruu') }}</th>
                                            <th width="150px">{{ trans('messages.tailbar') }}</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($hurungu as $hurungus)
                                            <tr >
                                                <td>{{$no}}</td>
                                                <td>{{$hurungus->department_name}}-{{$hurungus->executor_abbr}}</td>
                                                <td><?php
                                                    echo number_format($hurungus->splan)."<br>";
                                                    ?></td>
                                                <?php $sum_splan += ($hurungus->splan) ?>
                                                <td><?php
                                                    echo number_format($hurungus->plan1)."<br>";
                                                    ?></td>
                                                <?php $sum_plan1 += ($hurungus->plan1) ?>
                                                <td><?php
                                                    echo number_format($hurungus->plan2)."<br>";
                                                    ?></td>
                                                <?php $sum_plan2 += ($hurungus->plan2) ?>
                                                <td><?php
                                                    echo number_format($hurungus->plan3)."<br>";
                                                    ?></td>
                                                <?php $sum_plan3 += ($hurungus->plan3) ?>
                                                <td><?php
                                                    echo number_format($hurungus->plan4)."<br>";
                                                    ?></td>
                                                <?php $sum_plan4 += ($hurungus->plan4) ?>
                                                <td><?php
                                                    echo number_format($hurungus->sbudget)."<br>";
                                                    ?></td>
                                                <?php $sum_sbudget += ($hurungus->sbudget) ?>
                                                <td>{{number_format($hurungus->percent, 2, ',', '.')}}%</td>
                                                <?php $sum_percent += ($hurungus->percent) ?>
                                                <td>{{$hurungus->diff}}</td>
                                                <?php $sum_diff += ($hurungus->diff) ?>
                                                <td>{{$hurungus->description}}</td>

                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><b><?php
                                                            echo number_format($sum_splan,2)."<br>";
                                                            ?></b></td>
                                                    <td><b><?php
                                                            echo number_format($sum_plan1,2)."<br>";
                                                            ?></b></td>
                                                    <td><b><?php
                                                            echo number_format($sum_plan2,2)."<br>";
                                                            ?></b></td>
                                                    <td><b><?php
                                                            echo number_format($sum_plan3,2)."<br>";
                                                            ?></b></td>
                                                    <td><b><?php
                                                            echo number_format($sum_plan4,2)."<br>";
                                                            ?></b></td>
                                                    <td><b><?php
                                                            echo number_format($sum_percent,2)."<br>";
                                                            ?></b></td>
                                                    <td><b><?php
                                                            echo number_format($sum_diff,2)."<br>";
                                                            ?></b></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
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
    <script>


        var tableToExcel = (function () {
            var uri = 'data:application/vnd.ms-excel;base64,'
                , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><b>Хөрөнгө оруулалтын тайлан</b></center> </p><table border="1">{table}</table>   <center><b></b></center> <span> ТАЙЛАН ГАРГАСАН:</span><span style="margin-left: 180px"> {{ Auth::user()->name }}</span></body></html>'
                , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
                , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
            return function (table, name) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
                var blob = new Blob([format(template, ctx)]);
                var blobURL = window.URL.createObjectURL(blob);

                if (ifIE()) {
                    csvData = table.innerHTML;
                    if (window.navigator.msSaveBlob) {
                        var blob = new Blob([format(template, ctx)], {
                            type: "text/html"
                        });
                        navigator.msSaveBlob(blob, '' + name + '.xls');
                    }
                }
                else
                    window.location.href = uri + base64(format(template, ctx))
            }
        })()

        function ifIE() {
            var isIE11 = navigator.userAgent.indexOf(".NET CLR") > -1;
            var isIE11orLess = isIE11 || navigator.appVersion.indexOf("MSIE") != -1;
            return isIE11orLess;
        }

        function printDiv() {

            var divToPrint=document.getElementById("example");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
        function preview_image($id){
            $('#image_preview').empty();
            $.get('getimage/'+$id,function(data){
                $.each(data,function(i,qwe){
                    $('#image_preview').append('<img width="100%" src="profile_images/img/' + qwe.img_bname + '" />');
                });
            });
        }
    </script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    @include('layouts.script')
@endsection
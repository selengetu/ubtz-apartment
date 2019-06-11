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
                                        <h3 class="card-title">{{ trans('messages.hailt') }} </h3>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body text-center">
                                <form method="post"  @if($sprojecttype ==1 ) action="main"  @elseif($sprojecttype ==2 ) action="mainib" @endif>
                                    @csrf
                                    <div class="col-md-12" data-scrollable="true" data-height="400" >
                                        <div class="row" >
                                            <div class="form-group col-md-2">

                                                <label for="inputEmail4">{{ trans('messages.sar') }}</label>
                                                <input type="text" name="month"  id="month" value="" class="form-control" maxlength="2">


                                            </div>

                                            <div class="form-group col-md-2">

                                                <label for="inputEmail4">{{ trans('messages.ajliintuluv') }}</label>
                                                <select class="form-control select2" id="sstate_id" name="sstate_id" >
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($state as $states)
                                                        <option value= "{{$states->state_id}}">{{$states->state_name_mn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">{{ trans('messages.zahialagch') }}</label>
                                                <select class="form-control select2" id="sconstructor_id" name="sconstructor_id">
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($constructor as $constructors)
                                                        <option value= "{{$constructors->department_id}}">{{$constructors->department_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputZip">{{ trans('messages.hariutsagch') }}</label>
                                                <select class="form-control select2" id="srespondent_emp_id" name="srespondent_emp_id" >
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($employee as $employees)
                                                        <option value= "{{$employees->emp_id}}">{{$employees->firstname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="inputZip"><span>.</span></label><br>
                                                <button type="submit" class="btn btn-primary" >{{ trans('messages.haih') }}</button>

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
                                        <h3 class="card-title">2019 оны {{$month}} сарын их барилга, их засварын ажлууд </h3>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body text-center">

                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="col-md-10">

                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-info" id="export-btn" onclick="tableToExcel('example2', 'Export HTML Table to Excel')"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>


                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-bordered" id="example" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">
                                        <thead>
                                        <?php $sum_plan = 0 ?>
                                        <?php $sum_estimation = 0 ?>
                                        <?php $sum_bud = 0 ?>
                                        <?php $sum_economic = 0 ?>
                                        <?php $sum_percent = 0 ?>
                                        <?php $sum_bud = 0 ?>
                                        <?php $sum_diff = 0 ?>
                                        <?php $sum_runningtotal = 0 ?>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>{{ trans('messages.zahialagch') }}</th>
                                            <th>{{ trans('messages.guitsetgegch') }}</th>
                                            <th>{{ trans('messages.ajliinner') }}</th>
                                            <th>{{ trans('messages.tuluwluguu') }}</th>

                                            <th>{{ trans('messages.tusuv') }}</th>
                                            <th>{{ trans('messages.enesar') }} {{$month -1 }} {{ trans('messages.ussundun1') }} </th>
                                            <th>{{ trans('messages.enesar') }} {{$month}} {{ trans('messages.ussundun1') }} </th>
                                            <th>{{ trans('messages.ussundun') }} {{$month}} {{ trans('messages.ussundun1') }} </th>
                                            <th>{{ trans('messages.uunees') }}</th>
                                            <th>{{ trans('messages.biylelt') }}</th>
                                            <th>{{ trans('messages.hariutsagch') }}</th>
                                            <th>{{ trans('messages.tailbar') }}</th>
                                            <th colspan="2">{{ trans('messages.photoalbum') }}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($project as $projects)
                                            <tr >
                                                <td>{{$no}}</td>
                                                <td>{{$projects->department_name}}</td>
                                                <td>{{$projects->executor_abbr}}</td>
                                                <td>{{$projects->project_name}}<br>{{$projects->project_name_ru}}</td>
                                                <td><?php
                                                    echo number_format($projects->plan)."<br>";
                                                    ?></td>
                                                <?php $sum_plan += ($projects->plan) ?>
                                                <td><?php
                                                    echo number_format($projects->estimation)."<br>";
                                                    ?></td>
                                                <?php $sum_estimation += ($projects->estimation) ?>
                                                <td><?php
                                                    echo number_format($projects->diff)."<br>";
                                                    ?></td>
                                                <?php $sum_diff += ($projects->diff) ?>
                                                <td><?php
                                                    echo number_format($projects->bud)."<br>";
                                                    ?></td>
                                                <?php $sum_bud += ($projects->bud) ?>
                                                <td><?php
                                                    echo number_format($projects->runningtotal)."<br>";
                                                    ?></td>
                                                <?php $sum_runningtotal += ($projects->runningtotal) ?>

                                                <td><?php
                                                    echo number_format($projects->economic)."<br>";
                                                    ?></td>
                                                <?php $sum_economic += ($projects->economic) ?>
                                                <td>{{$projects->percent}}%</td>
                                                <?php $sum_percent += ($projects->percent) ?>
                                                <td>{{$projects->firstname}}</td>

                                                <td @if($projects->state_id==2)
                                                    bgcolor="#ff8c00";
                                                    @elseif($projects->state_id==1)
                                                    bgcolor="yellow";
                                                    @elseif($projects->state_id==3)
                                                    bgcolor="green";
                                                    @elseif($projects->state_id==4)
                                                    bgcolor="lightgreen";
                                                    @elseif($projects->state_id==5)
                                                    bgcolor="#8a2be2";
                                                    @elseif($projects->state_id==6)
                                                    bgcolor="blue";
                                                    @elseif($projects->state_id==16)
                                                    bgcolor="blue";
                                                    @else
                                                    bgcolor="red";
                                                    @endif
                                                    color="white"
                                                >    <font  @if($projects->state_id==1)
                                                            color="black"; @else color="white"; @endif >{{$projects->state_name_mn}}<br>{{$projects->state_name_ru}}</font></td></td>
                                                <td><img src="<?php echo asset("profile_images/img/$projects->image_b1")?>"  height="100" width="100"></td>
                                                <td><img src="<?php echo asset("profile_images/img/$projects->image_b2")?>" height="100" width="100"></td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                        <tr>

                                            <td><b>Нийт</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php
                                                    echo number_format($sum_plan)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_estimation)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_diff)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_bud)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_runningtotal)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_economic)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo $no-1 == 0 ? 0 : number_format($sum_percent/($no-1),2,",",".")."%<br>";
                                                    ?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>



                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered" id="example2" border="1" style="font-size:12px; width:100%; border-collapse: collapse; display: none">
                                        <thead>
                                        <?php $sum_plan = 0 ?>
                                        <?php $sum_estimation = 0 ?>
                                        <?php $sum_bud = 0 ?>
                                        <?php $sum_economic = 0 ?>
                                        <?php $sum_percent = 0 ?>
                                        <?php $sum_bud = 0 ?>
                                        <?php $sum_diff = 0 ?>
                                        <?php $sum_runningtotal = 0 ?>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>{{ trans('messages.zahialagch') }}</th>
                                            <th>{{ trans('messages.guitsetgegch') }}</th>
                                            <th>{{ trans('messages.ajliinner') }}</th>
                                            <th>{{ trans('messages.tuluwluguu') }}</th>

                                            <th>{{ trans('messages.tusuv') }}</th>
                                            <th>{{ trans('messages.enesar') }} {{$month -1 }} {{ trans('messages.ussundun1') }} </th>
                                            <th>{{ trans('messages.enesar') }} {{$month}} {{ trans('messages.ussundun1') }} </th>
                                            <th>{{ trans('messages.ussundun') }} {{$month}} {{ trans('messages.ussundun1') }} </th>
                                            <th>{{ trans('messages.uunees') }}</th>
                                            <th>{{ trans('messages.biylelt') }}</th>
                                            <th>{{ trans('messages.hariutsagch') }}</th>
                                            <th>{{ trans('messages.tailbar') }}</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($project as $projects)
                                            <tr >
                                                <td>{{$no}}</td>
                                                <td>{{$projects->department_name}}</td>
                                                <td>{{$projects->executor_abbr}}</td>
                                                <td>{{$projects->project_name}}</td>
                                                <td><?php
                                                    echo number_format($projects->plan)."<br>";
                                                    ?></td>
                                                <?php $sum_plan += ($projects->plan) ?>
                                                <td><?php
                                                    echo number_format($projects->estimation)."<br>";
                                                    ?></td>
                                                <?php $sum_estimation += ($projects->estimation) ?>
                                                <td><?php
                                                    echo number_format($projects->diff)."<br>";
                                                    ?></td>
                                                <?php $sum_diff += ($projects->diff) ?>
                                                <td><?php
                                                    echo number_format($projects->bud)."<br>";
                                                    ?></td>
                                                <?php $sum_bud += ($projects->bud) ?>
                                                <td><?php
                                                    echo number_format($projects->runningtotal)."<br>";
                                                    ?></td>
                                                <?php $sum_runningtotal += ($projects->runningtotal) ?>

                                                <td><?php
                                                    echo number_format($projects->economic)."<br>";
                                                    ?></td>
                                                <?php $sum_economic += ($projects->economic) ?>
                                                <td>{{$projects->percent}}%</td>
                                                <?php $sum_percent += ($projects->percent) ?>
                                                <td>{{$projects->firstname}}</td>

                                                <td @if($projects->state_id==2)
                                                    bgcolor="#ff8c00";
                                                    @elseif($projects->state_id==1)
                                                    bgcolor="yellow";
                                                    @elseif($projects->state_id==3)
                                                    bgcolor="green";
                                                    @elseif($projects->state_id==4)
                                                    bgcolor="lightgreen";
                                                    @elseif($projects->state_id==5)
                                                    bgcolor="#8a2be2";
                                                    @elseif($projects->state_id==6)
                                                    bgcolor="blue";
                                                    @elseif($projects->state_id==6)
                                                    bgcolor="blue";
                                                    @else
                                                    bgcolor="red";
                                                    @endif
                                                    color="white"
                                                >    <font  @if($projects->state_id==1)
                                                            color="black"; @else color="white"; @endif >{{$projects->state_name_mn}}</font></td></td>

                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                        <tr>

                                            <td><b>Нийт</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php
                                                    echo number_format($sum_plan)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_estimation)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_diff)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_bud)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_runningtotal)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_economic)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo $no-1 == 0 ? 0 : number_format($sum_percent/($no-1),2,",",".")."%<br>";
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
        $(document).ready(function() {

            const gproject_id = {{ $gproject_id }};
            if (gproject_id != 0) {
                processClicked(gproject_id);
            }



        });

            var tableToExcel = (function () {
                var uri = 'data:application/vnd.ms-excel;base64,'
                    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body>        <p><center><b>Их засварын тайлан</b></center> </p><table border="1">{table}</table>   <center><b></b></center> <span> ТАЙЛАН ГАРГАСАН:</span><span style="margin-left: 180px"> {{ Auth::user()->name }}</span></body></html>'
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
    </script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    @include('layouts.script')
@endsection
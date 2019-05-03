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
                                <form method="post" action="barilga">
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

                                                <label for="inputEmail4">Ажлын төлөв</label>
                                                <select class="form-control select2" id="sstate_id" name="sstate_id" >
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($state as $states)
                                                        <option value= "{{$states->state_id}}">{{$states->state_name_mn}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputEmail4">Захиалагч</label>
                                                <select class="form-control select2" id="sconstructor_id" name="sconstructor_id">
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($constructor as $constructors)
                                                        <option value= "{{$constructors->department_id}}">{{$constructors->department_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputPassword4">Гүйцэтгэгч</label>
                                                <select class="form-control select2" id="sexecutor_id" name="sexecutor_id" >
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($executor as $executors)
                                                        <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputZip">Хариуцагч</label>
                                                <select class="form-control select2" id="srespondent_emp_id" name="srespondent_emp_id" >
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($employee as $employees)
                                                        <option value= "{{$employees->emp_id}}">{{$employees->firstname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputZip"><span>.</span></label><br>
                                                <button type="submit" class="btn btn-primary" >Хайх</button>

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
                                        <div class="col-md-10">

                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-info" id="export-btn" onclick="tableToExcel('example', 'Export HTML Table to Excel')"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>
                                            <button class="btn btn-info" id="buttonprint" onclick="printDiv()"><i class="fa fa-print" aria-hidden="true"></i> Хэвлэх</button>

                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-bordered" id="example" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">
                                        <thead>
                                        <?php $sum_plan = 0 ?>
                                        <?php $sum_estimation = 0 ?>
                                        <?php $sum_budget = 0 ?>
                                        <?php $sum_economic = 0 ?>
                                        <?php $sum_percent = 0 ?>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>Захиалагч</th>
                                            <th>Гүйцэтгэгч</th>
                                            <th>Ажлын нэр</th>
                                            <th>Төлөвлөгөө</th>

                                            <th>Төсөв</th>
                                            <th>Эхний 10 сарын </th>
                                            <th>Энэ сарын </th>
                                            <th>Эхний 11 сарын өссөн дүн </th>
                                            <th>Үүнээс</th>
                                            <th>Биелэлт</th>
                                            <th>Хариуцагч инженер</th>
                                            <th>Тайлбар</th>
                                            <th colspan="2">Зурган тайлан</th>

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
                                                    echo number_format($projects->budget)."<br>";
                                                    ?></td>
                                                <td></td>
                                                <td></td>
                                                <?php $sum_budget += ($projects->budget) ?>
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
                                                    @else
                                                    bgcolor="red";
                                                    @endif
                                                    color="white"
                                                >    <font  @if($projects->state_id==1)
                                                            color="black"; @else color="white"; @endif >{{$projects->state_name_mn}}</font></td></td>
                                                <td><img src="<?php echo asset("profile_images/img/$projects->image_b1")?>" alt="profile Pic" height="100" width="100"></td>
                                                <td><img src="<?php echo asset("profile_images/img/$projects->image_b2")?>" alt="profile Pic" height="100" width="100"></td>
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
                                                    echo number_format($sum_budget)."<br>";
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
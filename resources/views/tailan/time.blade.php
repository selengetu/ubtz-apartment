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
                            <form method="post" action="time">
                                <div class="col-md-12" data-scrollable="true" data-height="400" >
                                    <div class="row" >
                                        <div class="form-group col-md-2">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="projtype" id="projtype" value="{{$sprojecttype}}">
                                            <input type="hidden" name="stat" id="stat" value="{{$sstate_id}}">
                                            <input type="hidden" name="construc" id="construc" value="{{$sconstructor}}">
                                            <input type="hidden" name="exec" id="exec" value="{{$sexecutor}}">
                                            <input type="hidden" name="resp" id="resp" value="{{$srespondent_emp_id}}">

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
                                    <h3 class="card-title">Ажлын хугацааны тайлан </h3>
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
                                        <button class="btn btn-info" id="export-btn"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>


                                    </div>
                                </div>
                                <br>
                                <table class="table table-bordered" id="example" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Байгууллага</th>
                                        <th>Гүйцэтгэгч</th>
                                        <th width="400px">Ажлын нэр</th>
                                        <th >Төлөвлөгөө</th>

                                        <th>Гэрээний дүн</th>

                                        <th>Биелэлт</th>
                                        <th style="width: 55px">Графикийн дагуу дуусах огноо</th>
                                        <th style="width: 55px">Дууссан огноо</th>
                                        <th style="width: 55px">Хэтэрсэн хоног</th>
                                        <th>Тайлбар</th>

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

                                            <td><?php
                                                echo number_format($projects->budget)."<br>";
                                                ?></td>

                                            <td>{{$projects->percent}}%</td>

                                            <td>{{$projects->end_date}} </td>
                                            <td width="45px">{{$projects->prend_date}}</td>
                                            <td> {{$projects->diff}}</td>
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
                                                        color="black"; @else color="white"; @endif >{{$projects->state_name_mn}}</font></td>

                                        </tr>
                                        <?php $no++; ?>
                                    @endforeach
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
            $('#smethod_id').val($('#meth').val()).trigger('change');
            $('#sproject_type').val($('#projtype').val()).trigger('change');
            $('#sexecutor_id').val($('#exec').val()).trigger('change');
            $('#srespondent_emp_id').val($('#resp').val()).trigger('change');
            $('#sconstructor_id').val($('#construc').val()).trigger('change');
            $('#sstate_id').val($('#stat').val()).trigger('change');
            const gproject_id = {{ $gproject_id }};
            if (gproject_id != 0) {
                processClicked(gproject_id);
            }
            $('#export-btn').on('click', function(e){
                $("#example").table2excel({

                    exclude: ".noExl",
                    name: "Worksheet Name",
                    filename: "SomeFile" //do not include extension
                });
            });


        });
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
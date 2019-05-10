@extends('layouts.master')

@section('style')
<style>

</style>
@endsection

@section('content')


    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Ажил</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Гүйцэтгэл</a>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
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
                                    <div class="row">
                                        <div class="form-group col-md-2">

                                            <label for="inputEmail4">Ажлын төрөл</label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="projtype" id="projtype" value="{{$sprojecttype}}">
                                            <input type="hidden" name="stat" id="stat" value="{{$sstate_id}}">
                                            <input type="hidden" name="construc" id="construc" value="{{$sconstructor}}">
                                            <input type="hidden" name="exec" id="exec" value="{{$sexecutor}}">
                                            <input type="hidden" name="resp" id="resp" value="{{$srespondent_emp_id}}">
                                            <input type="hidden" name="meth" id="meth" value="{{$smethod_id}}">
                                            <input type="hidden" name="child" id="child" value="{{$schildabbr}}">
                                            <select class="form-control select2" id="sproject_type" name="sproject_type">
                                                <option value= "0">Бүгд</option>
                                                @foreach($projecttype as $projecttypes)
                                                    <option value= "{{$projecttypes->project_type_id}}">{{$projecttypes->project_type_name_mn}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">

                                            <label for="inputEmail4">Ажлын арга</label>
                                            <select class="form-control select2" id="smethod_id" name="smethod_id" >
                                                <option value= "0">Бүгд</option>
                                                @foreach($method as $methods)
                                                    <option value= "{{$methods->method_code}}">{{$methods->method_name}}</option>
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
                                            <label for="inputEmail4">Захиалагч нэгж</label>
                                            <select class="form-control select2" id="schildabbr_id" name="schildabbr_id">
                                                <option value= "0">Бүгд</option>
                                                @foreach($executor as $executors)
                                                    <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
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
                                        <div class="form-group col-md-1">
                                            <label for="inputZip"><span>.</span></label><br>
                                            <button type="submit" class="btn btn-primary form-control" >Хайх</button>

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
                                        <h3 class="card-title">2019 оны их барилга, их засварын ажлууд </h3>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#exampleModal" id="addproj">
                                            <i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Их барилга, их засварын ажил бүртгэх</i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive-sm">
                                    <table class="table  table-bordered" id="example">
                                        <thead>
                                        <tr role="row">
                                            <?php $sum_plan = 0 ?>
                                            <?php $sum_estimation = 0 ?>
                                            <?php $sum_budget = 0 ?>
                                            <?php $sum_economic = 0 ?>
                                            <?php $sum_percent = 0 ?>

                                            <th>#</th>
                                            <th>Захиалагч</th>
                                            <th>Гүйцэтгэгч</th>
                                            <th width="400px">Ажлын нэр</th>
                                            <th>Төлөвлөгөө</th>

                                            <th>Төсөв</th>
                                            <th>Гүйцэтгэл</th>
                                            <th>Үүнээс хаасан</th>
                                            <th>Биелэлт</th>
                                            <th>Хариуцагч инженер</th>
                                            <th>Эхлэх огноо</th>
                                            <th>Дуусах огноо</th>

                                            <th>Тайлбар</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($project as $projects)
                                            <tr >
                                                <td>{{$no}}</td>
                                                <td>{{$projects->department_name}} - {{$projects->childabbr}}</td>
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
                                                    echo number_format($projects->budget)."<br>";
                                                    ?></td>
                                                <?php $sum_budget += ($projects->budget) ?>
                                                <td><?php
                                                    echo number_format($projects->economic)."<br>";
                                                    ?></td>
                                                <?php $sum_economic += ($projects->economic) ?>
                                                <td>{{$projects->percent}}%</td>
                                                <?php $sum_percent += ($projects->percent) ?>
                                                <td>{{$projects->firstname}}</td>
                                                <td width="45px">{{$projects->start_date}}
                                                <td>{{$projects->end_date}}
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
                                                >
                                                    <font  @if($projects->state_id==1)
                                                           color="black"; @else color="white"; @endif >{{$projects->state_name_mn}}</font></td>
                                                <td>
                                                    @if (Auth::user()->user_grant !=6 or Auth::user()->id ==$projects->added_user_id or Auth::user()->emp_id ==$projects->respondent_emp_id)
                                                        <button onclick="processClicked({{$projects->project_id}})"{{-- onclick="$('#nav-profile-tab').trigger('click')" --}} data-id="{{$projects->project_id}}" tag="{{$projects->project_id}}" class="btn btn-primary btn-sm process"> <i class="fa fa-plus" style="color: rgb(255, 255, 255);"></i></button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($projects->is_approved == 0 )
                                                    @if (Auth::user()->user_grant !=6 or Auth::user()->id ==$projects->added_user_id or Auth::user()->emp_id ==$projects->respondent_emp_id )
                                                        <button type="button" class="btn btn-warning btn-sm update" data-toggle="modal"  data-id="{{$projects->project_id}}" tag="{{$projects->project_id}}"  data-target="#exampleModal" id="updateproj" onclick="updateproj({{$projects->project_id}})">
                                                            <i class="fa fa-pencil" style="color: rgb(255, 255, 255);"></i>
                                                        </button>
                                                    @endif
                                                        @endif
                                                </td>
                                            </tr>
                                            <?php $no++; ?>

                                        @endforeach

                                        </tbody>
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
                                            <td></td>
                                            <td></td>

                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

<hr>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card" style="margin-top: 20px">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Их барилга, их засварын ажил </h3>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body text-center" >
                                <div class="col-md-12">
                                    <div class="table-responsive" data-scrollable="true" data-height="400" >
                                        <table class="table table-striped table-bordered" id="projecttable">
                                            <thead>
                                            <tr role="row">

                                                <th>Байгууллага</th>
                                                <th>Гүйцэтгэгч</th>
                                                <th width="400px">Ажлын нэр</th>
                                                <th width="85px">Төлөвлөгөө</th>
                                                <th width="85px">Төсөв</th>
                                                <th width="85px">Гүйцэтгэл</th>
                                                <th width="85px">Үүнээс</th>
                                                <th>Биелэлт</th>
                                                <th>Хариуцагч инженер</th>
                                                <th>Эхлэх огноо</th>
                                                <th>Дуусах огноо</th>
                                                <th width="100px">Тайлбар</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card" style="margin-top: 20px;" >
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Их барилга, их засварын ажлын гүйцэтгэл</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#processmodal" id="addproc">
                                            <i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Гүйцэтгэл бүртгэх</i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body text-center" >

                                <div class="table-responsive" data-scrollable="true" data-height="400" >
                                    <table class="table table-striped table-bordered" id="processtable">
                                        <thead>
                                        <tr role="row">

                                            <th>Тооцох он сар</th>
                                            <th>Гүйцэтгэл</th>
                                            <th>Тайлбар</th>
                                            <th>Зураг</th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table class="table" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Project Name2</th>
                                <th>Employer</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="#">Work 1</a></td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            <tr>
                                <td><a href="#">Work 2</a></td>
                                <td>Moe</td>
                                <td>mary@example.com</td>
                            </tr>
                            <tr>
                                <td><a href="#">Work 3</a></td>
                                <td>Dooley</td>
                                <td>july@example.com</td>
                            </tr>
                            </tbody>
                        </table>
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
    <div class="modal fade " id="exampleModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form1" method="post" action="addproject">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Их барилга, их засварын ажил бүртгэх цонх</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <label for="inputEmail4">Ажлын төрөл</label>
                                <select class="form-control select2" id="project_type" name="project_type">
                                    @foreach($projecttype as $projecttypes)
                                        <option value= "{{$projecttypes->project_type_id}}">{{$projecttypes->project_type_name_mn}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Ажлын арга</label>
                                <select class="form-control select2" id="method_code" name="method_code">
                                    @foreach($method as $methods)
                                        <option value= "{{$methods->method_code}}">{{$methods->method_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Захиалагч</label>
                                <select class="form-control select2" id="constructor_id" name="constructor_id">
                                    @foreach($constructor as $constructors)
                                        <option value= "{{$constructors->department_id}}">{{$constructors->department_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Захиалагч нэгж</label>
                                <select class="form-control select2" id="childabbr_id" name="childabbr_id">
                                    <option value= "0">Бүгд</option>
                                    @foreach($executor as $executors)
                                        <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Гүйцэтгэгч</label>
                                <select class="form-control select2" id="executor_id" name="executor_id">
                                    <option value= "999">Тодорхойгүй</option>
                                    @foreach($executor as $executors)
                                        <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-group col-md-9">
                                <label for="inputAddress">Ажлын нэр</label>
                                <textarea class="form-control" rows="1" id="project_name" name="project_name"></textarea>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputZip">Хариуцагч</label>
                                <select class="form-control select2" id="respondent_emp_id" name="respondent_emp_id" @if(Auth::user()->user_grant == 6) disabled="true"@endif>
                                    <option value= "999">Тодорхойгүй</option>
                                @foreach($employee as $employees)
                                    <option value= "{{$employees->emp_id}}">{{$employees->firstname}} {{$employees->fletter}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="inputAddress">Ажлын нэр /Орос/</label>
                                <textarea class="form-control" rows="1" id="project_name_ru" name="project_name_ru"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Төлөвлөгөө</label>
                                <input type="text" class="form-control money" id="plan" name="plan" placeholder="" maxlength="14">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">Үүнээс хаасан</label>
                                <input type="text" class="form-control money" id="economic" name="economic" maxlength="14">
                            </div>

                        </div>

                    <div class="form-group col-md-6">
                        <label for="inputCity">Төсөв</label>
                        <input type="text" class="form-control money" id="estimation" name="estimation" maxlength="14"  @if(Auth::user()->user_grant == 3 or Auth::user()->user_grant == 5 or Auth::user()->user_grant == 6) readonly="true"@endif>
                    </div>

                        <div class="form-row">



                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Төлөвлөгөөт эхлэх огноо</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="date1" id="date1"
                                       size="16" type="text" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Төлөвлөгөөт дуусах огноо</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="date2" id="date2"
                                       size="16" type="text" value="">
                            </div>


                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <label for="inputZip">Тайлбар</label>
                            <textarea class="form-control" rows="2" id="description" name="description" maxlength="500"></textarea>
                        </div>
                    </div>

                </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="button" class="btn btn-danger delete" id="deleteproj">Устгах</button>
                            <button type="submit" class="btn btn-primary">Хадгалах</button>
                        </div>
                        <div class="col-md-7" style="display: inline-block; text-align: right;" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade " id="processmodal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form2" method="post" action="addprocess" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title1">Их барилга, их засварын ажлын гүйцэтгэл бүртгэх цонх</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="gprocess_id" name="gprocess_id">
                                <input type="hidden" class="form-control" id="gproject_id" name="gproject_id">
                                <label for="inputEmail4">Тооцох он</label>
                                <input type="text"  class="form-control year" id="gyear" name="gyear">

                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">Сар</label>
                                <input type="text"  class="form-control month" id="gmonth" name="gmonth">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Гүйцэтгэл</label>
                                <input type="text" class="form-control money" id="gbudget" name="gbudget" maxlength="14">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">Төлөв</label>
                                <select class="form-control select2" id="gstate_id" name="gstate_id" >
                                    @foreach($state as $states)
                                        <option value= "{{$states->state_id}}">{{$states->state_name_mn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="gpercentdiv">
                                <label for="inputZip">Биелэлт</label>
                                <input type="text" class="form-control" id="gpercent" name="gpercent" placeholder="99.9" maxlength="4">
                            </div>
                            <div class="form-group col-md-3" id="gdatediv">
                                <label for="inputZip">Дууссан огноо</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="gdate" id="gdate" placeholder="2019-04-15">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputZip">Тайлбар</label>
                                <textarea class="form-control" rows="2" id="gdescription" name="gdescription" maxlength="500"></textarea>
                            </div>

                                <div class="col-md-6">
                                    @if ($message = Session::get('success'))

                                        <div class="alert alert-success alert-block">

                                            <button type="button" class="close" data-dismiss="alert">×</button>

                                            <strong>{{ $message }}</strong>

                                        </div>

                                        <img src="images/{{ Session::get('image') }}">

                                    @endif



                                    @if (count($errors) > 0)

                                        <div class="alert alert-danger">

                                            <strong>Whoops!</strong> There were some problems with your input.

                                            <ul>

                                                @foreach ($errors->all() as $error)

                                                    <li>{{ $error }}</li>

                                                @endforeach

                                            </ul>

                                        </div>

                                    @endif
                                    <input type="file" name="image" class="form-control">

                                </div>



                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="button" id="deleteproc" class="btn btn-danger delete">Устгах</button>
                            <button type="button" id="approveproc" class="btn btn-info">Батлах</button>
                            <button type="submit" class="btn btn-primary" id="addprocessbutton">Хадгалах</button>
                        </div>
                        <div class="col-md-7" style="display: inline-block; text-align: right;" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $("#method_code").on('change', function() {
            var itag =$(this).val();

            $.get('getexec/'+itag,function(data){
                $('#executor_id').empty();

                $.each(data,function(i,qwe){
                    $('#executor_id').append($('<option>', {
                        value: qwe.executor_id,
                        id: qwe.executor_id,
                        text: qwe.executor_name
                    }));
                    $('#executor_id').focus();
                });
            });

        });

        $(function() {
            $("#date1").datepicker({
                format: 'yyyy-mm-dd',
                todayBtn:  1,
                autoclose: true,
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#date2').datepicker('setStartDate', minDate);
            });

            $("#date2").datepicker({
                format: 'yyyy-mm-dd',
            })
                .on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $('#date1').datepicker('setEndDate', minDate);
                });
        });
        $(document).ready(function() {
            $('#smethod_id').val($('#meth').val()).trigger('change');
            $('#sproject_type').val($('#projtype').val()).trigger('change');
            $('#sexecutor_id').val($('#exec').val()).trigger('change');
            $('#srespondent_emp_id').val($('#resp').val()).trigger('change');
            $('#sconstructor_id').val($('#construc').val()).trigger('change');
            $('#sstate_id').val($('#stat').val()).trigger('change');
            $('#schildabbr_id').val($('#child').val()).trigger('change');
            const gproject_id = {{ $gproject_id }};
            if(gproject_id != 0){
                processClicked( gproject_id);
            }
            $('#example').dataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                "language": {
                    "lengthMenu": " _MENU_ бичлэг",
                    "zeroRecords": "Бичлэг олдсонгүй",
                    "info": "_PAGE_ ээс _PAGES_ хуудас" ,
                    "infoEmpty": "Бичлэг олдсонгүй",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Хайлт:",
                    "paginate": {
                        "first":      "Эхнийх",
                        "last":       "Сүүлийнх",
                        "next":       "Дараагийнх",
                        "previous":   "Өмнөх"
                    },
                },
                "pageLength": 50
            } );
            $('#export-btn').on('click', function(e){
                $("#example").table2excel({

                    exclude: ".noExl",
                    name: "Worksheet Name",
                    filename: "SomeFile" //do not include extension
                });
            });
            function printDiv() {

                var divToPrint=document.getElementById("example");
                newWin= window.open("");
                newWin.document.write(divToPrint.outerHTML);
                newWin.print();
                newWin.close();
            }
        } );
    </script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    @include('layouts.script')
@endsection
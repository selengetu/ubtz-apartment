@extends('layouts.master')

@section('style')
<style>

</style>
@endsection

@section('content')


    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <nav style="width:500px">
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{ trans('messages.ajil') }}</a>
                        <a class="nav-item nav-link disabled disabledTab" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">{{ trans('messages.guitsetgel') }}</a>

                    </div>
                </nav>
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
                            <form method="post" @if($sprojecttype ==1 ) action="zaswar"  @elseif($sprojecttype ==2 ) action="barilga" @endif>
                                <div class="col-md-12" data-scrollable="true" data-height="400" >
                                    <div class="row">

                                        <div class="form-group col-md-2">

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="projtype" id="projtype" value="{{$sprojecttype}}">
                                            <input type="hidden" name="stat" id="stat" value="{{$sstate_id}}">
                                            <input type="hidden" name="construc" id="construc" value="{{$sconstructor}}">
                                            <input type="hidden" name="exec" id="exec" value="{{$sexecutor}}">
                                            <input type="hidden" name="resp" id="resp" value="{{$srespondent_emp_id}}">
                                            <input type="hidden" name="meth" id="meth" value="{{$smethod_id}}">
                                            <input type="hidden" name="child" id="child" value="{{$schildabbr}}">
                                            <label for="inputEmail4">{{ trans('messages.ajliinarga') }}</label>
                                            <select class="form-control select2" id="smethod_id" name="smethod_id" >
                                                <option value= "0">Бүгд</option>
                                                @foreach($method as $methods)
                                                    <option value= "{{$methods->method_code}}">{{$methods->method_name}}</option>
                                                @endforeach
                                            </select>
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
                                            <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                            <select class="form-control select2" id="schildabbr_id" name="schildabbr_id">
                                                <option value= "0">Бүгд</option>
                                                @foreach($executor as $executors)
                                                    <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                                        @else {{$executors->executor_abbr}}@endif</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4">{{ trans('messages.guitsetgegch') }}</label>
                                            <select class="form-control select2" id="sexecutor_id" name="sexecutor_id" >
                                                <option value= "0">Бүгд</option>
                                                @foreach($executor as $executors)
                                                    <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                                        @else {{$executors->executor_abbr}}@endif</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">{{ trans('messages.hariutsagch') }}</label>
                                            <select class="form-control select2" id="srespondent_emp_id" name="srespondent_emp_id" >
                                                <option value= "0">Бүгд</option>
                                                <option value= "999">Тодорхойгүй</option>
                                                @foreach($employee as $employees)
                                                    <option value= "{{$employees->emp_id}}">{{$employees->fletter}}.{{$employees->firstname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputAddress2">{{ trans('messages.ehelsen') }}</label>
                                            <input class="form-control form-control-inline input-medium date-picker" name="sdate1" id="sdate1"
                                                   size="16" type="text" value="">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputCity">{{ trans('messages.duusah') }}</label>
                                            <input class="form-control form-control-inline input-medium date-picker" name="sdate2" id="sdate2"
                                                   size="16" type="text" value="">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputCity">{{ trans('messages.tuluwluguu') }}</label>
                                            <input class="form-control money" name="stuluvluguu" id="stuluvluguu"
                                                   size="16" type="text" value="{{$stuluvluguu}}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputCity">{{ trans('messages.tusuv') }}</label>
                                            <input class="form-control money" name="stusuv" id="stusuv"
                                                   size="16" type="text" value="{{$stusuv}}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputCity">{{ trans('messages.guitsetgel') }}</label>
                                            <input class="form-control money" name="sguitsetgel" id="sguitsetgel"
                                                   size="16" type="text" value="{{$sguitsetgel}}">
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
                                        <h3 class="card-title">{{ trans('messages.ibiz') }} </h3>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#exampleModal" id="addproj">
                                            <i class="fa fa-plus" style="color: rgb(255, 255, 255);"> {{ trans('messages.burtgeh') }}</i>
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
                                            <th>{{ trans('messages.zahialagch') }}</th>
                                            <th>{{ trans('messages.guitsetgegch') }}</th>
                                            <th width="300px">{{ trans('messages.ajliinner') }}</th>
                                            <th>{{ trans('messages.tuluwluguu') }}</th>
                                            <th>{{ trans('messages.tusuv') }}</th>
                                            <th>{{ trans('messages.guitsetgel') }}</th>
                                            <th>{{ trans('messages.uunees') }}</th>
                                            <th>{{ trans('messages.biylelt') }}</th>
                                            <th>{{ trans('messages.hariutsagch') }}</th>
                                            <th>{{ trans('messages.ehelsen') }}</th>
                                            <th>{{ trans('messages.duusah') }}</th>

                                            <th width="300px">{{ trans('messages.tailbar') }}</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($project as $projects)
                                            <tr >
                                                <td>{{$no}}</td>
                                                <td>@if($projects->executor_type !=2) {{$projects->childabbr}} @else {{$projects->department_name}} - {{$projects->childabbr}}  @endif</td>
                                                <td>@if($projects->method_code==3)
                                                     По договору
                                                    @else
                                                    {{$projects->executor_abbr}}
                                                        @endif
                                                </td>
                                                <td>{{$projects->project_name}}<br>{{$projects->project_name_ru}}</td>
                                                <td> <a href="#" title="Улирлын төлөвлөгөө: {{$projects->plan1." ,". $projects->plan2." ,". $projects->plan3." ,". $projects->plan4}}"><?php
                                                    echo number_format($projects->plan,2)."<br>";
                                                    ?></a></td>
                                                <?php $sum_plan += ($projects->plan) ?>
                                                <td><?php
                                                    echo number_format($projects->estimation,2)."<br>";
                                                    ?></td>
                                                <?php $sum_estimation += ($projects->estimation) ?>
                                                <td><?php
                                                    echo number_format($projects->budget,2)."<br>";
                                                    ?></td>
                                                <?php $sum_budget += ($projects->budget) ?>
                                                <td><?php
                                                    echo number_format($projects->economic,2)."<br>";
                                                    ?></td>
                                                <?php $sum_economic += ($projects->economic) ?>
                                                <td>{{$projects->percent}}%</td>
                                                <?php $sum_percent += ($projects->percent) ?>
                                                <td>{{$projects->fletter}}.{{$projects->firstname}}</td>
                                                <td> <a href="#" title="Төлөвлөгөөт улирал : {{$projects->season_name}}">
                                                        {{$projects->start_date}}</a></td>
                                                <td>{{$projects->end_date}}</td>
                                                <td width="102px" @if($projects->state_id==2)
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
                                                @endif>
                                                    <font  @if($projects->state_id==1)
                                                           color="black"; @else color="white"; @endif >{{$projects->state_name_mn}}<br> {{$projects->state_name_ru}}@if($projects->prend_date!=NULL && $projects->state_id==1) <br> {{$projects->prend_date}} @endif<br>{{$projects->description}}</font></td>
                                                <td>

                                                    @if (Auth::user()->dep_id ==22 )
                                                    @if (Auth::user()->user_grant !=6 or Auth::user()->id ==$projects->added_user_id or Auth::user()->emp_id ==$projects->respondent_emp_id)
                                                        <button onclick="processClicked({{$projects->project_id}})"{{-- onclick="$('#nav-profile-tab').trigger('click')" --}} data-id="{{$projects->project_id}}" tag="{{$projects->project_id}}" class="btn btn-primary btn-sm process"> <i class="fa fa-plus" style="color: rgb(255, 255, 255);"></i></button>
                                                    @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (Auth::user()->dep_id ==22 )
                                                    @if (Auth::user()->user_grant !=6 or Auth::user()->id ==$projects->added_user_id or Auth::user()->emp_id ==$projects->respondent_emp_id )
                                                        <button type="button" class="btn btn-warning btn-sm update" data-toggle="modal"  data-id="{{$projects->project_id}}" tag="{{$projects->project_id}}"  data-target="#exampleModal" id="updateproj" onclick="updateproj({{$projects->project_id}})">
                                                            <i class="fa fa-pencil" style="color: rgb(255, 255, 255);"></i>
                                                        </button>
                                                    @endif
                                                        @endif
                                                </td>

                                                <td> @if (Auth::user()->dep_id ==22 ) <button type="button" class="btn btn-danger delete btn-sm" id="deleteproj" onclick="deleteproj({{$projects->project_id}})">  <i class="fa fa-trash" style="color: rgb(255, 255, 255);"></i></button> @endif</td>
                                            </tr>
                                            <?php $no++; ?>

                                        @endforeach

                                        </tbody>
                                        <tr>

                                            <td><b>{{ trans('messages.niit') }}</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php
                                                    echo number_format($sum_plan,2)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_estimation,2)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_budget,2)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    echo number_format($sum_economic,2)."<br>";
                                                    ?></b></td>
                                            <td><b><?php
                                                    if($sum_budget > 0 && $sum_plan){
                                                    echo number_format((($sum_budget)/($sum_plan)*100), 2, ',', ' ')."%<br>"; }
                                                    ?></b></td>
                                            <td></td>
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
                                        <h3 class="card-title"> {{ trans('messages.ibiz') }}</h3>
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

                                                <th>{{ trans('messages.hariutsagch') }}</th>
                                                <th>{{ trans('messages.guitsetgegch') }}</th>
                                                <th width="400px">{{ trans('messages.ajliinner') }}</th>
                                                <th width="85px">{{ trans('messages.tuluwluguu') }}</th>
                                                <th width="85px">{{ trans('messages.tusuv') }}</th>
                                                <th width="85px">{{ trans('messages.guitsetgel') }}</th>
                                                <th width="85px">{{ trans('messages.uunees') }}</th>
                                                <th>{{ trans('messages.biylelt') }}</th>
                                                <th>{{ trans('messages.hariutsagch') }}</th>
                                                <th>{{ trans('messages.tuvehleh') }}</th>
                                                <th>{{ trans('messages.tuvduusah') }}</th>
                                                <th>{{ trans('messages.tailbar') }}</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <br>
                                        <table class="table table-striped table-bordered" id="plantable">
                                            <thead>
                                            <tr role="row">

                                                <th>Жилийн төлөвлөгөө</th>
                                                <th>1-р улирал</th>
                                                <th>2-р улирал</th>
                                                <th>3-р улирал</th>
                                                <th>4-р улирал</th>
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
                                        <h3 class="card-title">{{ trans('messages.ajliinguits') }}</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#processmodal" id="addproc">
                                            <i class="fa fa-plus" style="color: rgb(255, 255, 255);"> {{ trans('messages.guitsnemeh') }}</i>
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

                                            <th>{{ trans('messages.tootsoh') }}</th>
                                            <th>{{ trans('messages.guitsetgel') }}</th>
                                            <th>{{ trans('messages.ajliintuluv') }}</th>
                                            <th>{{ trans('messages.tailbar') }}</th>
                                            <th>{{ trans('messages.ajliinguits') }}</th>
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
                <form method="post" id="form1">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">{{ trans('messages.tsonh') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="type" name="type">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="hidden" class="form-control" id="proj" name="proj" value="{{$sprojecttype}}">
                                <label for="inputEmail4">{{ trans('messages.ajliinarga') }}</label>
                                <select class="form-control" id="method_code" name="method_code">
                                    @foreach($method as $methods)
                                        <option value= "{{$methods->method_code}}">{{$methods->method_name}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                <select class="form-control" id="childabbr_id" name="childabbr_id">
                                    <option value= "0">Бүгд</option>
                                    @foreach($executor as $executors)
                                        <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                            @else {{$executors->executor_abbr}}@endif</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">{{ trans('messages.guitsetgegch') }}</label>
                                <select class="form-control" id="executor_id" name="executor_id">
                                    <option value= "999">Тодорхойгүй</option>
                                    <option value= "0">Бүгд</option>
                                    @foreach($executor as $executors)
                                        <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                            @else {{$executors->executor_abbr}}@endif</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-group col-md-8">
                                <label for="inputAddress">{{ trans('messages.ajliinner') }}</label>
                                <textarea class="form-control" rows="1" id="project_name" name="project_name"></textarea>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputZip">{{ trans('messages.hariutsagch') }}</label>
                                <select class="form-control select2" id="respondent_emp_id" name="respondent_emp_id" @if(Auth::user()->user_grant == 6) disabled="true"@endif>
                                    <option value= "999">Тодорхойгүй</option>
                                @foreach($employee as $employees)
                                    <option value= "{{$employees->emp_id}}">{{$employees->firstname}} {{$employees->fletter}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputAddress">{{ trans('messages.ajliinner') }} /Русс/</label>
                                <textarea class="form-control" rows="1" id="project_name_ru" name="project_name_ru"></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">{{ trans('messages.season') }}</label>
                                <select class="form-control select2" id="season" name="season">
                                    @foreach($season as $rp)
                                        <option value= "{{$rp->season_id}}">{{$rp->season_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu') }}</label>
                                <input type="text" class="form-control money" id="plan" name="plan" placeholder="" maxlength="20" @if (Auth::user()->user_grant !=3) readonly="true" @endif>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">{{ trans('messages.tusuv') }}</label>
                                <input type="text" class="form-control money" id="estimation" name="estimation" maxlength="20">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu1') }}</label>
                                <input type="text" class="form-control money" id="plan1" name="plan1" placeholder="" maxlength="20">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu2') }}</label>
                                <input type="text" class="form-control money" id="plan2" name="plan2" placeholder="" maxlength="20">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu3') }}</label>
                                <input type="text" class="form-control money" id="plan3" name="plan3" placeholder="" maxlength="20">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu4') }}</label>
                                <input type="text" class="form-control money" id="plan4" name="plan4" placeholder="" maxlength="20">
                            </div>
                        </div>

                    <div class="form-row" id="gereediv" style="display: none;">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Гэрээний дугаар</label>
                            <input type="text" class="form-control" id="gereenum" name="gereenum" maxlength="20">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{ trans('messages.geree') }}</label>
                            <input type="text" class="form-control money" id="geree" name="geree" maxlength="20">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress2">{{ trans('messages.ehelsen') }}</label>
                            <input class="form-control form-control-inline input-medium date-picker" name="prdate1" id="prdate1"
                                   size="16" type="text" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{ trans('messages.duusah') }}</label>
                            <input class="form-control form-control-inline input-medium date-picker" name="prdate2" id="prdate2"
                                   size="16" type="text" value="">
                        </div>
                    </div>
                        <div class="form-row">



                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ trans('messages.ehelsen') }}</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="date1" id="date1"
                                       size="16" type="text" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">{{ trans('messages.duusah') }}</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="date2" id="date2"
                                       size="16" type="text" value="">
                            </div>


                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <label for="inputZip">{{ trans('messages.tailbar') }}</label>
                            <textarea class="form-control" rows="2" id="description" name="description" maxlength="500"></textarea>
                        </div>
                    </div>

                </div>
                    <div class="modal-footer">
                        <div class="col-md-5">

                            <button type="submit" class="btn btn-primary">{{ trans('messages.hadgalah') }}</button>
                        </div>
                        <div class="col-md-7" style="display: inline-block; text-align: right;" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.haah') }}</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade " id="processmodal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form2" method="post" action="addprocess" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title1">{{ trans('messages.tsonh') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">

                            <div class="form-group col-md-3">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="proc" name="proc" value="{{$sprojecttype}}">
                                <input type="hidden" class="form-control" id="gprocess_id" name="gprocess_id">
                                <input type="hidden" class="form-control" id="gproject_id" name="gproject_id">
                                <label for="inputEmail4">{{ trans('messages.sar') }}</label>
                                <input type="text"  class="form-control month" id="gmonth" name="gmonth" required="true">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">{{ trans('messages.guitsetgel') }}</label>
                                <input type="text" class="form-control money" id="gbudget" name="gbudget" maxlength="20">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">{{ trans('messages.ajliintuluv') }}</label>
                                <select class="form-control select2" id="gstate_id" name="gstate_id" >
                                    @foreach($state as $states)
                                        <option value= "{{$states->state_id}}">{{$states->state_name_mn}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <!--   <div class="form-group col-md-3" id="gpercentdiv" style="display:none">
                                <label for="inputZip">{{ trans('messages.biylelt') }}</label>
                                <input type="text" class="form-control" id="gpercent" name="gpercent" placeholder="99.9" maxlength="4">
                            </div> -->
                            <div class="form-group col-md-5" id="gdatediv">
                                <label for="inputZip">{{ trans('messages.duusah') }}</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="gdate" id="gdate" placeholder="2019-04-15">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputZip">{{ trans('messages.tailbar') }}</label>
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

                                    <input type="file" name="image[]" class="form-control" multiple>

                                </div>
                                <div class="col-md-3">
                                    <p style="color: red"><i>2,5mb хэтрэхгүй</i></p>
                                </div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="button" id="deleteproc" class="btn btn-danger delete">{{ trans('messages.ustgah') }}</button>
                            <button type="submit" class="btn btn-primary" id="addprocessbutton">{{ trans('messages.hadgalah') }}</button>
                        </div>
                        <div class="col-md-7" style="display: inline-block; text-align: right;" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.haah') }}</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div id="processimagemodal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">Хавсаргасан зураг
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button></div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <input id="pprocess_id" style="display:none;">
                        <table id="imagetable">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<style>
    .disabledTab {
        pointer-events: none;
    }
</style>
@endsection

@section('script')
    <script>
        $("#method_code").on('change', function() {
            var itag =$(this).val();
            checkgeree(itag);

            var dep = $("#childabbr_id").val();
           console.log(dep);
            if(itag == 1) {
                $('#executor_id').val(dep).prop('selected', true);
            }
        });
        $("#childabbr_id").on('change', function() {
            var itag =$(this).val();
            var type = $("#method_code").val();
            if(type == 1) {

                $('#executor_id').val(itag).prop('selected', true);

            }
        });
        function preview_imagedet($id){
            $('#pprocess_id').val($id);

            $.get('getimagedet/'+$id,function(data){
                $("#imagetable tbody").empty();
                $.each(data,function(i,qwe){
                    var sHtml = " <tr class='table-row' >" +

                        "   <td class='m1'> <img width='100%' src='profile_images/img/"+ qwe.img_bname +"'/></td>" +
                        "   <td class='m1'> <button class='btn btn-danger' onclick=deletepicture(" + qwe.img_id+ ","+ qwe.process_id+")><i class='fa fa-trash' aria-hidden='true'></i></button></td>" +

                        "</tr>";
                    $("#imagetable tbody").append(sHtml);
                });

            });
        }
        function checkgeree($id) {
            if($id == 3){

                $('#gereediv').show();
            }
            else{
                $('#gereediv').hide();
            }
            $.get('getexec/'+$id,function(data){
                $('#executor_id').empty();

                $.each(data,function(i,qwe){
                    $('#executor_id').append($('<option>', {
                        value: qwe.executor_id,
                        text: qwe.executor_abbr
                    }));
                });
            });

        }
        function deletepicture($id,$id1)
        {


            $.ajax(
                {
                    url: "picture/delete/"+$id+"/"+$id1,
                    type: 'GET',
                    dataType: "JSON",
                    data: {
                        "id": $id,
                        "_method": 'DELETE',

                    },
                    success: function ()
                    {
                        alert('Зураг устгагдлаа');
                        preview_imagedet($id1);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status == 500) {
                            alert('Internal error: ' + jqXHR.responseText);
                        } else {
                            alert('Unexpected error.');
                        }
                    }
                });
        }
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
                stateSave: true,
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
                "pageLength": 10
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
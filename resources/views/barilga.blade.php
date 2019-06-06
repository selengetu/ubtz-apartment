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
                                            <label for="inputEmail4">{{ trans('messages.zahialagch') }}</label>
                                            <select class="form-control select2" id="sconstructor_id" name="sconstructor_id">
                                                <option value= "0">Бүгд</option>
                                                @foreach($constructor as $constructors)
                                                    <option value= "{{$constructors->department_id}}">{{$constructors->department_name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                            <select class="form-control select2" id="schildabbr_id" name="schildabbr_id">
                                                <option value= "0">Бүгд</option>
                                                @foreach($executor as $executors)
                                                    <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4">{{ trans('messages.guitsetgegch') }}</label>
                                            <select class="form-control select2" id="sexecutor_id" name="sexecutor_id" >
                                                <option value= "0">Бүгд</option>
                                                @foreach($executor as $executors)
                                                    <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
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
                                            <label for="inputAddress2">{{ trans('messages.ehelsen') }}</label>
                                            <input class="form-control form-control-inline input-medium date-picker" name="sdate1" id="sdate1"
                                                   size="16" type="text" value="">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputCity">{{ trans('messages.duussan') }}</label>
                                            <input class="form-control form-control-inline input-medium date-picker" name="sdate2" id="sdate2"
                                                   size="16" type="text" value="">
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
                                            <th width="400px">{{ trans('messages.ajliinner') }}</th>
                                            <th>{{ trans('messages.tuluwluguu') }}</th>

                                            <th>{{ trans('messages.tusuv') }}</th>
                                            <th>{{ trans('messages.guitsetgel') }}</th>
                                            <th>{{ trans('messages.uunees') }}</th>
                                            <th>{{ trans('messages.biylelt') }}</th>
                                            <th>{{ trans('messages.hariutsagch') }}</th>
                                            <th>{{ trans('messages.ehelsen') }}</th>
                                            <th>{{ trans('messages.duussan') }}</th>

                                            <th>{{ trans('messages.tailbar') }}</th>
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
                                                @endif>
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

                                            <td><b>{{ trans('messages.niit') }}</b></td>
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
                                                <th width="100px">{{ trans('messages.tailbar') }}</th>

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
                <form id="form1" method="post" action="addproject">
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
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="hidden" class="form-control" id="proj" name="proj" value="{{$sprojecttype}}">
                                <label for="inputEmail4">{{ trans('messages.ajliinturul') }}</label>
                                <select class="form-control select2" id="project_type" name="project_type">
                                    @foreach($projecttype as $projecttypes)
                                        <option value= "{{$projecttypes->project_type_id}}">{{$projecttypes->project_type_name_mn}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">{{ trans('messages.ajliinarga') }}</label>
                                <select class="form-control select2" id="method_code" name="method_code">
                                    @foreach($method as $methods)
                                        <option value= "{{$methods->method_code}}">{{$methods->method_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">{{ trans('messages.zahialagch') }}</label>
                                <select class="form-control select2" id="constructor_id" name="constructor_id">
                                    @foreach($constructor as $constructors)
                                        <option value= "{{$constructors->department_id}}">{{$constructors->department_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                <select class="form-control select2" id="childabbr_id" name="childabbr_id">
                                    <option value= "0">Бүгд</option>
                                    @foreach($executor as $executors)
                                        <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">{{ trans('messages.guitsetgegch') }}</label>
                                <select class="form-control select2" id="executor_id" name="executor_id">
                                    <option value= "999">Тодорхойгүй</option>
                                    @foreach($executor as $executors)
                                        <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-group col-md-9">
                                <label for="inputAddress">{{ trans('messages.ajliinner') }}</label>
                                <textarea class="form-control" rows="1" id="project_name" name="project_name"></textarea>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputZip">{{ trans('messages.hariutsagch') }}</label>
                                <select class="form-control select2" id="respondent_emp_id" name="respondent_emp_id" @if(Auth::user()->user_grant == 6) disabled="true"@endif>
                                    <option value= "999">Тодорхойгүй</option>
                                @foreach($employee as $employees)
                                    <option value= "{{$employees->emp_id}}">{{$employees->firstname}} {{$employees->fletter}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="inputAddress">{{ trans('messages.ajliinner') }} /Русс/</label>
                                <textarea class="form-control" rows="1" id="project_name_ru" name="project_name_ru"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu') }}</label>
                                <input type="text" class="form-control money" id="plan" name="plan" placeholder="" maxlength="14">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">{{ trans('messages.tusuv') }}</label>
                                <input type="text" class="form-control money" id="estimation" name="estimation" maxlength="14">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu1') }}</label>
                                <input type="text" class="form-control money" id="plan1" name="plan1" placeholder="" maxlength="14">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu2') }}</label>
                                <input type="text" class="form-control money" id="plan2" name="plan2" placeholder="" maxlength="14">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu3') }}</label>
                                <input type="text" class="form-control money" id="plan3" name="plan3" placeholder="" maxlength="14">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">{{ trans('messages.tuluwluguu4') }}</label>
                                <input type="text" class="form-control money" id="plan4" name="plan4" placeholder="" maxlength="14">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">{{ trans('messages.uunees') }}</label>
                                <input type="text" class="form-control money" id="economic" name="economic" maxlength="14">
                            </div>


                        </div>

                    <div class="form-row" id="gereediv" style="display: none;">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Гэрээний дугаар</label>
                            <input type="text" class="form-control" id="gereenum" name="gereenum" maxlength="14">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{ trans('messages.geree') }}</label>
                            <input type="text" class="form-control money" id="geree" name="geree" maxlength="14">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress2">Эхэлсэн</label>
                            <input class="form-control form-control-inline input-medium date-picker" name="prdate1" id="prdate1"
                                   size="16" type="text" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">Дууссан</label>
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
                                <label for="inputCity">{{ trans('messages.duussan') }}</label>
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
                            <button type="button" class="btn btn-danger delete" id="deleteproj">{{ trans('messages.ustgah') }}</button>
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
    <div class="modal fade " id="processmodal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                            <div class="form-group col-md-2">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="proc" name="proc" value="{{$sprojecttype}}">
                                <input type="hidden" class="form-control" id="gprocess_id" name="gprocess_id">
                                <input type="hidden" class="form-control" id="gproject_id" name="gproject_id">
                                <label for="inputEmail4">{{ trans('messages.tootsoh') }}</label>
                                <input type="text"  class="form-control year" id="gyear" name="gyear" required="true">

                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputEmail4">{{ trans('messages.sar') }}</label>
                                <input type="text"  class="form-control month" id="gmonth" name="gmonth" required="true">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">{{ trans('messages.guitsetgel') }}</label>
                                <input type="text" class="form-control money" id="gbudget" name="gbudget" maxlength="14">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">{{ trans('messages.ajliintuluv') }}</label>
                                <select class="form-control select2" id="gstate_id" name="gstate_id" >
                                    @foreach($state as $states)
                                        <option value= "{{$states->state_id}}">{{$states->state_name_mn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="gpercentdiv">
                                <label for="inputZip">{{ trans('messages.biylelt') }}</label>
                                <input type="text" class="form-control" id="gpercent" name="gpercent" placeholder="99.9" maxlength="4">
                            </div>
                            <div class="form-group col-md-3" id="gdatediv">
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
                                    <input type="file" name="image" class="form-control">

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
        function checkgeree($id) {
            if($id == 3){

                $('#gereediv').show();
            }
            else{
                $('#gereediv').hide();
            }
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
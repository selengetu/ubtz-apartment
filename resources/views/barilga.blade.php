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
                                            <label for="inputEmail4">{{ trans('messages.on') }}</label>
                                            <select class="form-control select2" id="syear" name="syear"  onchange="javascript:location.href = 'filter_year/'+this.value;" >
                                                @foreach($year as $years)
                                                    <option value= "{{$years->year_id}}" @if($years->year_id==$syear_id) selected @endif>{{$years->year_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <label for="inputEmail4">{{ trans('messages.ajliinarga') }}</label>
                                            <select class="form-control select2" id="smethod_id" name="smethod_id"  onchange="javascript:location.href = 'filter_method/'+this.value;" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($method as $methods)
                                                    <option value= "{{$methods->method_code}}" @if($methods->method_code==$smethod_id) selected @endif>
                                                        @if ( Config::get('app.locale') == 'mn')
                                                        {{$methods->method_name}}
                                                            @else
                                                            {{$methods->method_name_ru}}
                                                        @endif

                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">

                                            <label for="inputEmail4">{{ trans('messages.ajliintuluv') }}</label>
                                            <select class="form-control select2" id="sstate_id" name="sstate_id"  onchange="javascript:location.href = 'filter_state/'+this.value;" >

                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($state as $states)
                                                    <option value= "{{$states->state_id}}" @if($states->state_id==$sstate_id) selected @endif>  @if ( Config::get('app.locale') == 'mn') {{$states->state_name_mn}} @else {{$states->state_name_ru}}  @endif</option>
                                                @endforeach
                                                <option value="99">  @if ( Config::get('app.locale') == 'mn') Эхлээгүй @else Не начали @endif</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                            <select class="form-control select2" id="schildabbr_id" name="schildabbr_id"  onchange="javascript:location.href = 'filter_childabbr/'+this.value;" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($executor as $executors)
                                                    @if($executors->is_ubtz==1)
                                                    <option value= "{{$executors->executor_id}}" @if($executors->executor_id==$schildabbr) selected @endif> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                                        @else {{$executors->executor_abbr}}@endif</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4">{{ trans('messages.guitsetgegch') }}</label>
                                            <select class="form-control select2" id="sexecutor_id" name="sexecutor_id"  onchange="javascript:location.href = 'filter_executor/'+this.value;" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($executor as $executors)
                                                    @if($executors->is_ubtz==1)
                                                    <option value= "{{$executors->executor_id}}" @if($executors->executor_id==$sexecutor) selected @endif> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                                        @else {{$executors->executor_abbr}}@endif</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">

                                            <label for="inputZip">{{ trans('messages.hariutsagch') }}</label>
                                            <select class="form-control select2" id="srespondent_emp_id" name="srespondent_emp_id"  onchange="javascript:location.href = 'filter_resp/'+this.value;" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                <option value= "999">Тодорхойгүй</option>
                                                @foreach($employee as $employees)
                                                    <option value= "{{$employees->emp_id}}" @if($employees->emp_id == $srespondent_emp_id) selected @endif>{{$employees->fletter}}.{{$employees->firstname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">{{ trans('messages.guitsetgegch') }} / {{ trans('messages.zahialagchnegj') }}</label>
                                            <select class="form-control select2" id="both_id" name="both_id"  onchange="javascript:location.href = 'filter_both/'+this.value;" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($executor as $executors)
                                                    @if($executors->is_ubtz==1)
                                                    <option value= "{{$executors->executor_id}}" @if($executors->executor_id==$both_id) selected @endif> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                                        @else {{$executors->executor_abbr}}@endif</option>
                                                    @endif
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
                                                @if($projects->state_id!=61)
                                                <?php $sum_plan += ($projects->plan) ?>
                                                @endif
                                                <td><?php
                                                    echo number_format($projects->estimation,2)."<br>";
                                                    ?></td>
                                                @if($projects->state_id!=61)
                                                <?php $sum_estimation += ($projects->estimation) ?>
                                                @endif
                                                <td><?php
                                                    echo number_format($projects->budget,2)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_budget += ($projects->budget) ?>
                                                @endif
                                                <td><?php
                                                    echo number_format($projects->economic,2)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_economic += ($projects->economic) ?>
                                                @endif
                                                <td>{{number_format($projects->percent,2)}}%</td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_percent += ($projects->percent) ?>
                                                @endif
                                                <td>{{$projects->fletter}}.{{$projects->firstname}}</td>
                                                <td> <a href="#" title="Төлөвлөгөөт улирал : {{$projects->season_name}}">
                                                        {{$projects->start_date}}</a></td>
                                                <td>{{$projects->end_date}}</td>
                                                <td width="102px"  bgcolor= {{$projects->state_bk_color}}>
                                                    <font color="{{$projects->state_tx_color}}" >{{$projects->state_name_mn}}<br> {{$projects->state_name_ru}}@if($projects->prend_date!=NULL && $projects->state_id==1) <br> {{$projects->prend_date}} @endif<br>{{$projects->description}}</font></td>
                                                <td>

                                                    @if (Auth::user()->dep_id ==55 )
                                                    @if (Auth::user()->user_grant !=6 or Auth::user()->id ==$projects->added_user_id or Auth::user()->emp_id ==$projects->respondent_emp_id)
                                                        <button onclick="processClicked({{$projects->project_id}})"{{-- onclick="$('#nav-profile-tab').trigger('click')" --}} data-id="{{$projects->project_id}}" tag="{{$projects->project_id}}" class="btn btn-primary btn-sm process"> <i class="fa fa-plus" style="color: rgb(255, 255, 255);"></i></button>
                                                    @endif
                                                    @endif
                                                </td>
                                                <td>
                                                @if($projects->is_lock==0)
                                                    @if (Auth::user()->dep_id ==55 )
                                                    @if (Auth::user()->user_grant !=6 or Auth::user()->id ==$projects->added_user_id or Auth::user()->emp_id ==$projects->respondent_emp_id )
                                                        <button type="button" class="btn btn-warning btn-sm update" data-toggle="modal"  data-id="{{$projects->project_id}}" tag="{{$projects->project_id}}"  data-target="#exampleModal" id="updateproj" onclick="updateproj({{$projects->project_id}})">
                                                            <i class="fa fa-pencil" style="color: rgb(255, 255, 255);"></i>
                                                        </button>
                                                    @endif
                                                        @endif
                                                        @endif
                                                </td>

                                                <td><button type="button" onclick="imgclick({{$projects->project_id}})" class="btn btn-danger delete btn-sm" data-toggle="modal" data-target="#imgModal">  <i class="fa fa-picture-o" style="color: rgb(255, 255, 255);"></i></button>  @if (Auth::user()->user_grant ==3 ) <button type="button" class="btn btn-danger delete btn-sm" id="deleteproj" onclick="deleteproj({{$projects->project_id}})">  <i class="fa fa-trash" style="color: rgb(255, 255, 255);"></i></button> @endif</td>
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
     @include('nav.nav_process')               
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
   @include('modal.mod_process');
   @include('modal.mod_project');
   @include('modal.mod_img');
<style>
    .disabledTab {
        pointer-events: none;
    }
</style>
@endsection

@section('script')
@include('layouts.sc_home')
    @include('layouts.script')
@endsection
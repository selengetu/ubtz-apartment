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
                                            <label for="inputEmail4">{{ trans('messages.on') }}</label>
                                            <select class="form-control select2" id="syear" name="syear"  onchange="javascript:location.href = 'filter_year/'+this.value;" >
                                                @foreach($year as $years)
                                                    <option value= "{{$years->year_id}}" @if($years->year_id==$syear_id) selected @endif>{{$years->year_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">

                                            <label for="inputEmail4">{{ trans('messages.sar') }}</label>
                                            <select class="form-control select2" id="month" name="month"  onchange="javascript:location.href = 'filter_month/'+this.value;" >
                                                @foreach($mo as $months)
                                                    <option value= "{{$months->id}}" @if($months->id==$month) selected @endif>{{$months->month_name}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2">

                                            <label for="inputEmail4">{{ trans('messages.ajliintuluv') }}</label>
                                            <select class="form-control select2" id="sstate_id" name="sstate_id" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($state as $states)
                                                    <option value= "{{$states->state_id}}">  @if ( Config::get('app.locale') == 'mn') {{$states->state_name_mn}} @else {{$states->state_name_ru}}  @endif</option>
                                                @endforeach
                                                <option value="99">  @if ( Config::get('app.locale') == 'mn') Эхлээгүй @else Не начали @endif</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">{{ trans('messages.hariutsagch') }}</label>
                                            <select class="form-control select2" id="srespondent_emp_id" name="srespondent_emp_id" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($employee as $employees)
                                                    <option value= "{{$employees->emp_id}}">{{$employees->fletter}}.{{$employees->firstname}}</option>
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
                                            <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                            <select class="form-control select2" id="schildabbr_id" name="schildabbr_id">

                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($executor as $executors)
                                                    @if($executors->is_ubtz==1)
                                                    <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                                        @else {{$executors->executor_abbr}}@endif</option>
                                                    @endif
                                                @endforeach

                                            </select>

                                        </div>  <div class="form-group col-md-2">
                                            <label for="inputEmail4">{{ trans('messages.zahialagch') }}</label>
                                            <select class="form-control select2" id="nz_id" name="nz_id">

                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($nz as $s)
                                                    
                                                    <option value= "{{$s->nz_dep}}">  {{$s->nz_name}}
                                                      
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputPassword4">{{ trans('messages.guitsetgegch') }}</label>
                                            <select class="form-control select2" id="sexecutor_id" name="sexecutor_id" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($executor as $executors)
                                                    @if($executors->is_ubtz==1)
                                                    <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                                        @else {{$executors->executor_abbr}}@endif</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                           <div class="form-group col-md-2">
                                            <label for="inputPassword4">Төсөв</label>
                                            <select class="form-control select2" id="stusuv_id" name="stusuv_id" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                <option value= "1">Байгаа</option>
                                                <option value= "2">Байхгүй</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-1">
                                        <label for="inputPassword4">.</label>
                                            <button type="submit" class="btn btn-primary form-control" >{{ trans('messages.haih') }}</button>

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
                                    <h3 class="card-title"> @if($sprojecttype ==1 ) {{ trans('messages.tailanbarilga') }}  @elseif($sprojecttype ==2 ) {{ trans('messages.tailanzaswar') }} @endif</h3>
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
                                        <button class="btn btn-info" id="export" onclick="tableToExcel('example2', 'Export HTML Table to Excel')"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>


                                    </div>
                                </div>
                                <br>
                                <table class="table table-bordered" id="example2" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">
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
                                        <th>{{ trans('messages.ussundun') }} {{$month -1 }} {{ trans('messages.ussundun1') }} </th>
                                        <th>   @if ( Config::get('app.locale') == 'mn'){{ trans('messages.enesar') }} {{$month}} {{ trans('messages.ussundun2') }}
                                            @elseif ( Config::get('app.locale') == 'en')
                                            @foreach($mo as $m)
                                            @if($month == $m->id)
                                           {{$m->rus}}
                                            @endif
                                            @endforeach
                                            @endif
                                            </th>
                                        <th>{{ trans('messages.ussundun') }} {{$month}} {{ trans('messages.ussundun1') }} </th>
                                        <th>{{ trans('messages.uunees') }}</th>
                                        <th>{{ trans('messages.biylelt') }}</th>
                                        <th>{{ trans('messages.hariutsagch') }}</th>
                                        <th>{{ trans('messages.tailbar') }}</th>
                                        <th>{{ trans('messages.zurag') }}</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php $s=1;
                                    $p=0;
                                    $p1=0;
                                    $iall=0;
                                    $i1=0;
                                    $i2=0;
                                    $i3=0;
                                    $i4=0;
                                    $i5=0;
                                    $i6=0;
                                    $i7=0;
                                    ?>
                                    <?php $all=count($project);?>
                                    <?php $no = 1; ?>
                                    <?php $no1 = 1; ?>
                                    @foreach($project as $i=>$projects)
                                        @if($p!=$projects->department_id and $p>0 )

                                            <tr>
                                                <td colspan="3"><center><b>{{ trans('messages.dun') }}</b> </center></td>
                                                <td><b>{{number_format($no-1)}}</b></td>
                                                <td><b>{{number_format($i1)}}</b></td>
                                                <td><b>{{number_format($i2)}}</b> </td>
                                                <td><b>{{number_format($i3)}}</b> </td>
                                                <td><b>{{number_format($i4)}}</b></td>
                                                <td><b>{{number_format($i5)}}</b></td>
                                                <td><b>{{number_format($i6)}}</b></td>
                                                <td><b>@if($i7> 0 && $no>0)
                                                        {{number_format($i7/($no-1),2)}}%
                                                    @endif</b></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        @endif
                                        <?php if($p!=$projects->department_id) { $p=$projects->department_id;
                                            $i1=0;
                                            $i2=0;
                                            $i3=0;
                                            $i4=0;
                                            $i5=0;
                                            $i6=0;
                                            $i7=0;

                                        } else  { $p1=$projects->department_id; }?>

                                        @if($p!=$p1 and $p>0)
                                            <?php $no = 1; ?>
                                            <Tr><td colspan="14" style="font-weight: bold;font-size: 12px;"> {{$projects->department_name}}  @if($projects->department_type ==1 ){{ trans('messages.alba') }} @endif</td></Tr>
                                            <?php $s++; ?>
                                            <tr >
                                                <td>{{$no}}</td>
                                                <td><a href="#" title="Төлөвлөгөөт улирал : {{$projects->season_name}}">
                                                     @if($projects->executor_type !=2) {{$projects->childabbr}} @else {{$projects->department_name}} - {{$projects->childabbr}}  @endif</a></td>
                                                <td>
                                                        {{$projects->executor_abbr}}
                                                  
                                                </td>
                                                <td>{{$projects->project_name}}<br>{{$projects->project_name_ru}}</td>
                                                <td> <a href="#" title="Улирлын төлөвлөгөө : {{$projects->plan1." ,". $projects->plan2." ,". $projects->plan3." ,". $projects->plan4}}"><?php
                                                        echo number_format($projects->plan,2)."<br>";
                                                        ?></a></td>
                                                @if($projects->state_id!=61)
                                                <?php $sum_plan += ($projects->plan) ?>
                                                @endif
                                                <td><?php
                                                    echo number_format($projects->estimation)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_estimation += ($projects->estimation) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->diff)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_diff += ($projects->diff) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->bud)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_bud += ($projects->bud) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->runningtotal)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_runningtotal += ($projects->runningtotal) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->economic)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_economic += ($projects->economic) ?>
                                                    @endif
                                                <td>{{ number_format($projects->percent, 2) }}%</td>
                                                    @if($projects->state_id!=61)
                                                    
                                                <?php $sum_percent += $projects->percent ?>
                                                    @endif
                                                <td>{{$projects->fletter}}.{{$projects->firstname}}</td>

                                                <td bgcolor= {{$projects->state_bk_color}}>
                                                    <font color="{{$projects->state_tx_color}}" >{{$projects->state_name_mn}}<br>{{$projects->state_name_ru}}@if($projects->prend_date!=NULL && $projects->state_id==1) <br> {{$projects->prend_date}} @endif<br>{{$projects->description}}</font></td>
                                                <td>@if($projects->img_1!=null)<img src="<?php echo asset("profile_images/img/$projects->img_1")?>"  height="100" width="100" onclick="preview_image({{$projects->project_id}})" data-toggle="modal" data-target="#photomodal">@endif</td>

                                            </tr>
                                            <?php $no++; ?>
                                            <?php $no1++; ?>
                                        @else

                                            <tr >
                                                <td>{{$no}}</td>
                                                <td><a href="#" title="Төлөвлөгөөт улирал : {{$projects->season_name}}">
                                                        @if($projects->executor_type !=2) {{$projects->childabbr}} @else {{$projects->department_name}} - {{$projects->childabbr}}  @endif</a></td>
                                                <td>
                                                        {{$projects->executor_abbr}}
                                                 
                                                </td>
                                                <td>{{$projects->project_name}}<br>{{$projects->project_name_ru}}</td>
                                                <td> <a href="#" title="Улирлын төлөвлөгөө :  {{$projects->plan1." ,". $projects->plan2." ,". $projects->plan3." ,". $projects->plan4}}"><?php
                                                        echo number_format($projects->plan,2)."<br>";
                                                        ?></a></td>
                                                @if($projects->state_id!=61)
                                                <?php $sum_plan += ($projects->plan) ?>
                                                @endif
                                                <td>
                                                   <?php
                                                    echo number_format($projects->estimation)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_estimation += ($projects->estimation) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->diff)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_diff += ($projects->diff) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->bud)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_bud += ($projects->bud) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->runningtotal)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_runningtotal += ($projects->runningtotal) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->economic)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_economic += ($projects->economic) ?>
                                                    @endif
                                                <td>{{ number_format($projects->percent, 2) }}%</td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_percent += $projects->percent?>
                                                    @endif
                                                <td>{{$projects->fletter}}.{{$projects->firstname}}</td>

                                                <td bgcolor= {{$projects->state_bk_color}}>
                                                    <font color="{{$projects->state_tx_color}}" >{{$projects->state_name_mn}}<br>{{$projects->state_name_ru}}@if($projects->prend_date!=NULL && $projects->state_id==1) <br> {{$projects->prend_date}} @endif<br>{{$projects->description}}</font></td>

                                                <td>@if($projects->img_1!=null)<img src="<?php echo asset("profile_images/img/$projects->img_1")?>"  height="100" width="100" onclick="preview_image({{$projects->project_id}})" data-toggle="modal" data-target="#photomodal">@endif</td>
                                            </tr>
                                            <?php $no++; ?>
                                            <?php $no1++; ?>
                                        @endif
                                        <?php


                                          if($projects->state_id!=61){
                                              $i1=$i1+$projects->plan;
                                              $i2=$i2 + $projects->estimation;
                                              $i3=$i3 +$projects->diff;
                                              $i4=$i4 +$projects->bud;
                                              $i5=$i5 +$projects->runningtotal;
                                              $i6= $i6 +$projects->economic;
                                              $i7=$i7 + $projects->percent;
                                          }

                                        ?>
                                        <?php
                                        if(++$iall === $all) { ?>

                                        <tr>
                                            <td colspan="3"><center><b>Дүн</b> </center></td>
                                            <td><b>{{number_format($no-1)}}</b></td>
                                            <td><b>{{ number_format($i1)}}</b></td>
                                            <td><b>{{ number_format($i2)}}</b> </td>
                                            <td><b>{{number_format($i3)}}</b> </td>
                                            <td><b>{{number_format($i4)}}</b></td>
                                            <td><b>{{number_format($i5)}}</b></td>
                                            <td><b>{{number_format($i6)}}</b></td>
                                            <td><b>@if($i7> 0 && $no>0)
                                                    {{number_format($i7/($no-1),2)}}%
                                                    @endif</b></td>
                                            <td colspan="3"></td>
                                        </tr>

                                                <?php } ?>

                                    @endforeach
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
                                                if($sum_runningtotal > 0 && $sum_plan){
                                                echo number_format((($sum_runningtotal)/($sum_plan)*100), 2, ',', ' ')."%<br>";
                                                ?></b></td>
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
                                    <?php $s=1;
                                    $p=0;
                                    $p1=0;
                                    $iall=0;
                                    $i1=0;
                                    $i2=0;
                                    $i3=0;
                                    $i4=0;
                                    $i5=0;
                                    $i6=0;
                                    $i7=0;
                                    ?>
                                    <?php $all=count($project);?>
                                    <?php $no = 1; ?>
                                    <?php $no1 = 1; ?>
                                    @foreach($project as $i=>$projects)
                                        @if($p!=$projects->department_id and $p>0 )

                                            <tr>
                                                <td colspan="4"><center><b>Дүн</b> </center></td>




                                                <td><b>{{ number_format($i1)}}</b></td>
                                                <td><b>{{ number_format($i2)}}</b> </td>
                                                <td><b>{{number_format($i3)}}</b> </td>
                                                <td><b>{{number_format($i4)}}</b></td>
                                                <td><b>{{number_format($i5)}}</b></td>
                                                <td><b>{{number_format($i6)}}</b></td>
                                                <td><b>@if($i7> 0 && $no>0)
                                                        {{number_format($i7/($no-1),2)}}%
                                                        @endif</b></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        @endif
                                        <?php if($p!=$projects->department_id) { $p=$projects->department_id;
                                            $i1=0;
                                            $i2=0;
                                            $i3=0;
                                            $i4=0;
                                            $i5=0;
                                            $i6=0;
                                            $i7=0;

                                        } else  {$p1=$projects->department_id;}?>

                                        @if($p!=$p1 and $p>0)
                                            <?php $no = 1; ?>
                                            <Tr><td colspan="12" style="font-weight: bold;font-size: 12px;"> {{$projects->department_name}}  @if($projects->department_type ==1 ){{ trans('messages.alba') }} @endif</td></Tr>
                                            <?php $s++; ?>
                                            <tr >
                                                <td>{{$no}}</td>
                                                <td>@if($projects->executor_type !=2) {{$projects->childabbr}} @else {{$projects->department_name}} - {{$projects->childabbr}}  @endif</td>

                                                <td>
                                                        {{$projects->executor_abbr}}
                                                  
                                                </td>
                                                <td>{{$projects->project_name}}<br>{{$projects->project_name_ru}}</td>
                                                <td><?php
                                                    echo number_format($projects->plan)."<br>";
                                                    ?></td>
                                                @if($projects->state_id!=61)
                                                <?php $sum_plan += ($projects->plan) ?>
                                                @endif
                                                <td><?php
                                                    echo number_format($projects->estimation)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_estimation += ($projects->estimation) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->diff)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_diff += ($projects->diff) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->bud)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_bud += ($projects->bud) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->runningtotal)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_runningtotal += ($projects->runningtotal) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->economic)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_economic += ($projects->economic) ?>
                                                    @endif
                                                <td>{{ number_format($projects->percent, 2) }}%%</td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_percent += ($projects->percent) ?>
                                                    @endif
                                                <td>{{$projects->fletter}}.{{$projects->firstname}}</td>

                                                <td width="102px"  bgcolor= {{$projects->state_bk_color}}>
                                                    <font color="{{$projects->state_tx_color}}" >{{$projects->state_name_mn}}@if($projects->prend_date!=NULL && $projects->state_id==1) <br> {{$projects->prend_date}} @endif<br>{{$projects->state_name_ru}}<br>{{$projects->description}}</font></td></td>
                                                </tr>
                                            <?php $no++; ?>
                                            <?php $no1++; ?>
                                        @else

                                            <tr >
                                                <td>{{$no}}</td>
                                                <td>@if($projects->executor_type !=2) {{$projects->childabbr}} @else {{$projects->department_name}} - {{$projects->childabbr}}  @endif</td>

                                                <td>
                                                        {{$projects->executor_abbr}}
                                                
                                                </td>
                                                <td>{{$projects->project_name}}<br>{{$projects->project_name_ru}}</td>
                                                <td><?php
                                                    echo number_format($projects->plan)."<br>";
                                                    ?></td>
                                                @if($projects->state_id!=61)
                                                <?php $sum_plan += ($projects->plan) ?>
                                                @endif
                                                <td><?php
                                                    echo number_format($projects->estimation)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_estimation += ($projects->estimation) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->diff)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_diff += ($projects->diff) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->bud)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_bud += ($projects->bud) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->runningtotal)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_runningtotal += ($projects->runningtotal) ?>
                                                    @endif
                                                <td><?php
                                                    echo number_format($projects->economic)."<br>";
                                                    ?></td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_economic += ($projects->economic) ?>
                                                    @endif
                                                <td>{{ number_format($projects->percent, 2) }}%</td>
                                                    @if($projects->state_id!=61)
                                                <?php $sum_percent += ($projects->percent) ?>
                                                    @endif
                                                <td>{{$projects->fletter}}.{{$projects->firstname}}</td>

                                                <td bgcolor= {{$projects->state_bk_color}}>
                                                    <font color="{{$projects->state_tx_color}}" >{{$projects->state_name_mn}}<br>{{$projects->state_name_ru}}<br>{{$projects->description}}</font></td></td>

                                                 </tr>
                                            <?php $no++; ?>
                                            <?php $no1++; ?>
                                        @endif
                                        <?php

                                        if($projects->state_id!=61){
                                            $i1=$i1+$projects->plan;
                                            $i2=$i2 + $projects->estimation;
                                            $i3=$i3 +$projects->diff;
                                            $i4=$i4 +$projects->bud;
                                            $i5=$i5 +$projects->runningtotal;
                                            $i6= $i6 +$projects->economic;
                                            $i7=$i7 + $projects->percent;
                                        }

                                        ?>
                                        <?php
                                        if(++$iall === $all) { ?>

                                        <tr>
                                            <td colspan="4"><center><b>{{ trans('messages.dun') }}</b> </center></td>

                                            <td><b>{{ number_format($i1)}}</b></td>
                                            <td><b>{{ number_format($i2)}}</b> </td>
                                            <td><b>{{number_format($i3)}}</b> </td>
                                            <td><b>{{number_format($i4)}}</b></td>
                                            <td><b>{{number_format($i5)}}</b></td>
                                            <td><b>{{number_format($i6)}}%</b></td>
                                            <td><b>{{$i7}}</b></td>
                                            <td colspan="2"></td>
                                        </tr>

                                        <?php } ?>

                                    @endforeach
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
                                                if($sum_runningtotal > 0 && $sum_plan){
                                                    echo number_format((($sum_runningtotal)/($sum_plan)*100), 2, ',', ' ')."%}<br>";}}

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
        <div id="photomodal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">Хавсаргасан зураг
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button></div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div id="image_preview"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')
<script src="https://www.jqueryscript.net/demo/Export-Html-Table-To-Excel-Spreadsheet-using-jQuery-table2excel/src/jquery.table2excel.js"></script>
    <script>
        
        $(document).ready(function() {

            const gproject_id = {{ $gproject_id }};
            if (gproject_id != 0) {
                processClicked(gproject_id);
            }



        });
        $('#export').on('click', function(e){
        e.preventDefault();
        ex();
    });
    
   
	
            function ex(){
                $("#example2").table2excel({
                    exclude: ".xls",
                    name: "Excel Document Name"
                        }); 
             
            }
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
                    $('#image_preview').append('<img width="100%" src="profile_images/img/' + qwe.img_1 + '" />');
                });
            });
        }
    </script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    @include('layouts.script')
@endsection

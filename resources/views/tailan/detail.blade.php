@extends('layouts.master')

@section('style')
    <style>
        .highlight { background-color: lightskyblue }
    </style>
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
                            <form method="post"  @if($sprojecttype ==1 ) action="detailiz"  @elseif($sprojecttype ==2 ) action="detailib" @endif >
                                @csrf
                                <div class="col-md-12" data-scrollable="true" data-height="400" >
                                    <div class="row" >
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

                                        <div class="form-group col-md-2">
                                            <div class="form-group col-md-2">
                                                <label for="inputZip"><span>.</span></label><br>
                                                <button type="submit" class="btn btn-primary" >{{ trans('messages.haih') }}</button>

                                            </div>

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
                                    <h3 class="card-title">{{ trans('messages.ibiz') }} </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">

                            <div class="table-responsive">
                                <div class="row">

                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="example" border="1" style="font-size:12px; border-collapse: collapse;">
                                            <thead>
                                            <?php $sum_plan = 0 ?>
                                            <?php $sum_percent = 0 ?>
                                            <?php $sum_rpercent = 0 ?>
                                            <?php $sum_budget = 0 ?>
                                            <?php $sum_ajliintoo = 0 ?>
                                            <?php $sum_haasan = 0 ?>
                                            <?php $sum_duussan = 0 ?>
                                            <?php $sum_gdag = 0 ?>
                                            <?php $sum_ghots = 0 ?>
                                            <?php $sum_gadgeree = 0 ?>
                                            <?php $sum_nem = 0 ?>
                                            <?php $sum_boloogui = 0 ?>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ trans('messages.alba') }}</th>
                                                <th>{{ trans('messages.tuluwluguu') }}</th>
                                                <th>{{ trans('messages.guitsetgel') }}</th>
                                                <th>{{ trans('messages.biylelt') }}</th>
                                                <th>{{ trans('messages.ajliintoo') }}</th>
                                                <th>{{ trans('messages.uunees') }}</th>
                                                <th>{{ trans('messages.duussant') }}</th>
                                                <th>{{ trans('messages.graphdaguu') }}</th>
                                                <th>{{ trans('messages.graphhots') }}</th>
                                                <th>{{ trans('messages.gadgeree') }}</th>
                                                <th>{{ trans('messages.tuvnemelt') }}</th>
                                                <th>{{ trans('messages.uliral') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($t as $projects)
                                                <tr id="{{$projects->department_id}}">
                                                    <td>{{$no}}</td>
                                                    <td>{{$projects->department_name}}</td>

                                                    <td><?php
                                                        echo number_format($projects->plan)."<br>";
                                                        ?></td>
                                                    <?php $sum_plan += ($projects->plan) ?>
                                                    <td><?php
                                                        echo number_format($projects->budget)."<br>";
                                                        ?></td>
                                                    <?php $sum_budget += ($projects->budget) ?>

                                                    <td>{{number_format($projects->percent, 2, ',', '.')}}%</td>
                                                    <?php $sum_percent += ($projects->percent) ?>
                                                    <td>{{$projects->ajliintoo}}</td>
                                                    <?php $sum_ajliintoo += ($projects->ajliintoo) ?>
                                                    <td>{{$projects->haasan}}</td>
                                                    <?php $sum_haasan += ($projects->haasan) ?>
                                                    <td>{{$projects->duussan}}</td>
                                                    <?php $sum_duussan += ($projects->duussan) ?>
                                                    <td>{{$projects->gdag}}</td>
                                                    <?php $sum_gdag += ($projects->gdag) ?>
                                                    <td>{{$projects->ghots}}</td>
                                                    <?php $sum_ghots += ($projects->ghots) ?>
                                                    <td>{{$projects->gadgeree}}</td>
                                                    <?php $sum_gadgeree += ($projects->gadgeree) ?>
                                                    <td>{{$projects->nem}}</td>
                                                    <?php $sum_nem += ($projects->nem) ?>
                                                    <td>{{$projects->boloogui}}</td>
                                                    <?php $sum_boloogui += ($projects->boloogui) ?>


                                                </tr>
                                                <?php $no++; ?>
                                            @endforeach
                                            <tr>
                                                <td colspan="2">Нийт </td>
                                                <td><?php
                                                    echo number_format($sum_plan)."<br>";
                                                    ?></td>
                                                <td><?php
                                                    echo number_format($sum_budget)."<br>";
                                                    ?></td>
                                                <td>{{number_format($sum_percent/($no-1), 2, ',', '.')}}%</td>
                                                <td><?php
                                                    echo number_format($sum_ajliintoo)."<br>";
                                                    ?></td>

                                                <td>{{number_format($sum_haasan)}}</td>
                                                <td>{{number_format($sum_duussan)}}</td>
                                                <td>{{number_format($sum_gdag)}}</td>
                                                <td>{{number_format($sum_ghots)}}</td>
                                                <td>{{number_format($sum_gadgeree)}}</td>
                                                <td>{{number_format($sum_nem)}}</td>
                                                <td>{{number_format($sum_boloogui)}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="example" border="1" style="font-size:12px; border-collapse: collapse;">
                                            <thead>
                                            <?php $sum_plan = 0 ?>
                                            <?php $sum_percent = 0 ?>
                                            <?php $sum_rpercent = 0 ?>
                                            <?php $sum_budget = 0 ?>
                                            <?php $sum_eune = 0 ?>
                                            <?php $sum_ezurag = 0 ?>
                                            <?php $sum_etul = 0 ?>
                                            <?php $sum_emater = 0 ?>
                                            <?php $sum_esanh = 0 ?>
                                            <?php $sum_eguits = 0 ?>
                                            <?php $sum_etusuv = 0 ?>
                                            <?php $sum_ehleegui = 0 ?>
                                            <?php $sum_egeree = 0 ?>

                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ trans('messages.alba') }}</th>
                                                <th>{{ trans('messages.eune') }}</th>
                                                <th>{{ trans('messages.egeree') }}</th>
                                                <th>{{ trans('messages.ezurag') }}</th>
                                                <th>{{ trans('messages.etul') }}</th>
                                                <th>{{ trans('messages.emat') }}</th>
                                                <th>{{ trans('messages.esan') }}</th>
                                                <th>{{ trans('messages.eguits') }}</th>
                                                <th>{{ trans('messages.etusuv') }}</th>
                                                <th>{{ trans('messages.ehleegui') }}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($t as $projects)
                                                <tr id="{{$projects->department_id}}">
                                                    <td>{{$no}}</td>
                                                    <td>{{$projects->department_name}}</td>
                                                    <td>{{$projects->eune}}</td>
                                                    <?php $sum_eune += ($projects->eune) ?>
                                                    <td>{{$projects->egeree}}</td>
                                                    <?php $sum_egeree += ($projects->egeree) ?>
                                                    <td>{{$projects->ezurag}}</td>
                                                    <?php $sum_ezurag += ($projects->ezurag) ?>
                                                    <td>{{$projects->etul}}</td>
                                                    <?php $sum_etul+= ($projects->etul) ?>
                                                    <td>{{$projects->emater}}</td>
                                                    <?php $sum_emater += ($projects->emater) ?>
                                                    <td>{{$projects->esanh}}</td>
                                                    <?php $sum_esanh += ($projects->esanh) ?>
                                                    <td>{{$projects->eguits}}</td>
                                                    <?php $sum_eguits += ($projects->eguits) ?>
                                                    <td>{{$projects->etusuv}}</td>
                                                    <?php $sum_etusuv += ($projects->etusuv) ?>
                                                    <td>{{$projects->ehleegui}}</td>
                                                    <?php $sum_ehleegui += ($projects->ehleegui) ?>

                                                </tr>
                                                <?php $no++; ?>
                                            @endforeach
                                            <tr>
                                                <td colspan="2">Нийт </td>
                                                <td><?php
                                                    echo number_format($sum_eune)."<br>";
                                                    ?></td>

                                                <td><?php
                                                    echo number_format($sum_egeree)."<br>";
                                                    ?></td>
                                                <td><?php
                                                    echo number_format($sum_ezurag)."<br>";
                                                    ?></td>   <td><?php
                                                    echo number_format($sum_etul)."<br>";
                                                    ?></td>
                                                <td><?php
                                                    echo number_format($sum_emater)."<br>";
                                                    ?></td>
                                                <td><?php
                                                    echo number_format($sum_esanh)."<br>";
                                                    ?></td>
                                                <td><?php
                                                    echo number_format($sum_eguits)."<br>";
                                                    ?></td>
                                                <td><?php
                                                    echo number_format($sum_etusuv)."<br>";
                                                    ?></td>
                                                <td><?php
                                                    echo number_format($sum_ehleegui)."<br>";
                                                    ?></td>


                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <br>


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

    @include('layouts.script')

@endsection
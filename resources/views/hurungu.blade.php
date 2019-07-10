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
                                                <label for="inputEmail4">{{ trans('messages.zahialagch') }}</label>
                                                <select class="form-control select2" id="sconstructor_id" name="sconstructor_id">
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($constructor as $constructors)
                                                        <option value= "{{$constructors->department_id}}">{{$constructors->department_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                                <select class="form-control select2" id="schildabbr_id" name="schildabbr_id">
                                                    <option value= "0">Бүгд</option>
                                                    @foreach($executor as $executors)
                                                        <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
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
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#hurungumodal" id="addproj">
                                            <i class="fa fa-plus" style="color: rgb(255, 255, 255);"> {{ trans('messages.hurnemeh') }}</i>
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
                                            <th></th>

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
                                                <td><button type="button" class="btn btn-warning btn-sm update" data-toggle="modal"  data-id="{{$hurungus->investment_id}}" tag="{{$hurungus->investment_id}}"  data-target="#hurungumodal" id="updatehurungu" onclick="updatehurungu({{$hurungus->investment_id}})">
                                                        <i class="fa fa-pencil" style="color: rgb(255, 255, 255);"></i>
                                                    </button></td>
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

    <div class="modal fade " id="hurungumodal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form2" method="post" action="addhurungu" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Хөрөнгө оруулалт </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">

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
                                    <option value= "0">Бүгд</option>childabbr_id
                                    @foreach($executor as $executors)
                                        <option value= "{{$executors->executor_id}}">{{$executors->executor_abbr}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">

                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ trans('messages.tuluwluguu1') }}</label>
                                <input type="text" class="form-control money" id="plan1" name="plan1" maxlength="14">
                                <input type="hidden" class="form-control" id="id" name="id" maxlength="14">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ trans('messages.tuluwluguu2') }}</label>
                                <input type="text" class="form-control money" id="plan2" name="plan2" maxlength="14">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ trans('messages.tuluwluguu3') }}</label>
                                <input type="text" class="form-control money" id="plan3" name="plan3" maxlength="14">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ trans('messages.tuluwluguu4') }}</label>
                                <input type="text" class="form-control money" id="plan4" name="plan4" maxlength="14">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">{{ trans('messages.guitsetgel1') }}</label>
                                <input type="text" class="form-control money" id="budget1" name="budget1" maxlength="14">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">{{ trans('messages.guitsetgel2') }}</label>
                                <input type="text" class="form-control money" id="budget2" name="budget2" maxlength="14">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">{{ trans('messages.guitsetgel3') }}</label>
                                <input type="text" class="form-control money" id="budget3" name="budget3" maxlength="14">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">{{ trans('messages.guitsetgel4') }}</label>
                                <input type="text" class="form-control money" id="budget4" name="budget4" maxlength="14">
                            </div>

                            <div class="form-group col-md-8">
                                <label for="inputZip">{{ trans('messages.tailbar') }}</label>
                                <textarea class="form-control" rows="2" id="description" name="description" maxlength="500"></textarea>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="button" id="deletehurungu" class="btn btn-danger delete">{{ trans('messages.ustgah') }}</button>
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
@endsection

@section('script')
<script>
    function updatehurungu($id){
        document.getElementById('form2').action = "updatehurungu";
        var title = document.getElementById("modal-title");
        title.innerHTML = "{{ trans('messages.tsonhhurungu') }}";

        $.get('hurungufill/'+$id,function(data){
            $.each(data,function(i,qwe){

                $('#id').val(qwe.investment_id);
                $('#constructor_id').val(qwe.depart_id);
                $('#childabbr_id').val(qwe.depart_child);
                $('#budget1').val(qwe.budget1);
                $('#budget2').val(qwe.budget2);
                $('#budget3').val(qwe.budget3);
                $('#budget4').val(qwe.budget4);
                $('#plan1').val(qwe.plan1);
                $('#plan2').val(qwe.plan2);
                $('#plan3').val(qwe.plan3);
                $('#plan4').val(qwe.plan4);
                $('#description').val(qwe.description);


            });

        });

    };
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
    $('#deletehurungu').on('click',function(){

        var itag = $('#id').val();


        $.ajax(
            {
                url: "hurungu/delete/" + itag,
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": itag,
                    "_method": 'DELETE',
                },
                success: function () {
                    alert('Хөрөнгө оруулалт устгагдлаа');
                }

            });
        alert('Хөрөнгө оруулалт устгагдлаа');
        location.reload();


    });
</script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    @include('layouts.script')
@endsection
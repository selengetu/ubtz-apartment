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
                                <form method="post">
                                    <div class="col-md-12" data-scrollable="true" data-height="400" >
                                        <div class="row">

                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">{{ trans('messages.zahialagch') }}</label>
                                                <select class="form-control select2" id="sconstructor_id" name="sconstructor_id">
                                                    <option value= "0">Бүгд</option>
                                                </select>

                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                                                <select class="form-control select2" id="schildabbr_id" name="schildabbr_id">
                                                    <option value= "0">Бүгд</option>

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

    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    @include('layouts.script')
@endsection
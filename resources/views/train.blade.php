@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
    <style>
        fieldset.scheduler-border {
            border: 1px solid #337ab7 !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow:  0 0 0 0 #000;
            box-shadow:  0 0 0 0 #000;
        }
        legend.scheduler-border {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width:auto;
            padding:0 10px;
            border-bottom:none;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Галт тэрэг, өртөө зогсоол, бүрэлдэхүүн</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Inline Charts</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Галт тэрэг сонгох</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <div class="m-scrollable" data-scrollable="true" data-height="400" >
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>№</th>
                                        <th>Т/з</th>
                                        <th>Нэр</th>
                                        <th>Тайлбар</th>
                                        <th>Хурд</th>
                                        <th>Гараг</th>
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
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.col (right) -->



            <!-- row 2 dood-->
            <div class="row">

                <!-- /.col (left) -->

            </div>
        </div>


        <!-- MODAL -->
        <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title trainName"> Галт тэрэг сонгоно уу </h3>
                                <div class="m-portlet__head-tools">
                                    <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm"
                                        role="tablist">
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link active" id="add" data-toggle="tab" href="#"
                                               role="tab">
                                                Шинээр нэмэх
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item" disabled>
                                            <a class="nav-link m-tabs__link" id="edit" style="pointer-events: none; display: inline-block;"
                                               data-toggle="tab" href="#" role="tab">
                                                Засах
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body text-center">
                                <form method="post" action="addtrain" id="addtrain">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="train_no">№</label>
                                                        <input type="text" class="form-control inputtext" maxlength="50" id="train_no"
                                                               name="train_no">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="is_int">Олон улс эсэх</label>
                                                        <select class="form-control select2" id="is_int" name="is_int">
                                                            <option value="0" selected>Орон нутаг</option>
                                                            <option value="1">Олон улс</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="railway_code">Төмөр зам</label>
                                                        <select class="form-control select2" id="railway_code" name="railway_code">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="train_name_mn">Нэр (Монгол)</label>
                                                        <input type="text" class="form-control inputtext" maxlength="50" id="train_name_mn"
                                                               name="train_name_mn">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="train_name_en">Нэр (Англи)</label>
                                                        <input type="text" class="form-control inputtext" maxlength="50" id="train_name_en"
                                                               name="train_name_en">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="train_name_ru">Нэр (Орос)</label>
                                                        <input type="text" class="form-control inputtext" maxlength="50" id="train_name_ru"
                                                               name="train_name_ru">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="train_desciption">Тайлбар</label>
                                                        <input type="text" class="form-control inputtext" id="train_desciption"
                                                               name="train_desciption">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="traintype_code">Хурд</label>
                                                        <select class="form-control select2" id="traintype_code" name="traintype_code">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="margin-top:30px;">
                                                        <label for="train_desciption"></label>
                                                        <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" id="train_id" name="train_id" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Хуваарь</label>
                                            <div class="m-widget2__checkbox">
                                                <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                    Ня
                                                    <input type="checkbox" id="day1" name="day1">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="m-widget2__checkbox">
                                                <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                    Да
                                                    <input type="checkbox" id="day2" name="day2">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="m-widget2__checkbox">
                                                <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                    Мя
                                                    <input type="checkbox" id="day3" name="day3">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="m-widget2__checkbox">
                                                <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                    Лх
                                                    <input type="checkbox" id="day4" name="day4">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="m-widget2__checkbox">
                                                <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                    Пү
                                                    <input type="checkbox" id="day5" name="day5">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="m-widget2__checkbox">
                                                <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                    Ба
                                                    <input type="checkbox" id="day6" name="day6">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="m-widget2__checkbox">
                                                <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                    Бя
                                                    <input type="checkbox" id="day7" name="day7">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div id="myModal2" tabindex="-1" class="modal fade bd-example-modal-lg show" role="dialog">
            <div class="modal-dialog  modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="card" id="editStation">
                                <div class="card-header">
                                    <h3 class="card-title stationName">Өртөө, зогсолт сонгоно уу </h3>
                                    <div class="m-portlet__head-tools">
                                        <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm"
                                            role="tablist">
                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link active" id="addStation" data-toggle="tab"
                                                   href="#" role="tab">
                                                    Шинээр нэмэх
                                                </a>
                                            </li>
                                            <li class="nav-item m-tabs__item" disabled>
                                                <a class="nav-link m-tabs__link" id="editStation" style="pointer-events: none; display: inline-block;"
                                                   data-toggle="tab" href="#" role="tab">
                                                    Засах
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body text-center">
                                    <form method="post" action="addstop" id="addstop">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="m-widget2__checkbox">
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            Зогсно
                                                            <input type="checkbox" id="is_stop" name="is_stop">
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <div class="m-widget2__checkbox">
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                                            Касстай
                                                            <input type="checkbox" id="is_cash" name="is_cash">
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Цагийн бүс</label>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio" id="zone8" checked>+8 УБ</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio" id="zone3">+3 Мос</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="st_id">Өртөө</label>
                                                            <select type="form-control select2" class="form-control inputtext"
                                                                    maxlength="50" id="st_id" name="st_id">
                                                                <option>Сонгоно уу...</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="st_arr">Ирэх цаг</label>
                                                            <input type="text" class="form-control timepicker timepicker-24"
                                                                   name="st_arr" id="st_arr">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="st_dep">Явах цаг</label>
                                                            <input type="text" class="form-control timepicker timepicker-24"
                                                                   name="st_dep" id="st_dep">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="st_km">Км</label>
                                                            <input type="number" class="form-control inputtext" maxlength="50"
                                                                   id="st_km" name="st_km">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="date1">Эхлэх хугацаа </label>
                                                            <input class="form-control form-control-inline  date-picker"
                                                                   name="date1" id="date1" size="16" type="text" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="date2">Дуусах хугацаа</label>
                                                            <input class="form-control form-control-inline date-picker"
                                                                   name="date2" id="date2" size="16" type="text" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="st_pos">#</label>
                                                            <input type="text" class="form-control inputtext" maxlength="50"
                                                                   id="st_pos" name="st_pos">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" id="stop_id" name="stop_id" value="0">
                                                            <input type="hidden" id="stop_train_id" name="stop_train_id"
                                                                   value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>





                            <div class="card" id="editWagon" style="display: none">
                                <div class="card-header">
                                    <h3 class="card-title stationName wagonName">Вагон сонгоно уу</h3>
                                    <div class="m-portlet__head-tools">
                                        <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm"
                                            role="tablist">
                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link active" id="addwagonbutton" data-toggle="tab"
                                                   href="#" role="tab">
                                                    Шинээр нэмэх
                                                </a>
                                            </li>
                                            <li class="nav-item m-tabs__item" disabled>
                                                <a class="nav-link m-tabs__link" id="editwagonbutton" style="pointer-events: none; display: inline-block;"
                                                   data-toggle="tab" href="#" role="tab">
                                                    Засах
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body text-center">
                                    <form method="post" action="addwagon" id="addwagon">
                                        <fieldset class="scheduler-border">
                                            <legend class="scheduler-border">Ажлын мест</legend>
                                            <div class="row">

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="wag_pos">№</label>
                                                        <input type="number" class="form-control inputtext" maxlength="2" id="wag_pos"
                                                               name="wag_pos" value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="wag_no">Вагон нэр:</label>
                                                        <input type="text" class="form-control inputtext" maxlength="50" id="wag_no"
                                                               name="wag_no">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="wag_type">Вагон төрөл</label>
                                                        <select class="form-control inputtext" id="wag_type" name="wag_type">
                                                            <option>Сонгоно уу...</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="wag_rail">Төмөр зам</label>
                                                        <select class="form-control inputtext" id="wag_rail" name="wag_rail">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class='row'>
                                            <div class="col-md-3 offset-4">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" id="wag_id" name="wag_id" value="0">
                                                    <input type="hidden" id="wag_train_id" name="wag_train_id" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m--space-30"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">Ажлын мест</legend>

                                                    <div class="row" id="trainMest">

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-md-offset-6">
                                                            <button id="getmest" class="btn btn-primary">Хадгалах</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Хаах</button>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>



                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
        </div>
    </section>

        @endsection

        @section('script')


@endsection

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
                <div class="form-group col-md-4">

                    <select class="form-control select2" id="constructor_id" name="constructor_id" >
                        <option value= "0">Бүгд</option>
                        @foreach($projecttype as $projecttypes)
                            <option value= "{{$projecttypes->project_type_id}}">{{$projecttypes->project_type_name_mn}}</option>
                        @endforeach
                    </select>

                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">2019 оны их барилга, их засварын ажлууд </h3>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Их барилга, их засварын ажил бүртгэх</i>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">

                            <div class="table-responsive" data-scrollable="true" data-height="400" >
                                <table class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Байгууллага</th>
                                        <th>Гүйцэтгэгч</th>
                                        <th>Ажлын нэр</th>
                                        <th>2018 оны төлөвлөгөө</th>

                                        <th>Төсөв</th>
                                        <th>Гүйцэтгэл</th>
                                        <th>Үүнээс</th>
                                        <th>Биелэлт</th>
                                        <th>Хариуцагч инженер</th>
                                        <th>Тайлбар</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($project as $projects)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$projects->department_name}}</td>
                                            <td>{{$projects->executor_abbr}}</td>
                                            <td>{{$projects->project_name}}</td>
                                            <td><?php
                                                echo number_format($projects->plan)."<br>";
                                                ?></td>

                                            <td><?php
                                                echo number_format($projects->estimation)."<br>";
                                                ?></td>
                                            <td><?php
                                                echo number_format($projects->economic)."<br>";
                                                ?></td>
                                            <td><?php
                                                echo number_format($projects->economic)."<br>";
                                                ?></td>

                                            <td>{{$projects->percent}}%</td>
                                            <td>{{$projects->firstname}}</td>
                                            <td>{{$projects->state_name_mn}}</td>
                                            <td><button class="btn btn-primary">   <i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Гүйцэтгэл</i></button></td>
                                        </tr>
                                        <?php $no++; ?>
                                    @endforeach
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
    </section>
    <div class="modal fade " id="exampleModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form1" method="post" action="addproject">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Их барилга, их засварын ажил бүртгэх цонх</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Ажлын төрөл</label>
                                <select class="form-control select2" id="project_type" name="project_type" >
                                    @foreach($projecttype as $projecttypes)
                                        <option value= "{{$projecttypes->project_type_id}}">{{$projecttypes->project_type_name_mn}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Захиалагч</label>
                                <select class="form-control select2" id="constructor_id" name="constructor_id" >
                                    @foreach($constructor as $constructors)
                                        <option value= "{{$constructors->department_id}}">{{$constructors->department_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Гүйцэтгэгч</label>
                                <select class="form-control select2" id="executor_id" name="executor_id" >
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
                                <select class="form-control select2" id="respondent_emp_id" name="respondent_emp_id" >
                                @foreach($employee as $employees)
                                    <option value= "{{$employees->emp_id}}">{{$employees->firstname}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Төлөвлөгөө</label>
                                <input type="text" class="form-control money" id="plan" name="plan" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Төсөв</label>
                                <input type="text" class="form-control money" id="estimation" name="estimation">
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="inputZip">Үүнээс хаасан</label>
                                <input type="text" class="form-control money" id="economic" name="economic">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">Биелэлт</label>
                                <input type="text" class="form-control" id="percent" name="percent" placeholder="99.9" maxlength="4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">Төлөв</label>
                                <select class="form-control select2" id="state_id" name="state_id" >
                                    @foreach($state as $states)
                                        <option value= "{{$states->state_id}}">{{$states->state_name_mn}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">Тайлбар</label>
                                <textarea class="form-control" rows="2" id="description" name="description" maxlength="500"></textarea>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                    <button type="button" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').dataTable( {
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
        } );
    </script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript">

        $('.money').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,

            rightAlign: false,
            oncleared: function () { self.Value(''); }
        });

    </script>

@endsection
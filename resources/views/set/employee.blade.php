@extends('layouts.master')

@section('style')

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-4">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="m-0">НОКС албаны ажилтанууд</h4>
                                </div>
                                <div class="col-md-2 col-xs-5">
                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary form-control" style="padding-bottom: 10px;"><i class="fa fa-pencil-square-o" style="color: rgb(255, 255, 255);"> Ажилтан нэмэх</i></button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <div class="m-scrollable" data-scrollable="true" data-height="400" >
                                <table class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Овог</th>
                                        <th>Нэр</th>
                                        <th>Албан тушаал</th>
                                        <th>Ажилд орсон огноо</th>
                                        <th>Ажлаас гарсан огноо</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($employee as $employees)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$employees->firstname}}</td>
                                            <td>{{$employees->lastname}}</td>
                                            <td>{{$employees->depart_id}} - {{$employees->prof_id}}</td>
                                            <td>{{$employees->hired_date}}</td>
                                            <td>{{$employees->fired_date}}</td>
                                            <td class='m1'> <a class='btn btn-xs btn-info update' data-toggle='modal' data-target='#exampleModal' data-id="{{$employees->executor_id}}" tag='{{$employees->executor_id}}'><i class="fa fa-plus-square-o" style="color: rgb(255, 255, 255); "></i></a> </td>
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
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Захиалагч</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputAddress">Овог</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Нэр</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Албан тушаал</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Ажилд орсон огноо</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Ажлаас гарсан огноо</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                    <button type="button" class="btn btn-primary">Хадгалах</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable(
                {

                }
            );
        } );
    </script>
@endsection
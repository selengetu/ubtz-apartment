@extends('layouts.master')

@section('style')

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>Их барилга</h1>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Нэмэх
                    </button>
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
                            <div class="col-md-6">
                                <h3 class="card-title">2018 оны эхний 11 сарын их барилга</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <div class="m-scrollable" data-scrollable="true" data-height="400" >
                                <table class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Байгууллага</th>
                                        <th>Гүйцэтгэгч</th>
                                        <th>Ажлын нэр</th>
                                        <th>2018 оны төлөвлөгөө</th>
                                        <th>2018 оны өөрчлөгдсөн төлөвлөгөө</th>
                                        <th>Төсөв</th>
                                        <th>Эхний 11 сарын өссөн дүн</th>
                                        <th>Үүнээс</th>
                                        <th>Биелэлт</th>
                                        <th>Графикийн дагуу дуусах огноо</th>
                                        <th>Дууссан огноо</th>
                                        <th>Хугацаа  хэтэрсэн огноо</th>
                                        <th>Гэмтлийн акт</th>
                                        <th>Хариуцагч инженер</th>
                                        <th>Тайлбар</th>
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
    </section>
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Захиалагч</label>
                                <select class="form-control select2" id="constructor_id" name="constructor_id" >
                                    @foreach($constructor as $constructors)
                                        <option value= "{{$constructors->department_id}}">{{$constructors->department_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Гүйцэтгэгч</label>
                                <select class="form-control select2" id="executor_id" name="executor_id" >
                                    @foreach($executor as $executors)
                                        <option value= "{{$executors->executor_id}}">{{$executors->executor_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress">Ажлын нэр</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Төлөвлөгөө</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCity">Төсөв</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputState">Гүйцэтгэл</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">Үүнээс хаасан</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">Биелэлт</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">Хариуцагч</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">Тайлбар</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
                    "scrollX": true
                }
            );
        } );
    </script>
@endsection
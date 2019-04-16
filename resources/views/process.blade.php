@extends('layouts.master')

@section('style')

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Их засвар</h1>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">2018 оны эхний 11 сарын их засвар</h3>
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
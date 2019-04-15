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
                                <div class="col-md-6">
                                    <h4 class="m-0">Ажлын гүйцэтгэлийн төлөв байдлын тодорхойлолт</h4>
                                </div>
                                <div class="col-md-2 col-xs-5">
                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary add" style="padding-bottom: 10px;"><i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Ажлын төлөв нэмэх</i></button>
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
                                        <th>Ажлын төлвийн нэр</th>
                                        <th>Статус работы по русский</th>

                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($state as $states)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$states->state_name_mn}}</td>
                                            <td>{{$states->state_name_ru}}</td>

                                            <td class='m1'> <a class='btn btn-xs btn-info update' data-toggle='modal' data-target='#exampleModal' data-id="{{$states->state_id}}" tag='{{$states->state_id}}'><i class="fa fa-pencil-square-ofa fa-pencil-square-o" style="color: rgb(255, 255, 255); "></i></a> </td>
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
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form1" action="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Ажлын гүйцэтгэлийн төлөв бүртгэх цонх</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputAddress">Ажлын төлвийн нэр</label>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="text" class="form-control" id="state_name_mn" name="state_name_mn" placeholder="" maxlength="50">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Статус работы по русский</label>
                                <input type="text" class="form-control" id="state_name_ru" name="state_name_ru" placeholder="" maxlength="50">
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <button type="button" class="btn btn-danger delete">Устгах</button>
                        </div>
                        <div class="col-md-7" style="display: inline-block; text-align: right;" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                            <button type="submit" class="btn btn-primary">Хадгалах</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script>
        $(".date-picker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    </script>
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
    <script>
        $('.update').on('click',function(){
            var title = document.getElementById("modal-title");
            title.innerHTML = "Ажлын гүйцэтгэлийн төлөв засварлах цонх";
            document.getElementById('form1').action = "updatestate";
            document.getElementById('form1').method ="post"
            var itag=$(this).attr('tag');
            $.get('statefill/'+itag,function(data){
                $.each(data,function(i,qwe){
                    $('#id').val(qwe.state_id);
                    $('#state_name_ru').val(qwe.state_name_ru);
                    $('#state_name_mn').val(qwe.state_name_mn);

                });

            });
            $('.delete').show();
        });
    </script>
    <script>
        $('.add').on('click',function(){
            var title = document.getElementById("modal-title");
            title.innerHTML = "Ажлын гүйцэтгэлийн төлөв бүртгэх цонх";
            document.getElementById('form1').action = "addstate"
            document.getElementById('form1').method ="post"
            $('#id').val('');
            $('#state_name_ru').val('');
            $('#state_name_mn').val('');
            $('.delete').hide();
        });
        $('.delete').on('click',function(){
            var itag = $('#id').val();

            $.ajax(
                {
                    url: "state/delete/" + itag,
                    type: 'GET',
                    dataType: "JSON",
                    data: {
                        "id": itag,
                        "_method": 'DELETE',
                    },
                    success: function () {
                        alert('Ажлын гүйцэтгэлийн төлөв устгагдлаа');
                    }

                });
            alert('Ажлын гүйцэтгэлийн төлөв устгагдлаа');
            location.reload();
        });
    </script>
@endsection
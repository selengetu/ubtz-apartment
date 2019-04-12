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
                                    <h4 class="m-0">Ажлын гүйцэтгэгч байгууллагууд</h4>
                                </div>
                                <div class="col-md-2 col-xs-5">
                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary form-control add" style="padding-bottom: 10px;"><i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Гүйцэтгэгч нэмэх</i></button>
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
                                        <th>Гүйцэтгэгч байгууллагын нэр</th>
                                        <th>Гүйцэтгэгч байгууллагын нэр</th>
                                        <th>Гүйцэтгэгч байгууллагын товчилсон нэр</th>
                                        <th>УБТЗ эсэх</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($executor as $executors)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$executors->executor_name}}</td>
                                            <td>{{$executors->executor_name_ru}}</td>
                                            <td>{{$executors->executor_abbr}}</td>
                                            <td>@if($executors->is_ubtz == 0)
                                            үгүй
                                                    @elseif($executors->is_ubtz == 1)
                                                тийм
                                                    @endif
                                            </td>
                                            <td class='m1'> <a class='btn btn-xs btn-info update' data-toggle='modal' data-target='#exampleModal' data-id="{{$executors->executor_id}}" tag='{{$executors->executor_id}}'><i class="fa fa-pencil-square-o" style="color: rgb(255, 255, 255); "></i></a> </td>
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
                <form id="form1" action="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Ажлын гүйцэтгэгч байгууллагууд бүртгэх цонх</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputAddress">Гүйцэтгэгч байгууллагын нэр</label>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="text" class="form-control" id="executor_name" name="executor_name" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Гүйцэтгэгч байгууллагын товчилсон нэр</label>
                                <input type="text" class="form-control" id="executor_abbr" name="executor_abbr" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Гүйцэтгэгч байгууллагын нэр</label>
                                <input type="text" class="form-control" id="executor_name_ru" name="executor_name_ru" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">УБТЗ эсэх</label>
                                <select class="form-control select2" id="is_ubtz" name="is_ubtz" >

                                        <option value= "1">Тийм</option>
                                    <option value= "0">Үгүй</option>
                                </select>
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
            title.innerHTML = "Ажлын гүйцэтгэгч байгууллагууд засварлах цонх";
            document.getElementById('form1').action = "updateexecutor";
            document.getElementById('form1').method ="post"
            var itag=$(this).attr('tag');
            $.get('executorfill/'+itag,function(data){
                $.each(data,function(i,qwe){
                    $('#id').val(qwe.executor_id);
                    $('#executor_name').val(qwe.executor_name);
                    $('#executor_abbr').val(qwe.executor_abbr);
                    $('#executor_name_ru').val(qwe.executor_name_ru);
                    $('#is_ubtz').val(qwe.is_ubtz);
                });

            });
            $('.delete').show();
        });
    </script>
    <script>
        $('.add').on('click',function(){
            var title = document.getElementById("modal-title");
            title.innerHTML = "Ажлын гүйцэтгэгч байгууллагууд бүртгэх цонх";
            document.getElementById('form1').action = "addexecutor"
            document.getElementById('form1').method ="post"
            $('#id').val('');
            $('#executor_name').val('');
            $('#executor_abbr').val('');
            $('#executor_name_ru').val('');
            $('#is_ubtz').val(1);
            $('.delete').hide();
        });

        $('.delete').on('click',function(){
            var itag = $('#id').val();

            $.ajax(
                {
                    url: "executor/delete/" + itag,
                    type: 'GET',
                    dataType: "JSON",
                    data: {
                        "id": itag,
                        "_method": 'DELETE',
                    },
                    success: function () {
                        alert('Ажлын гүйцэтгэгч устгагдлаа');
                    }

                });
            alert('Ажлын гүйцэтгэгч устгагдлаа');
            location.reload();
        });
    </script>
@endsection

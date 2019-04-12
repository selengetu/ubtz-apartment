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
                                    <h4 class="m-0">НОКС албаны албан тушаал</h4>
                                </div>
                                <div class="col-md-2 col-xs-5">
                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary form-control add" style="padding-bottom: 10px;"><i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Албан тушаал нэмэх</i></button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <div class="m-scrollable" data-scrollable="true" data-height="400" >
                                <table class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr role="row" bgcolor="#d3d3d3">
                                        <th>#</th>
                                        <th>Албан тушаалын нэр</th>
                                        <th>Ажилтаны тоо</th>
                                        <th>Ажил үүргийн тайлбар</th>

                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($prof as $pro)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$pro->profession_name}}</td>
                                            <td>{{$pro->profession_num}}</td>
                                            <td>{{$pro->description}}</td>

                                            <td class='m1'> <a class='btn btn-xs btn-info update' data-toggle='modal' data-target='#exampleModal' data-id="{{$pro->profession_id}}" tag='{{$pro->profession_id}}'><i class="fa fa-pencil-square-o" style="color: rgb(255, 255, 255); "></i></a> </td>
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
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <form id="form1" action="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Албан тушаал</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Албан тушаалын нэр</label>
                                <input type="text" class="form-control" id="profession_name" name="profession_name" placeholder="" maxlength="50">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Ажилтаны тоо</label>
                                <input type="number" class="form-control" id="profession_num" name="profession_num" placeholder="" maxlength="3">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Ажил үүргийн тайлбар</label>
                                <textarea class="form-control" rows="2" id="description" name="description"></textarea>

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
            title.innerHTML = "Албан тушаал засварлах цонх";
            document.getElementById('form1').action = "updateprof";
            document.getElementById('form1').method ="post"
            var itag=$(this).attr('tag');
            $.get('proffill/'+itag,function(data){
                $.each(data,function(i,qwe){
                    $('#id').val(qwe.profession_id);
                    $('#profession_name').val(qwe.profession_name);
                    $('#profession_num').val(qwe.profession_num);
                    $('#description').val(qwe.description);
                });

            });
            $('.delete').show();
        });
    </script>
    <script>
        $('.add').on('click',function(){
            var title = document.getElementById("modal-title");
            title.innerHTML = "Шинэ албан тушаал бүртгэх цонх";
            document.getElementById('form1').action = "addprof"
            document.getElementById('form1').method ="post"
            $('#id').val('');
            $('#profession_name').val('');
            $('#profession_num').val('');
            $('#description').val('');
            $('.delete').hide();
        });
        $('.delete').on('click',function(){
            var itag = $('#id').val();

                $.ajax(
                    {
                        url: "prof/delete/" + itag,
                        type: 'GET',
                        dataType: "JSON",
                        data: {
                            "id": itag,
                            "_method": 'DELETE',
                        },
                        success: function () {
                            alert('Албан тушаал устгагдлаа');
                        }

                    });
            alert('Албан тушаал устгагдлаа');
            location.reload();
        });
    </script>
@endsection
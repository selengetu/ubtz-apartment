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
                                    <h4 class="m-0">Ажлын захиалагч байгууллагууд</h4>
                                </div>
                                <div class="col-md-2 col-xs-5">
                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary form-control add" style="padding-bottom: 10px;"><i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Ажил захиалагч нэмэх</i></button>
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
                                        <th>Ажил захиалагчийн нэр</th>
                                        <th>Ажил захиалагчийн товч нэр</th>
                                        <th>Ажил захиалагчийн нэр</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($constructor as $constructors)
                                        <tr class="tuuzzurchil" data-toggle="modal" data-target="#feedmodal" data-id="{{$constructors->department_id}}" tag="{{$constructors->department_id}}">
                                            <td>{{$no}}</td>
                                            <td>{{$constructors->department_name}}</td>
                                            <td>{{$constructors->department_abbr}}</td>
                                            <td>{{$constructors->department_name_ru}}</td>
                                            <td class='m1'> <a class='btn btn-xs btn-info update' data-toggle='modal' data-target='#exampleModal' data-id="{{$constructors->department_id}}" tag='{{$constructors->department_id}}'><i class="fa fa-pencil-square-o" style="color: rgb(255, 255, 255); "></i></a> </td>
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
                        <h5 class="modal-title" id="modal-title">Ажил захиалагч бүртгэх цонх</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputAddress">Ажил захиалагчийн нэр</label>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="text" class="form-control" id="constructor_name" name="constructor_name" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2"> Ажил захиалагчийн товч нэр</label>
                                <input type="text" class="form-control" id="constructor_abbr" name="constructor_abbr" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Ажил захиалагчийн нэр</label>
                                <input type="text" class="form-control" id="constructor_name_ru" name="constructor_name_ru">
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
            title.innerHTML = "Ажил захиалагч байгууллагууд засварлах цонх";
            document.getElementById('form1').action = "updateconstructor";
            document.getElementById('form1').method ="post"
            var itag=$(this).attr('tag');
            $.get('constructorfill/'+itag,function(data){
                $.each(data,function(i,qwe){
                    $('#id').val(qwe.department_id);
                    $('#constructor_name').val(qwe.department_name);
                    $('#constructor_abbr').val(qwe.department_abbr);
                    $('#constructor_name_ru').val(qwe.department_name_ru);

                });

            });
            $('.delete').show();
        });
    </script>
    <script>
        $('.add').on('click',function(){
            var title = document.getElementById("modal-title");
            title.innerHTML = "Ажил захиалагч байгууллагууд бүртгэх цонх";
            document.getElementById('form1').action = "addconstructor"
            document.getElementById('form1').method ="post"
            $('#id').val('');
            $('#constructor_name').val('');
            $('#constructor_abbr').val('');
            $('#constructor_name_ru').val('');
            $('.delete').hide();
        });

        $('.delete').on('click',function(){
            var itag = $('#id').val();

            $.ajax(
                {
                    url: "constructor/delete/" + itag,
                    type: 'GET',
                    dataType: "JSON",
                    data: {
                        "id": itag,
                        "_method": 'DELETE',
                    },
                    success: function () {
                        alert('Ажил захиалагч устгагдлаа');
                    }

                });
            alert('Ажил захиалагч устгагдлаа');
            location.reload();
        });
    </script>
@endsection

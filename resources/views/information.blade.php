@extends('layouts.master')

@section('style')

<style>
    .date-picker{z-index: 9999 !important};
</style>
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
                                <h4 class="m-0">{{ trans('messages.medeelel') }}</h4>
                            </div>
                            <div class="col-md-2 col-xs-5">
                                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary  add" style="padding-bottom: 10px;"><i class="fa fa-plus" style="color: rgb(255, 255, 255);"></i> Мэдээлэл нэмэх</button>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body text-center">
                        <div class="m-scrollable" data-scrollable="true" data-height="400" >
                            <table class="table table-striped table-bordered" id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Төрөл</th>
                                    <th>Мэдээлэл</th>
                                    <th>Дуусах огноо</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>
                                @foreach($information as $informations)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$informations->type_name}}</td>
                                        <td>{{$informations->information_content}}</td>
                                        <td>{{$informations->end_date}}</td>
                                        <td class='m1'> <a class='btn btn-xs btn-info update' data-toggle='modal' data-target='#exampleModal' data-id="{{$informations->information_id}}" tag='{{$informations->information_id}}'><i class="fa fa-pencil-square-o" style="color: rgb(255, 255, 255); "></i></a> </td>
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
<div class="modal fade " id="photomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form2" action="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Зураг харах</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">

                        <img id="imgpath" width="500px">

                    </div>


                </div>
                <div class="modal-footer">

                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form1" action="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Шинэ мэдээлэл цонх</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputCity">Төрөл</label>
                            <select class="form-control select2" id="information_type" name="information_type" >
                                @foreach($type as $types)
                                    <option value= "{{$types->type_id}}">{{$types->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputAddress">Мэдээлэл</label>
                            <input type="text" class="form-control" id="information_content" name="information_content" placeholder="" maxlength="50">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputCity">Дуусах огноо</label>
                            <input class="form-control form-control-inline input-medium date-picker" name="end_date" id="end_date" placeholder="2019-04-15">
                        </div>
                        <div class="col-md-6" style="display: none">
                            @if ($message = Session::get('success'))

                                <div class="alert alert-success alert-block">

                                    <button type="button" class="close" data-dismiss="alert">×</button>

                                    <strong>{{ $message }}</strong>

                                </div>

                                <img src="images/{{ Session::get('image') }}">

                            @endif



                            @if (count($errors) > 0)

                                <div class="alert alert-danger">

                                    <strong>Whoops!</strong> There were some problems with your input.

                                    <ul>

                                        @foreach ($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif
                            <input type="file" name="image" class="form-control">
                                <img id="imgpath1" width="500px">
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
        title.innerHTML = "Мэдээлэл засварлах цонх";
        document.getElementById('form1').action = "updateinformation";
        document.getElementById('form1').method ="post"
        var itag=$(this).attr('tag');
        $.get('informationfill/'+itag,function(data){
            $.each(data,function(i,qwe){
                $('#id').val(qwe.information_id);
                $('#information_type').val(qwe.information_type);
                $('#information_content').val(qwe.information_content);
                $('#end_date').val(qwe.end_date);
                $("#imgpath1").attr('src',"http://192.168.4.176/barilga/public/profile_images/inf/"+qwe.img_path+"");
            });

        });
        $('.delete').show();
    });
    $('.see').on('click',function(){
        var itag=$(this).attr('tag');
                $("#imgpath").attr('src',"http://192.168.4.176/barilga/public/profile_images/inf/"+itag+"");
    });
</script>
<script>
    $('.add').on('click',function(){
        var title = document.getElementById("modal-title");
        title.innerHTML = "Шинэ мэдээлэл бүртгэх цонх";
        document.getElementById('form1').action = "addinformation"
        document.getElementById('form1').method ="post"
        $('#id').val('');
        $('#information_name').val('');
    });
    $('.delete').on('click',function(){
        var itag = $('#id').val();

        $.ajax(
            {
                url: "information/delete/" + itag,
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": itag,
                    "_method": 'DELETE',
                },
                success: function () {
                    alert('Мэдээлэл устгагдлаа');
                }

            });
        alert('Мэдээлэл устгагдлаа');
        location.reload();
    });
</script>
@endsection

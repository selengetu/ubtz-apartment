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
                                    <h4 class="m-0">НОКС албаны ажилтанууд</h4>
                                </div>
                                <div class="col-md-2 col-xs-5">
                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary  add" style="padding-bottom: 10px;"><i class="fa fa-plus" style="color: rgb(255, 255, 255);"> Ажилтан нэмэх</i></button>
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
                                        <th>Албан тушаал</th>
                                        <th>Ажилтны овог</th>
                                        <th>Ажилтны нэр</th>
                                        <th>Хариуцах ажлын үндсэн чиглэл</th>
                                        <th>Утасны дугаар</th>
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
                                            <td>{{$employees->department_name}} - {{$employees->profession_name}}</td>
                                            <td>{{$employees->lastname}}</td>
                                            <td>{{$employees->firstname}}</td>
                                            <td>{{$employees->mainduty}}</td>
                                            <td>{{$employees->phone}}</td>
                                            <td>{{date('Y-m-d', strtotime($employees->hired_date))}}</td>
                                            <td>{{date('Y-m-d', strtotime($employees->fired_date))}}</td>
                                            <td class='m1'> <a class='btn btn-xs btn-info update' data-toggle='modal' data-target='#exampleModal' data-id="{{$employees->emp_id}}" tag='{{$employees->emp_id}}'><i class="fa fa-pencil-square-o" style="color: rgb(255, 255, 255); "></i></a> </td>
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
                    <h5 class="modal-title" id="modal-title">Шинэ ажилтан бүртгэх цонх</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputAddress">Овог</label>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" maxlength="50">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Нэр</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" maxlength="50">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Албан тушаал</label>
                                <select class="form-control select2" id="prof_id" name="prof_id" >
                                    @foreach($prof as $profs)
                                        <option value= "{{$profs->profession_id}}">{{$profs->profession_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Утасны дугаар</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="" maxlength="8">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Хариуцах ажлын үндсэн чиглэл</label>
                                <textarea class="form-control" rows="2" id="mainduty" name="mainduty"></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">Ажилд орсон огноо</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="date1" id="date1"
                                       size="16" type="text" value="" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">Ажлаас гарсан огноо</label>
                                <input class="form-control form-control-inline input-medium date-picker" name="date2" id="date2"
                                       size="16" type="text" value="" required>
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
            title.innerHTML = "Албан ажилтан засварлах цонх";
            document.getElementById('form1').action = "updateemployee";
            document.getElementById('form1').method ="post"
            var itag=$(this).attr('tag');
            $.get('employeefill/'+itag,function(data){
                $.each(data,function(i,qwe){
                    $('#id').val(qwe.emp_id);
                    $('#firstname').val(qwe.firstname);
                    $('#lastname').val(qwe.lastname);
                    $('#date1').val(qwe.hired_date);
                    $('#date2').val(qwe.fired_date);
                    $('#prof_id').val(qwe.prof_id);
                    $('#mainduty').val(qwe.mainduty);
                    $('#phone').val(qwe.phone);
                });

            });
            $('.delete').show();
        });
    </script>
    <script>
        $('.add').on('click',function(){
            var title = document.getElementById("modal-title");
            title.innerHTML = "Шинэ ажилтан бүртгэх цонх";
            document.getElementById('form1').action = "addemployee"
            document.getElementById('form1').method ="post"
            $('#id').val('');
            $('#firstname').val('');
            $('#lastname').val('');
            $('#date1').val('');
            $('#date2').val('');
            $('#prof_id').val(1);
            $('#mainduty').val('');
            $('#phone').val('');
            $('.delete').hide();
        });
        $('.delete').on('click',function(){
            var itag = $('#id').val();

            $.ajax(
                {
                    url: "employee/delete/" + itag,
                    type: 'GET',
                    dataType: "JSON",
                    data: {
                        "id": itag,
                        "_method": 'DELETE',
                    },
                    success: function () {
                        alert('Ажилтан устгагдлаа');
                    }

                });
            alert('Ажилтан устгагдлаа');
            location.reload();
        });
    </script>
@endsection

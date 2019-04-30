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


                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card"  style="margin-top: 20px">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Хайлт </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <form method="post" action="album">
                                <div class="col-md-12" data-scrollable="true" data-height="400" >
                                    <div class="row" >
                                        <div class="form-group col-md-2">

                                            <label for="inputEmail4">Ажлын төрөл</label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <select class="form-control select2" id="sproject_type" name="sproject_type" >
                                                <option value= "0">Бүгд</option>
                                                @foreach($projecttype as $projecttypes)
                                                    <option value= "{{$projecttypes->project_type_id}}">{{$projecttypes->project_type_name_mn}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2">
                                            <div class="form-group col-md-2">
                                                <label for="inputZip"><span>.</span></label><br>
                                                <button type="submit" class="btn btn-primary" >Хайх</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="card-title">2019 оны их барилга, их засварын ажлууд </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">

                            <div class="table-responsive">
                                <div class="row">

                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="example" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">

                                            <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($project as $projects)
                                                <tr><td colspan="4"><center>{{$no}}. {{$projects->department_name}}  {{$projects->project_name}}</center></td></tr>
                                                <tr>
                                                    <td colspan="2"><img src="{{asset('profile_images/img/').'/'.$projects->image_b1}}" alt="profile Pic" height="400"></td>
                                                    <td colspan="2"><img src="{{asset('profile_images/img/').'/'.$projects->image_b2}}" alt="profile Pic" height="400">s</td>
                                                <tr>
                                                <tr>
                                                    <td>Төлөвлөгөө:</td>
                                                    <td>{{$projects->plan}}</td>
                                                    <td>Эхлэсэн огноо</td>
                                                    <td>{{$projects->start_date}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Гүйцэтгэл:</td>
                                                    <td>{{$projects->budget}}</td>
                                                    <td>Дууссан огноо</td>
                                                    <td>{{$projects->end_date}}</td>
                                                </tr>
                                                <?php $no++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                                <br>


                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12">

                        <!-- /.card -->
                    </div>

                </div>



            </div>
        </div>
        </div>
        </div>

        <!-- /.col (right) -->



        <!-- row 2 dood-->

        </div>
    </section>

@endsection

@section('script')

    @include('layouts.script')

@endsection
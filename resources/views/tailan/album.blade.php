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


                <div class="tab-pane fade show active offset-1" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="width:80%">
                    <div class="card"  style="margin-top: 20px">
                        <div class="card-header" id="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">{{ trans('messages.hailt') }} </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <form method="post" action="album">
                                <div class="col-md-12" >
                                    <div class="row" id="searchrow">
                                        <div class="form-group col-md-3">

                                            <label for="inputEmail4">{{ trans('messages.ajliinturul') }}</label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <select class="form-control select2" id="sproject_type" name="sproject_type" >
                                                <option value= "0"> @if ( Config::get('app.locale') == 'mn') Бүгд @else Все @endif</option>
                                                @foreach($projecttype as $projecttypes)

                                                    <option value= "{{$projecttypes->project_type_id}}">
                                                        @if ( Config::get('app.locale') == 'mn')
                                                        {{$projecttypes->project_type_name_mn}}
                                                            @else
                                                            {{$projecttypes->project_type_name_ru}}

                                                        @endif
                                                    </option>

                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2">
                                            <div class="form-group col-md-2">
                                                <label for="inputZip"><span>.</span></label><br>
                                                <button type="submit" class="btn btn-primary" >{{ trans('messages.haih') }}</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card" style="width:100%">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="card-title">{{ trans('messages.photo') }} </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <div class="col-md-12" >
                                    <div class="col-md-11" >
                                        <table class="table table-bordered" id="example" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">

                                            <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($project as $projects)
                                                <tr><td colspan="4" bgcolor="#89c2ff"><center><b>{{$no}}. {{$projects->department_name}}  {{$projects->project_name}}</b></center></td></tr>

                                                <tr>
                                                 <td colspan="2" ><center>
                                                 
                                                                        <img src="{{asset('profile_images/img/').'/'.$projects->img_1}}"  width="300px">
                                                                        @endif
                                                                    </center></td>
                                                        
                                                                    <td colspan="2"><center>
                                                                   
                                                                        <img src="{{asset('profile_images/img/').'/'.$projects->img_2}}"  width="300px">
                                                              
                                                                        </center></td>
                                                         
                                                </tr>
                                            <tr>



                                                    <td><b>{{ trans('messages.tuluwluguu') }}:</b></td>
                                                    <td>{{number_format($projects->plan)}}</td>
                                                    <td><b>{{ trans('messages.ehelsen') }}</b></td>
                                                    <td>{{$projects->start_date}}</td>
                                                </tr>

                                                <tr>
                                                    <td><b>{{ trans('messages.guitsetgel') }}:</b></td>
                                                    <td>{{number_format($projects->budget)}}</td>
                                                    <td><b>{{ trans('messages.duussan') }}</b></td>
                                                    <td>{{$projects->end_date}}</td>
                                                </tr>
                                                <?php $no++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                        </div>
                                <br>


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

        </div>
    </section>
<style>
    @media print {

        .card-header, #searchrow, .main-footer{

            display: none !important;

        }
    }
</style>
@endsection

@section('script')

    @include('layouts.script')
    <script type="text/javascript">

    </script>
@endsection
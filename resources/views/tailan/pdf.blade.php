<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                                        <table class="table table-bordered" id="example" border="1" style="font-size:12px; width:100%; border-collapse: collapse;">

                                            <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($project as $projects)
                                                <tr><td colspan="4" bgcolor="#89c2ff" style="text-align:center"><b>{{$no}}. {{$projects->department_name}}  {{$projects->project_name}}</b></td></tr>
                                                <tr>
                                                    <td colspan="2" width="400px" style="text-align:center"><img src="{{ asset('profile_images/img/'.$projects->img_1)}}" height="350"></td>
                                                    <td colspan="2" width="400px" style="text-align:center"><img src="{{ asset('profile_images/img/'.$projects->img_2 )}}" height="350"></td>
                                                <tr>
                                                    <tr>
                                                        <td colspan="2" width="400px" style="text-align:center"><img src="{{ asset('profile_images/img/'.$projects->img_3)}}" height="350"></td>
                                                        <td colspan="2" width="400px" style="text-align:center"><img src="{{ asset('profile_images/img/'.$projects->img_4 )}}" height="350"></td>
                                                    <tr>
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
<style>
    table {
        font-family: DejaVu Sans;
    }
</style>
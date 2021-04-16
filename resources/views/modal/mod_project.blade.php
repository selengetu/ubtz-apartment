<div class="modal fade " id="exampleModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" id="form1">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">{{ trans('messages.tsonh') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="type" name="type">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="hidden" class="form-control" id="proj" name="proj" value="{{$sprojecttype}}">
                            <label for="inputEmail4">{{ trans('messages.ajliinarga') }}</label>
                            <select class="form-control" id="method_code" name="method_code">
                                @foreach($method as $methods)
                                    <option value= "{{$methods->method_code}}">{{$methods->method_name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">{{ trans('messages.zahialagchnegj') }}</label>
                            <select class="form-control" id="childabbr_id" name="childabbr_id">
                                <option value= "0">Бүгд</option>
                                @foreach($executor as $executors)
                                    @if($executors->is_ubtz==1)
                                    <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                        @else {{$executors->executor_abbr}}@endif</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">{{ trans('messages.guitsetgegch') }}</label>
                            <select class="form-control" id="executor_id" name="executor_id">
                                <option value= "999">Тодорхойгүй</option>
                                <option value= "0">Бүгд</option>
                                @foreach($executor as $executors)
                                    @if($executors->is_ubtz==1)
                                    <option value= "{{$executors->executor_id}}"> @if($executors->executor_type == 2){{$executors->department_abbr}} - {{$executors->executor_abbr}}
                                        @else {{$executors->executor_abbr}}@endif</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>


                        <div class="form-group col-md-8">
                            <label for="inputAddress">{{ trans('messages.ajliinner') }}</label>
                            <textarea class="form-control" rows="1" id="project_name" name="project_name"></textarea>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputZip">{{ trans('messages.hariutsagch') }}</label>
                            <select class="form-control select2" id="respondent_emp_id" name="respondent_emp_id" @if(Auth::user()->user_grant == 6) disabled="true"@endif>
                                <option value= "999">Тодорхойгүй</option>
                            @foreach($employee as $employees)
                                <option value= "{{$employees->emp_id}}">{{$employees->firstname}} {{$employees->fletter}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputAddress">{{ trans('messages.ajliinner') }} /Русс/</label>
                            <textarea class="form-control" rows="1" id="project_name_ru" name="project_name_ru"></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputZip">{{ trans('messages.season') }}</label>
                            <select class="form-control select2" id="season" name="season">
                                @foreach($season as $rp)
                                    <option value= "{{$rp->season_id}}">{{$rp->season_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputAddress2">{{ trans('messages.tuluwluguu') }}</label>
                            <input type="text" class="form-control money" id="plan" name="plan" readonly >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{ trans('messages.tusuv') }}</label>
                            <input type="text" class="form-control money" id="estimation" name="estimation" maxlength="20">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputAddress2">{{ trans('messages.tuluwluguu1') }}</label>
                            <input type="text" class="form-control money plans" id="plan1" name="plan1" placeholder="" maxlength="20">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputAddress2">{{ trans('messages.tuluwluguu2') }}</label>
                            <input type="text" class="form-control money plans" id="plan2" name="plan2" placeholder="" maxlength="20">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputAddress2">{{ trans('messages.tuluwluguu3') }}</label>
                            <input type="text" class="form-control money plans" id="plan3" name="plan3" placeholder="" maxlength="20">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputAddress2">{{ trans('messages.tuluwluguu4') }}</label>
                            <input type="text" class="form-control money plans" id="plan4" name="plan4" placeholder="" maxlength="20">
                        </div>
                    </div>

                <div class="form-row" id="gereediv" style="display: none;">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Гэрээний дугаар</label>
                        <input type="text" class="form-control" id="gereenum" name="gereenum" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{ trans('messages.geree') }}</label>
                        <input type="text" class="form-control money" id="geree" name="geree" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAddress2">{{ trans('messages.ehelsen') }}</label>
                        <input class="form-control form-control-inline input-medium date-picker" name="prdate1" id="prdate1"
                               size="16" type="text" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{ trans('messages.duusah') }}</label>
                        <input class="form-control form-control-inline input-medium date-picker" name="prdate2" id="prdate2"
                               size="16" type="text" value="">
                    </div>
                </div>
                    <div class="form-row">



                        <div class="form-group col-md-6">
                            <label for="inputAddress2">{{ trans('messages.ehelsen') }}</label>
                            <input class="form-control form-control-inline input-medium date-picker" name="date1" id="date1"
                                   size="16" type="text" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{ trans('messages.duusah') }}</label>
                            <input class="form-control form-control-inline input-medium date-picker" name="date2" id="date2"
                                   size="16" type="text" value="">
                        </div>


                    </div>
                <div class="form-row">
                    <div class="form-group col-md-12 col-xs-12">
                        <label for="inputZip">{{ trans('messages.tailbar') }}</label>
                        <textarea class="form-control" rows="2" id="description" name="description" maxlength="500"></textarea>
                    </div>
                </div>

            </div>
                <div class="modal-footer">
                    <div class="col-md-5">

                        <button type="submit" class="btn btn-primary">{{ trans('messages.hadgalah') }}</button>
                    </div>
                    <div class="col-md-7" style="display: inline-block; text-align: right;" >
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.haah') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

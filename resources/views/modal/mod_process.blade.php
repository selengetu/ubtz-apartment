<div class="modal fade " id="processmodal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form2" method="post" action="addprocess" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title1">{{ trans('messages.tsonh') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" class="form-control" id="proc" name="proc" value="{{$sprojecttype}}">
                            <input type="hidden" class="form-control" id="gprocess_id" name="gprocess_id">
                            <input type="hidden" class="form-control" id="gproject_id" name="gproject_id">
                            <label for="inputEmail4">{{ trans('messages.sar') }}</label>
                            <select class="form-control" id="gmonth" name="gmonth">
                                @foreach($month as $months)
                                    <option value= "{{$months->id}}" >{{$months->month_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">{{ trans('messages.guitsetgel') }}</label>
                            <input type="text" class="form-control money" id="gbudget" name="gbudget" maxlength="20">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputZip">{{ trans('messages.ajliintuluv') }}</label>
                            <select class="form-control select2" id="gstate_id" name="gstate_id" >
                                @foreach($state as $states)
                                    <option value= "{{$states->state_id}}">{{$states->state_name_mn}}</option>
                                @endforeach
                            </select>
                        </div>
                    <!--   <div class="form-group col-md-3" id="gpercentdiv" style="display:none">
                            <label for="inputZip">{{ trans('messages.biylelt') }}</label>
                            <input type="text" class="form-control" id="gpercent" name="gpercent" placeholder="99.9" maxlength="4">
                        </div> -->
                        <div class="form-group col-md-6" id="gdatediv">
                            <label for="inputZip">{{ trans('messages.duusah') }}</label>
                            <input class="form-control form-control-inline input-medium date-picker" name="gdate" id="gdate" placeholder="2019-04-15">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputZip">{{ trans('messages.tailbar') }}</label>
                            <textarea class="form-control" rows="2" id="gdescription" name="gdescription" maxlength="500"></textarea>
                        </div>

                           

                    </div>


                </div>
                <div class="modal-footer">
                    <div class="col-md-5">
                        <button type="button" id="deleteproc" class="btn btn-danger delete">{{ trans('messages.ustgah') }}</button>
                        <button type="submit" class="btn btn-primary" id="addprocessbutton">{{ trans('messages.hadgalah') }}</button>
                    </div>
                    <div class="col-md-7" style="display: inline-block; text-align: right;" >
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.haah') }}</button>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

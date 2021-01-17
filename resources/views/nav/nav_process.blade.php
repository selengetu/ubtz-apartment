<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="card" style="margin-top: 20px">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title"> {{ trans('messages.ibiz') }}</h3>
                </div>

            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body text-center" >
            <div class="col-md-12">
                <div class="table-responsive" data-scrollable="true" data-height="400" >

                    <table class="table table-striped table-bordered" id="projecttable">
                        <thead>
                        <tr role="row">

                            <th>{{ trans('messages.hariutsagch') }}</th>
                            <th>{{ trans('messages.guitsetgegch') }}</th>
                            <th width="400px">{{ trans('messages.ajliinner') }}</th>
                            <th width="125px">{{ trans('messages.tuluwluguu') }}</th>
                            <th width="85px">{{ trans('messages.tusuv') }}</th>
                            <th width="85px">{{ trans('messages.guitsetgel') }}</th>
                            <th width="85px">{{ trans('messages.uunees') }}</th>
                            <th>{{ trans('messages.biylelt') }}</th>
                            <th>{{ trans('messages.hariutsagch') }}</th>
                            <th>{{ trans('messages.tuvehleh') }}</th>
                            <th>{{ trans('messages.tuvduusah') }}</th>
                            <th>{{ trans('messages.tailbar') }}</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <br>
                    <table class="table table-striped table-bordered" id="plantable">
                        <thead>
                        <tr role="row">

                            <th>Жилийн төлөвлөгөө</th>
                            <th>1-р улирал</th>
                            <th>2-р улирал</th>
                            <th>3-р улирал</th>
                            <th>4-р улирал</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <div class="card" style="margin-top: 20px;" >
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">{{ trans('messages.ajliinguits') }}</h3>
                </div>
                <div class="col-md-4">
         
                    <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#processmodal" id="addproc">
                        <i class="fa fa-plus" style="color: rgb(255, 255, 255);"> {{ trans('messages.guitsnemeh') }}</i>
                    </button>
                
                </div>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body text-center" >

            <div class="table-responsive" data-scrollable="true" data-height="400" >
                <table class="table table-striped table-bordered" id="processtable">
                    <thead>
                    <tr role="row">

                        <th>{{ trans('messages.tootsoh') }}</th>
                        <th>{{ trans('messages.guitsetgel') }}</th>
                        <th>{{ trans('messages.ajliintuluv') }}</th>
                        <th >{{ trans('messages.tailbar') }}</th>
                        <th>{{ trans('messages.ajliinguits') }}</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card-body -->
</div>
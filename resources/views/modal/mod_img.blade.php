<div id="imgModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">Хавсаргасан зураг
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button></div>
                            <form id="img_form" method="post" action="saveimg" enctype="multipart/form-data">
                                @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="custom-file">
                            <input type="file" id="1" class="custom-file-input" name="img_1" onchange="readURL(this, $(this).attr('id'));">
                            <label class="custom-file-label" for="customFile">1-р зураг</label>
                          </div>
                          <img id="imageResult_1" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
                    </div>
                    <div class="col-md-3">
                        <div class="custom-file">
                            <input type="file" id="2" class="custom-file-input" name="img_2" onchange="readURL(this, $(this).attr('id'));">
                            <label class="custom-file-label" for="customFile">2-р зураг</label>
                          </div>
                          <img id="imageResult_2" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
                    </div>
                    <div class="col-md-3">
                        <div class="custom-file">
                            <input type="file" id="3" class="custom-file-input" name="img_3" onchange="readURL(this, $(this).attr('id'));">
                            <label class="custom-file-label" for="customFile">3-р зураг</label>
                          </div>
                          <img id="imageResult_3" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
                    </div>
                    <div class="col-md-3">
                        <div class="custom-file">
                            <input type="file" id="4" class="custom-file-input" name="img_4" onchange="readURL(this, $(this).attr('id'));">
                            <label class="custom-file-label" for="customFile">4-р зураг</label>
                          </div>
                          <img id="imageResult_4" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.haah') }}</button>
                <button type="submit" class="btn btn-primary" id="addprocessbutton">{{ trans('messages.hadgalah') }}</button>
            </div>
        </form>
        </div>

    </div>
</div>

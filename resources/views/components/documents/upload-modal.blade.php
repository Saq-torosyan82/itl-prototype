<div id="upload-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">{{ $upload_btn_txt }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="error common-error"></div>

                        <form action="{{route('upload-document')}}" method="POST" class="dropzone" id="docUploadForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="doctype" value="{{ $doc_type }}">

                            <div class="fallback">
                                <input name="doc-file" type="file">
                            </div>
                            <div class="dz-message needsclick">
                                <i class="h1 text-muted dripicons-cloud-upload"></i>
                                <h4 class="mt-3">Drop files here or click to upload (.doc, .docx or .pdf).</h4>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div id="file-upload-status" class="dropzone-previews"></div>
                        <div class="error fileName-error"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label" for="doc-title">Title *</label>
                            <input id="doc-title" type="text" class="form-control" name="title-form"  placeholder="Document Title">
                            <div class="error title-error"></div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox checkbox-primary">
                                <input id="is-primary" type="checkbox">
                                <label for="is-primary" style="cursor:pointer">Primary</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button id="doc-save-button" type="button" class="btn btn-info waves-effect waves-light">Save</button>
            </div>
        </div>
    </div>
</div>

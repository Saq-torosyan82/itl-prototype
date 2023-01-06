<div id="resume-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title title-resume-modal">Upload Resume</h4>
            </div>
            <div class="modal-body ">
                <div class="upload-div">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <form action="{{route('upload-resume')}}" method="POST" class="dropzone" id="resumeUpload" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="title" id="hidden-title-input">
                                <input type="hidden" name="primary_resume" id="hidden-primary-input">
                                <input type="hidden" name="filetype" value="applicant-resume">
                                <input type="hidden" name="id_resume" id="id-resume" >
                                <input type="hidden" name="file_name_resume" id="file_name_resume" >
                                <div class="fallback">
                                    <input name="file" type="file">
                                </div>
                                <div class="dz-message needsclick">
                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    <h4 class="mt-3">Drop files here or click to upload.</h4>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="file-upload-status" class="dropzone-previews"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="title-form">Resume Name</label>
                                <input type="text" class="form-control"  name="title-form" id="title-form" placeholder="My Resume">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox checkbox-primary">
                            <input id="is-primary-resume" type="checkbox">
                            <label for="is-primary-resume">Primary</label>
                        </div>
                    </div>
                </div>

                <div class="message-div hide-important">
                    <p class="center">Upload Complete</p>
                </div>
                <div class="alert alert-danger d-none"> </div>

            </div>
            <div class="modal-footer resume-button-parent">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light" id="upload-resume-button" onclick="uploadResume()" disabled="disabled">Save</button>
            </div>
        </div>
    </div>
</div>

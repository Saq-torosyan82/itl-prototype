<div class="col-12">
    <div class="card-box card-error">
        <div class="flex-row justify-content-between">
            <h2 class="header-title clearfix">{{ $header_title }}
                <button id="upload-document-btn" type="button" class="btn btn-blue btn-sm ml-4 float-right">{{ $upload_btn_txt }}</button>
            </h2>
        </div>

        <div class="table-responsive">
            <table id="documents-list-tbl" class="table mb-0">
                <thead>
                    <tr>
                        <th>Date Added</th>
                        <th>Title</th>
                        <th>File</th>
                        <th>Primary</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@include('components.documents.upload-modal')
@include('components.documents.file-delete-dialog')

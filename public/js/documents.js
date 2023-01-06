let documents = {
    section: $("#documents-section"),
    form: $("#docUploadForm"),
    confirmDeleteModal: $('#docConfirmDeleteModal'),
    listTbl: $('#documents-list-tbl'),
    uploadModal: $('#upload-modal'),
    uploadBtn: $('#upload-document-btn'),
    saveBtn: $('#doc-save-button'),
    prefix: 'doc',
    docData: {
        originalFileName: '',
        fileName: '',
        title: '',
        isPrimary: 0,
        fileType: '',
    },
    mainUrl: '/document',
    itemId: null,
    dz: null,
    docs: [],
    currentDocType: '',

    init: function() {
        this.currentDocType = this.section.attr("data-type");

        this.getData();
        this.initDropzone();
        this.attachEvents();
    },

    validateData: function() {
        let self = this;
        let validated = true;
        let errors = {};

        if (self.docData.fileName === '') {
            validated = false;
            errors.fileName = "No file uploaded";
        }

        if (self.docData.title === '') {
            validated = false;
            errors.title = "Title can not be empty";
        }

        if (!validated) {
            this.showErros(errors)
        }

        return validated;
    },

    showErros: function(errors) {
        this.uploadModal.find(".error").empty();

        for (const key in errors) {
            this.uploadModal.find("." + key + "-error").html(errors[key]);
        }
    },

    attachEvents: function() {
        let self = this;

        this.uploadBtn.off('click').on('click', function(e) {
            self.reset();

            self.uploadModal.modal('show');
        });

        $("#remove-before-save").off('click').on('click', function(e) {
            self.confirmDeleteModal.modal('show');

            self.attachConfirmModalEvents();
        });

        this.saveBtn.off('click').on('click', function(e) {
            self.docData.isPrimary = $('#is-primary').is(':checked') ? 1 : 0;
            self.docData.title     = $.trim($("#" + self.prefix + "-title").val());
            self.docData.fileType  = self.currentDocType;

            if (self.validateData()) {
                self.save();
            }
        });
    },

    reset: function (){
        $('#doc-title').val('');
        $('#is-primary').prop('checked', false);
        $('#file-upload-status').empty();
        this.form.find('.dz-complete').remove();

        this.docData = {
            originalFileName: '',
            fileName: '',
            title: '',
            isPrimary: 0,
            fileType: '',
        };

        this.uploadModal.find(".error").empty();
    },

    setUploadModalData: function(data) {
        $('#doc-title').val(data.title);
        $('#is-primary').prop('checked', data.is_primary);

        let previewTemplate = '<div class="preview-file">' +
            '<p data-dz-errormessage class="text-red"></p>' +
            '<i class="fe-file font-22 mr-1"></i>' +
            '<span class="font-16 text-green">' + data.original_filename +'</a></span>' +
            '</div>';

        $('#file-upload-status').html(previewTemplate);

        this.docData = {
            originalFileName: data.original_filename,
            fileName: data.filename,
            title: data.title,
            isPrimary: data.is_primary,
            fileType: data.filetype,
        };
    },

    getData: function() {
        let self = this;

        $.ajax({
            url: self.mainUrl,
            type: 'get',
            data: makeAjaxData({doctype: self.currentDocType}),
            success: function(response) {
                self.docs = response.items;
                self.showListTable();
            },
        });
    },

    showListTable: function() {
        let self = this;

        if (self.docs.length > 0) {
            let rows = '';

            self.docs.forEach(function(item,index) {
                let date = formatDate(item.created_at);
                let isPrimary = item.is_primary == 0 ? "No" : "Yes";

                rows += '<tr>'+
                    '<td>' + date + '</td>'+
                    '<td>' + item.title + '</td>' +
                    '<td><a href="' + item.fileUrl + '" download>'+ item.original_filename +'</a></td>' +
                    '<td>' + isPrimary + '</td>' +
                    '<td style="width: 20px;">'+'<button title="Edit" type="button" class="btn btn-success btn-sm edit-btn" data-id="' + item.id + '"><i class="dripicons-document-edit" ></i></button>'+'</td>'+
                    '<td>'+'<button title="Delete" type="button" class="btn btn-danger btn-sm delete-btn" data-id="' + item.id + '"><i class="fe-trash-2 font-14"></i></button>' + '</td>' + '<tr>';
            });

            this.listTbl.find('tbody').html(rows);

            this.attachTableEvents();
        } else {
            this.listTbl.find('tbody').html('<tr><td colspan="4" class="no-data text-align-center">No data</td><tr>');
        }
    },

    attachTableEvents: function() {
        let self = this;

        this.listTbl.find('.delete-btn').off('click').on('click', function(e) {
            self.confirmDeleteModal.modal('show');
            self.attachConfirmModalEvents($(this).attr('data-id'));
        })

        this.listTbl.find('.edit-btn').off('click').on('click', function() {
            let id = $(this).attr('data-id');

            $.ajax({
                url: self.mainUrl + '/' + id,
                type: 'get',
                data: makeAjaxData(),
                success: function(response) {
                    if (response.result == 'success') {
                        self.itemId = id;
                        self.setUploadModalData(response.item);

                        self.uploadModal.modal('show');
                    }
                }
            });
        })
    },

    save: function() {
        let self = this;
        let url = self.mainUrl;
        let method = 'post'

        if (self.itemId) {
            url += '/' + self.itemId;
            method = 'put';
        }
        $.ajax({
            url: url,
            type: method,
            data: makeAjaxData(self.docData),
            success: function(response) {
                self.itemId = '';
                if (!response.error) {
                    self.reset();
                    self.uploadModal.modal('hide');
                    self.getData();
                } else {
                    self.showErros(response.message)
                }
            }
        });
    },

    attachConfirmModalEvents: function(id = null) {
        let self = this;
        let url = self.mainUrl;
        let params = makeAjaxData({fileName: self.docData.fileName})

        if (id) {
            url += '/' + id;
            params = makeAjaxData();
        }

        self.confirmDeleteModal.find('.btn-ok').off('click').on('click', function() {
            $.ajax({
                url: url,
                type: 'delete',
                data: params,
                success: function(response){
                    if (response.result == 'success') {
                            self.docData.fileName = '';
                        if (!id) {
                            $('#file-upload-status').empty();

                            self.dz.removeFile(self.dz.files[0]);
                        } else {
                            self.getData();
                        }

                        self.confirmDeleteModal.modal('hide');
                    }
                },
            });
        });

    },
    initDropzone: function() {
        let self = this;

        Dropzone.options.docUploadForm = {
            maxFilesize: 10,
            maxFiles: 1,
            acceptedFiles: "application/pdf, .doc, .docx",
            init: function(){
                self.dz = this;
                this.on("success", function (file, response) {
                    file.previewElement.innerHTML = "";
                    self.form.find('.dz-message').show();

                    if (response.result == 'success') {
                        let previewTemplate = '<div class="preview-file">' +
                            '<p data-dz-errormessage class="text-red"></p>' +
                            '<i class="fe-file font-22 mr-1"></i>' +
                            '<span class="font-16 text-green mr-1"><a href="' + response.fileUrl + '" download>'+ file.name +'</a></span>' +
                            '<button id="remove-before-save" class="btn btn-danger">Remove File</button>' +
                            '</div>';

                        self.docData.fileName = response.fileName;
                        self.docData.originalFileName = file.name;

                        $('#file-upload-status').html(previewTemplate);

                        self.attachEvents();
                    }
                });
                this.on("addedfile", function(){
                    if (this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }
                })
            }
        }
    },
}

documents.init();

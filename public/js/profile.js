let profilePage = {
    token: $('meta[name="csrf-token"]').attr('content'),

    init: function() {
        let self = this;

        self.attachEvents();
    },

    attachEvents: function() {
        let self = this;

        $('#customFile').change(self.uploadProfilePicture)
    },

    uploadProfilePicture: function () {
        let self = this;

        var id = $('input[name="id"]').val();
        let photo = $(self)[0].files[0];
        let formData = new FormData();
        formData.append('id', id);
        formData.append('photo', photo);
        let csrf = $('meta[name="csrf-token"]')[0].content;
        let url = $("#uploadPicture")[0].action;

        $.ajax({
            type: 'POST',
            url:url,
            data:formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": csrf
            },
            success:function(data) {
                url = data+"?r=" + Math.random();
                $('.rounded-circle').attr('src',url);
            },
            error: function (e) {
                window.e=e;
                message = e.responseJSON.errors.photo[0];
                $("#error_message").text(message);
                $("#error_action").modal("toggle");
            }
        })
    },
}

profilePage.init();


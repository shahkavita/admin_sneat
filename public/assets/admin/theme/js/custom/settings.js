$(document).ready(function () {
    $('form[id="general_setting_form"]').validate({
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: BASE_URL + '/admin/settings/save',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response?.status == true) {
                        location.reload();
                    }
                }
            });
        }
    });


    $('form[id="smtp_setting_form"]').validate({
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: BASE_URL + '/admin/settings/save',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response?.status == true) {
                        location.reload();
                    }
                }
            });
        }
    });

    $('form[id="theme_setting_form"]').validate({
        rules: {
            'settings[footer_color]': "required",
        },
        messages: {
            'settings[footer_color]': 'This field is required',
        },

        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: BASE_URL + '/admin/settings/save',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response?.status == true) {
                        location.reload();
                    }
                }
            });
        }
    });

    $('form[id="socialMedia_setting_form"]').validate({
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: BASE_URL + '/admin/settings/save',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response?.status == true) {
                        location.reload();
                    }
                }
            });
        }
    });
    

    $('form[id="additional_setting_form"]').validate({
        rules: {
            'settings[head_textarea]': "required",
        },
        messages: {
            'settings[head_textarea]': 'This field is required',
        },

        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: BASE_URL + '/admin/settings/save',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response?.status == true) {
                        location.reload();
                    }
                }
            });
        }
    });

    $(document).on("click", "#send_email_btn", function() {
        var email = $("#smtp_test_email").val();
        $.ajax({
            url: '/admin/settings/email',
            type: 'POST',
            data: {
                email: email
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status == true) {
                    alert('Check your email');
                    $("#smtp_test_email").val('');
                }
            }
        });
    });

})
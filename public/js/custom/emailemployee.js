$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    CKEDITOR.replace('message');

    $('#reset').click(function() {
        CKEDITOR.instances.message.setData('');
    });
    $("#emailsend").on('click', function(e) {
        e.preventDefault();
        var URL = "email/send";
        var data = document.getElementById('emailemployee');
        var FormDataPass = new FormData(data)
        FormDataPass.append('message', CKEDITOR.instances.message.getData());
        console.log("FormDataPass", FormDataPass);
        $.ajax({
            url: URL,
            method: 'POST',
            contentType: false, // Necessary for FormData
            processData: false,
            data: FormDataPass,
            success: function(response) {
                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                    backdrop: true
                });
                CKEDITOR.instances.message.setData('');
                $('#subject').val('');
                $("#emailemployee")[0].reset();
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                $('.text-danger').text('');
                if (errors) {
                    if (errors.subject) $('.error-subject').text(errors.subject[0]);
                    if (errors.message) $('.error-message').text(errors.message[0]);
                }
            }
        });
    });
});
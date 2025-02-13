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
    $("#attachement").on('change', function(e) {
        e.preventDefault();
        let file = this.files[0];
        let reader = new FileReader();
        if (file) {
            $('#preview').show();
            let fileType = file.type;
            var fileURL = URL.createObjectURL(file);
            console.log(file.name)
            if (fileType.includes('image')) {
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result).show();
                    $('#previewPDF').hide();
                };
            } else if (fileType.includes('pdf')) {
                reader.onload = function(e) {
                    $('#previewPDF').attr('src', e.target.result).show();
                    $('#previewImage').hide();
                };
            } else if (fileType.includes('word') || file.name.endsWith('docx') || file.name.endsWith('doc')) {
                let googleDocsViewerURL = `https://docs.google.com/gview?url=${encodeURIComponent(fileURL)}&embedded=true`;
                $('#previewPDF').attr('src', googleDocsViewerURL).show();
                $('#previewImage').hide();
            } else {
                $('#previewImage, #previewPDF').hide();
            }

            reader.readAsDataURL(file);
        }
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
                // $("#emailemployee")[0].reset();
                // $('#emailemployee').trigger('reset');
                CKEDITOR.instances.message.setData('');
                $('.text-danger').text('');
                $('#subject').val('');
                $('#preview').hide();
                $('#previewPDF').hide();
                $('#previewImage').hide();
                $('#attachment').val('');
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                $('.text-danger').text('');
                if (errors) {
                    if (errors.attachment) $('.error-attachment').text(errors.attachment[0]);
                    if (errors.subject) $('.error-subject').text(errors.subject[0]);
                    if (errors.message) $('.error-message').text(errors.message[0]);

                }
            }
        });
    });
});
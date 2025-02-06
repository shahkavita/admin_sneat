window.showLoader = function () {
    $('#loader-container').show();
};
window.hideLoader = function () {
    $('#loader-container').hide();
};

$(document).ready(function () {

    // Initialize CKEditor
    CKEDITOR.replace('message', {
        allowedContent: true,
    });

    allsubscriberlist();

    $(document).on("click", "#allsubscriber", function () {
        $("#emailsubscriber").modal('show');
    });


    $("#emailsubscriberform").validate({
        rules: {
            subject: "required",
            message: {
                required: true
            },
        },
        message: {
            subject: "This field is required",
            message: {
                required: "This field is required"
            }
        },
        submitHandler: function () {
            $('#loader-container').show();
            var formData = new FormData($("#emailsubscriberform")[0]);
            let message = CKEDITOR.instances.message.getData();
            const dataWithoutPTags = message.replace(/<p[^>]*>/g, '').replace(/<\/p>/g, '');
            // if (!message.trim()) {
            //     $('#validationMessage').text('This field is required');
            //     return false;
            // }
            formData.append("message", dataWithoutPTags);
            $.ajax({
                url: BASE_URL + '/admin/allsubscriber/sent',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success(data.message);

                        $("#emailsubscriber").modal('hide');
                        $('#loader-container').hide();

                    } else {
                        toastr.error(data.message);
                    }

                    $("#emailsubscriberform")[0].reset();
                    document.querySelector("#loader-container").style.display =
                        "none";
                }
            });
        }

    });

    $('#loader-container').hide();
    setTimeout(hideLoader, 3000);

    $("#emailsubscriber").on("hidden.bs.modal", function () {
        $('#emailsubscriberform').trigger("reset");
        $("#message").val("");
        CKEDITOR.instances.message.setData("");
        $('#validationMessage').text('');
        $("#emailsubscriberform").validate().resetForm();
        $("#emailsubscriberform").find('.error').removeClass('error');
        $('#message').siblings('.ck-editor').remove();

    });

    $(document).on("click", ".allsubscriber_delete", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/allsubscriber/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response?.status == 1) {
                            $('#allsubscriberTable').DataTable().ajax.reload();
                            toastr.success(response?.text);
                        } else {
                            toastr.error(response?.text);
                        }
                    }
                });

            }
        });


    });
});

function allsubscriberlist() {

    $("#allsubscriberTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/allsubscriber/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "subscriber_email",
            name: "subscriber_email"
        },
        {
            data: "status",
            name: "status"
        },
        {
            data: "action",
            name: "action",
            orderable: false
        },
        ]
    });

}
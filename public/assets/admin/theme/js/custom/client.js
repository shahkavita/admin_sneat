$("#imgHid").val("");
$("#clientform")[0].reset();
$("#hid").val("");

$("#img_privew").hide();
$("#priview_image_title").hide();
photo.onchange = evt => {
    const [file] = photo.files
    if (file) {
        $("#img_privew").show();
        $("#priview_image_title").show();
        img_privew.src = URL.createObjectURL(file)
    }
}

$(document).ready(function () {

    clientlisting();

    $(document).on("click", "#clientmodal", function () {
        $("#client").modal("show");
    });

    $.validator.addMethod("conditionalImgRequired", function (value, element) {
        var imgHidValue = $('#imgHid').val();
        if (!imgHidValue && !value.trim()) {
            return false;
        }
        return true;
    }, "This field is required");

    var validationRules = {
        name: "required",
        url: "required",
        photo: {
            conditionalImgRequired: true
        },
        status: "required"
    };

    var validationMessages = {
        name: "This field is required",
        url: "This field is required",
        photo: "This field is required",
        status: "This field is required"
    };

    $("#clientform").validate({
        rules: validationRules,
        message: validationMessages,
        submitHandler: function () {

            $('#loader-container').show();
            var formData = new FormData($("#clientform")[0]);
            $.ajax({
                url: BASE_URL + '/admin/client/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status == 0) {
                        toastr.success(data.message);
                        $('#loader-container').hide();
                        $("#client").modal("hide");
                    } else {
                        toastr.error(data.message);
                    }
                    $("#clientform")[0].reset();
                    $("#hid").val("");
                    $('#clientTable').DataTable().ajax.reload();
                }
            });
        }
    });


    $("#client").on("hidden.bs.modal", function () {
        $('#clientform').trigger("reset");
        $("#hid").val("");
        $("#imgHid").val("");
        $("#photo_img").html("");
        $("#img_privew").hide();
        $("#priview_image_title").hide();
        $("#clientform").validate().resetForm();
        $("#clientform").find('.error').removeClass('error');
    });

    $(document).on("click", ".client_edit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: '/admin/client/edit/' + id,
            data: {
                id: id
            },
            success: function (response) {
                if (response?.status == 1) {
                    if (response?.data) {
                        $("#client").modal("show");
                        $("#hid").val(response.data?.id);
                        $("#name").val(response.data?.name);
                        var photo = "<img src='{{ asset('uploads/') }}/" + response.data
                            ?.photo +
                            "' width='100px' height='100px'>";
                        $("#photo_img").html(photo);
                        $("#imgHid").val(response.data?.photo);
                        $("#url").val(response.data?.url);
                        $("#status").val(response.data?.status);
                    }
                }
            }
        });

    });

    $(document).on("click", ".client_delete", function () {
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
                    url: "/admin/client/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response?.status == 1) {
                            $('#clientTable').DataTable().ajax.reload();
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

function clientlisting() {

    $("#clientTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/client/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "photo",
            name: "photo",
            orderable: false
        },
        {
            data: "name",
            name: "name"
        },
        {
            data: "url",
            name: "url"
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
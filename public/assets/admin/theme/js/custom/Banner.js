$(document).ready(function () {
    $('#bannerForm').trigger("reset");
    $("#hid").val("");
    $("#imgHid").val("");
    $("#img").html("");
    $("#banner_img_privew").hide();
    $("#banner_priview_image_title").hide();
    banner_img.onchange = evt => {
        const [file] = banner_img.files
        if (file) {
            $("#banner_img_privew").show();
            $("#banner_priview_image_title").show();
            banner_img_privew.src = URL.createObjectURL(file)
        }
    }

    $(document).on("click", "#banner", function () {
        $("#banner_modal_title").html("Add Banner");
        $("#bannermodal").modal("show");
    });

    $("#bannermodal").on("hidden.bs.modal", function () {
        $('#bannerForm').trigger("reset");
        $("#hid").val("");
        $("#imgHid").val("");
        $('#banner_for').val('');
        $("#img").html("");
        $("#bannerForm").validate().resetForm();
        $("#bannerForm").find('.error').removeClass('error');
        $("#banner_img_privew").hide();
        $("#banner_priview_image_title").hide();
    });

    bannerlist();

    $.validator.addMethod("conditionalImgRequired", function (value, element) {
        var imgHidValue = $('#imgHid').val();
        if (!imgHidValue && !value.trim()) {
            return false;
        }
        return true;
    }, "This field is required");

    var validationRules = {
        banner_img: {
            conditionalImgRequired: true
        },
        banner_for: "required",
        status: "required",
    };

    var validationMessages = {
        banner_img: 'This field is required',
        banner_for: 'This field is required',
        status: 'This field is required'
    };

    $('#bannerForm').validate({
        rules: validationRules,
        messages: validationMessages,
        submitHandler: function () {
            var formData = new FormData($("#bannerForm")[0]);
            $('#loader-container').show();
            $.ajax({
                url: BASE_URL + '/admin/banner/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response?.status == 1) {
                        $('#loader-container').hide();
                        toastr.success(response.message);
                        $('#bannerTable').DataTable().ajax.reload();
                        $("#bannermodal").modal("hide");
                        $("#bannerForm").trigger("reset");
                        $("#hid").val("");
                        $("#bannerForm").validate().resetForm();
                        $("#bannerForm").find('.error').removeClass('error');
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    });

    $(document).on("click", ".banner_edit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/admin/banner/edit",
            data: {
                id: id
            },
            success: function (response) {
                if (response?.status == 1) {
                    if (response?.banner) {
                        $("#hid").val(response.banner.id);
                        if (response.banner.banner_img_edit != "") {
                            $("#img").html(response.banner.banner_img_edit);
                        }
                        $("#imgHid").val(response.banner.banner_img);
                        $("#status").val(response.banner.status);
                        if (response?.banner_category) {
                            $("#banner_for").html("");
                            var banner_for = response.banner_category;
                            var html = '<option selected disabled>Select Banner Category</option>';
                            for (let i = 0; i < banner_for.length; i++) {
                                if (banner_for[i].id == response.banner.banner_for) {
                                    html += "<option value='" + banner_for[i].id + "' selected>" + banner_for[i].page + "</option>"
                                } else {
                                    html += "<option value='" + banner_for[i].id + "'>" + banner_for[i].page + "</option>"
                                }
                            }
                            $("#banner_for").html(html);
                        }
                        $("#banner_modal_title").html("Edit Banner");
                        $("#bannermodal").modal("show");
                    }
                }
            }
        });
    });

    $(document).on("click", ".banner_delete", function () {
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
                    url: "/admin/banner/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response?.status == 1) {
                            toastr.success(response.text);
                            $('#bannerTable').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.text);
                        }
                    }
                });
            }
        });
    });
});

function bannerlist() {
    $("#bannerTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: "/admin/banner/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "banner_img",
            name: "Image",
            orderable: false
        },
        {
            data: "banner_for",
            name: "page"
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
$(document).ready(function () {
    $('#banner_categoryform').trigger("reset");
    $("#hid").val("");

    banner_categorylist();

    $(document).on("click", "#banner_category", function () {
        $("#banner_catmodal").modal("show");
        $("#banner_category_modal_title").html("Add Banner-Category")
    });

    $('#banner_categoryform').validate({
        rules: {
            page: "required",
            status: "required",
        },
        messages: {
            page: 'This field is required',
            status: 'This field is required',
        },
        submitHandler: function () {
            $('#loader-container').show();
            var formData = new FormData($("#banner_categoryform")[0]);
            $.ajax({
                url: BASE_URL + '/admin/banner_category/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response?.status == 1) {
                        toastr.success(response.message);
                        $('#loader-container').hide();
                        $("#banner_catmodal").modal("hide");
                        $("#banner_categoryform").trigger("reset");
                        $("#banner_categoryform").validate().resetForm();
                        $("#banner_categoryform").find('.error').removeClass('error');
                        $('#banner_catTable').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }

                }
            });
        },
    });

    $("#banner_catmodal").on("hidden.bs.modal", function () {
        $('#banner_categoryform').trigger("reset");
        $("#hid").val("");
        $("#banner_categoryform").validate().resetForm();
        $("#banner_categoryform").find('.error').removeClass('error');
    });

    $(document).on("click", ".banner_cat_edit", function () {
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/admin/banner_category/edit",
            data: {
                id: id
            },
            success: function (response) {
                if (response?.status == 1) {
                    if (response?.banner_category_data) {
                        var banner_category_data = response.banner_category_data;
                        console.log('banner_category_data:', banner_category_data)
                        $("#banner_category_modal_title").html("Edit Banner-Category")
                        $("#banner_catmodal").modal("show");
                        $("#hid").val(banner_category_data.id);
                        $("#page").val(banner_category_data.page);
                        $("#status").val(banner_category_data.status);
                    }
                } else {
                    toastr.error(response.msg);
                }
            }
        });
    });

    $(document).on("click", ".banner_cat_delete", function () {
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
                    type: "POST",
                    url: "/admin/banner_category/delete",
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response?.status == 1) {
                            $('#banner_catTable').DataTable().ajax.reload();
                            toastr.success(response.msg);
                        } else {
                            $('#banner_catTable').DataTable().ajax.reload();
                            toastr.error(response.msg);
                        }

                    }
                });
            }
        });
    });
});

function banner_categorylist() {

    $("#banner_catTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/banner_category/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "page",
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

$(document).ready(function () {

    // Initialize CKEditor
    CKEDITOR.replace('about_section', {
        allowedContent: true,
    });

    aboutlisting();

    $(document).on("click", "#about", function () {
        $("#aboutmodal").modal("show");
    });

    $('#aboutForm').validate({
        rules: {
            title: "required",
            about_section: "required",
            status: "required"
        },
        messages: {
            title: 'This field is required',
            about_section: 'This field is required',
            status: 'This field is required'
        },
        submitHandler: function () {
            $('#loader-container').show();
            let about_section = CKEDITOR.instances.about_section.getData();
            let formData = new FormData($("#aboutForm")[0]);
            formData.append('about_section', about_section);
            $.ajax({
                url: BASE_URL + '/admin/about/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data?.status == 1) {
                        $('#loader-container').hide();
                        toastr.success(data.message);
                        $("#aboutmodal").modal("hide");
                        $("#aboutForm")[0].reset();
                        $("#hid").val("");
                        $("#aboutForm").validate().resetForm();
                        CKEDITOR.instances.about_section.setData("");
                        $('#aboutTable').DataTable().ajax.reload();
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        },
    });

    $("#aboutmodal").on("hidden.bs.modal", function () {
        $('#aboutForm').trigger("reset");
        $("#hid").val("");
        CKEDITOR.instances.about_section.setData("");
        $("#aboutForm").validate().resetForm();
        $("#aboutForm").find('.error').removeClass('error');
    });

    $(document).on("click", ".about_edit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: BASE_URL + "/admin/about/edit",
            data: {
                id: id
            },
            success: function (response) {
                console.log('response:', response)
                if (response?.status == 1) {
                    if (response?.about_data) {
                        var about_data = response.about_data;
                        $("#aboutmodal").modal("show");
                        $("#hid").val(about_data.id);
                        $("#title").val(about_data.title);
                        CKEDITOR.instances.about_section.setData(about_data.about_section);
                        $("#status").val(about_data.status);
                    }
                }
            }
        });
    });

    $(document).on("click", ".about_delete", function () {
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
                    url: "/admin/about/delete",
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        console.log('response:', response)
                        if (response?.status == 1) {
                            $('#aboutTable').DataTable().ajax.reload();
                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg);
                        }
                    }
                });
            }
        });
    });
});

function aboutlisting() {

    $("#aboutTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/about/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "title",
            name: "title"
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
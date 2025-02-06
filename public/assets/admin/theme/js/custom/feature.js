$(document).ready(function () {

    featurelist();

    $('form[id="feature"]').validate({
        rules: {
            name: "required",
            content: "required",
            icon: "required",
            status: "required"
        },
        messages: {
            name: 'This field is required',
            content: 'This field is required',
            icon: 'This field is required',
            status: 'This field is required'
        },
        submitHandler: function () {
            $('#loader-container').show();
            var formData = new FormData($("#feature")[0]);

            $.ajax({
                url: BASE_URL + '/admin/feature/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == 0) {
                        toastr.success(data.message);
                        $('#loader-container').hide();
                        $('#addfeature').modal('hide');
                    } else {
                        Swal.fire({
                            title: data.message,
                            icon: "error"
                        });
                    }
                    $("#hid").val("");
                    $("#feature")[0].reset();
                    $('#table').DataTable().ajax.reload();
                }
            });

        }
    });

    function featurelist() {
        $("#table").DataTable({
            searching: true,
            paging: true,
            pageLength: 10,
            ajax: {
                type: "POST",
                url: BASE_URL + "/admin/feature/list",
                data: {
                    _token: $("[name='_token']").val(),
                },
            },
            columns: [{
                data: "id",
                name: "id"
            },
            {
                data: "name",
                name: "name"
            },
            {
                data: "content",
                name: "content"
            },
            {
                data: "icon",
                name: "icon"
            },
            {
                data: "status",
                name: "status"
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                sWidth: '20%'
            },
            ]
        });
    }

    $("#addfeature").on("hidden.bs.modal", function () {
        $('#feature').trigger("reset");
        $("#hid").val("");
        $("#feature").validate().resetForm();
        $("#feature").find('.error').removeClass('error');
    });

    $(document).on("click", "#feature_edit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/admin/feature/edit/" + id,
            data: {
                id: id
            },
            success: function (response) {
                $('#addfeature').modal('show');
                $("#hid").val(response.feature_data.id);
                $("#name").val(response.feature_data.name);
                $("#content").val(response.feature_data.content);
                $("#icon").val(response.feature_data.icon);
                $("#status").val(response.feature_data.status);
            }
        });
    });

    $(document).on("click", ".delete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to get this back!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/feature/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        var data = response;

                        if (data.status == 1) {
                            toastr.success(data.msg);
                            $('#table').DataTable().ajax.reload();
                        } else {
                            toastr.error(data.msg);
                        }

                    }
                });
            }
        });

    });

});

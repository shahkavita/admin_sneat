$(document).ready(function () {
    why_choose_us_list();

    $("#WhyChooseUs_modal").on("hidden.bs.modal", function () {
        $('#why_choose_usForm').trigger("reset");
        $("#hid").val("");
        $("#why_choose_usForm").validate().resetForm();
        $("#img_privew").html('');

    });

    $(document).on("click", "#add_whyChooseUs", function () {
        $("#WhyChooseUs_modal").modal('show');
    });

    $("#why_choose_usForm").validate({
        rules: {
            name: "required",
            content: "required",
            icon: "required",
        },
        messages: {
            name: "This field is required",
            content: "This field is required",
            icon: "This field is required",
        },
        submitHandler: function () {
            var formData = new FormData($("#why_choose_usForm")[0]);
            $.ajax({
                url: BASE_URL + '/admin/why_choose_us/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response.status == 0) {
                        $("#WhyChooseUs_modal").modal("hide");
                        toastr.success(response.message);
                        $("#why_choose_usForm")[0].reset();
                        $('#why_choose_usTable').DataTable().ajax.reload();
                        $("#hid").val("");
                    } else {
                        toastr.error(response.message);
                    }
                }
            })
        }
    });

    $(document).on("click", "#why_choose_usEdit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/admin/why_choose_us/edit/" + id,
            success: function (response) {
                console.log(response);
                if (response?.status == 1) {
                    if (response?.why_choose_us_data) {
                        $("#WhyChooseUs_modal").modal("show");
                        $("#hid").val(response?.why_choose_us_data?.id);
                        $('#name').val(response.why_choose_us_data.name);
                        $('#Content').val(response.why_choose_us_data.content);
                        $('#icon').val(response.why_choose_us_data.content);
                        $('#Content').val(response.why_choose_us_data.content);



                        var imagePath = "/uploads/" + response?.why_choose_us_data?.img;
                        var img_privew = "<img src='" + imagePath +
                            "' alt='Image' width='auto' height='150px'>";
                        $("#img_privew").html(img_privew);
                    }
                }
            }
        });
    });

    $(document).on("click", "#why_choose_usDelete", function () {
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
                    url: BASE_URL + "/admin/why_choose_us/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response?.status == 1) {
                            toastr.success(response?.text);
                            $('#why_choose_usTable').DataTable().ajax.reload();
                        } else {
                            toastr.error(response?.text);
                        }
                    }
                });

            }
        });
    });

});

function why_choose_us_list() {
    $("#why_choose_usTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/why_choose_us/list",
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
            data: "img",
            name: "img",
            orderable: false
        },

        {
            data: "action",
            name: "action",
            orderable: false
        },
        ],
    });
}
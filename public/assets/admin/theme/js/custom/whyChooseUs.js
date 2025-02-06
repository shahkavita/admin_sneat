$(document).ready(function () {
    $("#imgHid").val("");
    $("#why_choose_usForm")[0].reset();
    $("#hid").val("");

    $("#img_preview").hide();
    $("#preview_image_title").hide();
    img.onchange = evt => {
        const [file] = img.files
        if (file) {
            $("#img_preview").show();
            $("#preview_image_title").show();
            img_preview.src = URL.createObjectURL(file)
        }
    }

    $("#WhyChooseUs_modal").on("hidden.bs.modal", function () {
        $("#why_choose_usForm")[0].reset();
        $("#hid").val("");
        $("#why_choose_usForm").validate().resetForm();
        $("#why_choose_usForm").find('.error').removeClass('error');
        $("#edit_img").attr("src", "");
        $("#imgHid").val("");
        $("#img_preview").hide();
        $("#preview_image_title").hide();
    });

    $(document).on("click", "#add_whyChooseUs", function () {
        $("#WhyChooseUs_modal").modal('show');
        $("#modal_title").html("")
        $("#modal_title").html("Add  Why Choose Us")
        $("#edit_img_box").hide()
    })

    $.validator.addMethod("conditionalImgRequired", function (value, element) {
        var imgHidValue = $('#imgHid').val();
        if (!imgHidValue && !value.trim()) {
            return false;
        }
        return true;
    }, "This field is required");

    $('form[id="why_choose_usForm"]').validate({
        rules: {
            name: "required",
            content: "required",
            icon: "required",
            img: {
                'required': true
            }
        },
        message: {
            name: 'This field is required',
            content: 'This field is required',
            icon: 'This field is required',
            img: 'This field is required',
        },
        errorPlacement: function (error, element) {
            error.addClass('error-message');
            error.appendTo(element.parent());
        },
        submitHandler: function () {
            $('#loader-container').show();
            var formData = new FormData($("#why_choose_usForm")[0]);
            console.log("formData", formData);
            $.ajax({
                url: BASE_URL + '/admin/why-choose-us/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    var data = response;
                    if (data.status == 1) {
                        Swal.fire({
                            title: data.msg,
                            // text: data.msg,
                            icon: "success"
                        });
                        //   $('#contactRefresh').load(window.location.href + ' #contactRefresh');
                        $("#why_choose_usForm")[0].reset();
                        $("#why_choose_usForm").validate().resetForm();
                        $("#why_choose_usForm").find('.error').removeClass(
                            'error');
                        $('#loader-container').hide();
                        $('#WhyChooseUs_modal').modal('hide');
                        $('#table').DataTable().ajax.reload();
                        $("#edit_img").attr("src", "");

                    }
                }
            });
        },
    });

    let list = $('#table').dataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        "ajax": {
            url: BASE_URL + "/admin/why-choose-us/list",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
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
})


$(document).on('click', '#delete', function () {

    var deleteId = $(this).data("id");

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
                type: "post",
                url: BASE_URL + "/admin/why-choose-us/delete",
                data: {
                    _token: $("[name='_token']").val(),
                    id: deleteId,
                },
                success: function (response) {
                    var data = response;
                    if (data.status == 1) {
                        Swal.fire({
                            title: data.text,
                            text: data.msg,
                            icon: "success"
                        });
                        $('#table').DataTable().ajax.reload();

                    } else {
                        Swal.fire({
                            title: data.text,
                            text: data.msg,
                            icon: "error"
                        });
                    }

                },
            });

        } else if (result.isDenied) {
            Swal.fire({
                text: "Issue in submitting the data",
                icon: "error"
            });
        }
    });

});



$(document).on('click', '#edit', function () {

    var editId = $(this).data("id");

    $.ajax({
        type: "post",
        url: BASE_URL + "/admin/why-choose-us/edit",
        data: {
            _token: $("[name='_token']").val(),
            id: editId,
        },

        success: function (response) {
            var data = response;
            console.log("data", data);
            if (data.status == 1) {
                $("#modal_title").html("")
                $("#modal_title").html("Edit Why Choose Us")
                $('#hid').val(data.data.id);
                $('#name').val(data.data.name);
                $('#Content').val(data.data.content);
                $('#icon').val(data.data.icon);
                $("#edit_img_box").show();
                let photo = data.data.img;
                console.log("photo", photo);
                $("#edit_img").attr("src", imageUrl + '/' + photo);
                $("#imgHid").val(photo);
                $('#img').rules('remove', 'required');
                // $('#img').val(data.data.img);
                $('#WhyChooseUs_modal').modal('show');

            } else if (data.status == 0) {
                Swal.fire({
                    text: data.message,
                    icon: "error"
                });
            }
        },
    });
});
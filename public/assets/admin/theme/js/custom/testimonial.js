$("#testimonialForm")[0].reset();
$("#hid").val("");
$("#img").html("");
$("#imgHid").val("");
$("#testimonial_priview_image_title").hide();
$("#testimonial_img_privew").hide();
clientImg.onchange = evt => {
    const [file] = clientImg.files
    if (file) {
        $("#testimonial_img_privew").show();
        $("#banner_priview_image_title").show();
        testimonial_img_privew.src = URL.createObjectURL(file)
    }
}

// Custom validation method to check word count
$.validator.addMethod("wordCount", function (value, element, params) {
    var wordCount = value.trim().split(/\s+/).length;
    return wordCount >= params[0] && wordCount <= params[1];
}, jQuery.validator.format("Description must be between {0} and {1} words."));

$(document).ready(function () {
    testimonialList();

    $("#testimonialModal").on("hidden.bs.modal", function () {
        $("#testimonialForm")[0].reset();
        $("#hid").val("");
        $("#img").html("");
        $("#imgHid").val("");
        $("#testimonialForm").validate().resetForm();
        $("#testimonialForm").find('.error').removeClass('error');
        $("#testimonial_priview_image_title").hide();
        $("#testimonial_img_privew").hide();
    });

    $(document).on('click', '#addTestimonial', function () {
        $('#testimonialModal').modal('show');
        $("#testimonial_modal_hading").html("")
        $("#testimonial_modal_hading").html("Add Testimonial")
    });

    $.validator.addMethod("conditionalImgRequired", function (value, element) {
        var imgHidValue = $('#imgHid').val();
        if (!imgHidValue && !value.trim()) {
            return false;
        }
        return true;
    }, "This field is required");

    var validationRules = {
        clientname: "required",
        description: "required",
        reviewStars: "required",
    };

    var validationMessages = {
        clientname: 'This field is required',
        description: 'This field is required',
        reviewStars: 'This field is required',
    };

    $('#testimonialForm').validate({
        rules: validationRules,
        messages: validationMessages,
        submitHandler: function () {
            $('#loader-container').show();
            var formData = new FormData($("#testimonialForm")[0]);
            $.ajax({
                url: BASE_URL + '/admin/testimonial/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data?.status == 1) {
                        toastr.success(data.msg);

                        $('#loader-container').hide();
                        $('#testimonialModal').modal('hide');
                        $('#testimonialForm')[0].reset();
                        $('#hid').val('');
                        testimonialList();
                    } else {
                        toastr.error(response.msg);
                    }
                }
            });
        }
    });
})

$(document).on('click', '#testimonialEdit', function () {
    var editId = $(this).data("id");
    $.ajax({
        type: "GET",
        url: BASE_URL + "/admin/testimonial/edit",
        data: {
            _token: $("[name='_token']").val(),
            id: editId,
        },
        success: function (response) {
            var data = JSON.parse(response);
            if (data?.status == 1) {
                if (data?.data) {
                    var testiminial_data = data.data;
                    $("#testimonial_modal_hading").html("")
                    $("#testimonial_modal_hading").html("Edit Testimonial")
                    $('#hid').val(testiminial_data.id);
                    $('#projectname').val(testiminial_data.project_name);
                    $('#clientname').val(testiminial_data.client_name);
                    $('#clientoccupation').val(testiminial_data.client_occupation);
                    if (data.testimonial_img_edit != "") {
                        $("#img").html(data.testimonial_img_edit);
                    }
                    $('#imgHid').val(testiminial_data.client_img);
                    $('#description').val(testiminial_data.description);
                    $('#testimonialModal').modal('show');
                    $("#reviewStars").val(testiminial_data.stars);
                }
            } else if (data.status == 0) {
                toastr.error(data.msg);
            }
        },
    });
});

$(document).on('click', '#testimonialDelete', function () {
    var deleteId = $(this).data("id");

    Swal.fire({
        title: "Are You Sure You Want To Delete Testimonial Detaile?",
        showCancelButton: true,
        confirmButtonText: "Confirm",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "/admin/testimonial/delete/" + deleteId,
                data: {
                    _token: $("[name='_token']").val(),
                    id: deleteId,
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data?.status == 1) {
                        toastr.success(data.msg);
                        testimonialList();
                    } else {
                        toastr.error(data.msg);
                    }
                },
            });
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });
});

function testimonialList() {
    $("#testimonialTable").DataTable({
        processing: true,
        bDestroy: true,
        bAutoWidth: false,
        serverSide: true,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/testimonial/list",
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "project_name",
            name: "project_name"
        },
        {
            data: "client_name",
            name: "client_name"
        },
        {
            data: "client_occupation",
            name: "client_occupation"
        },
        {
            data: "image",
            name: "image",
            orderable: false
        },
        {
            data: "stars",
            name: "stars"
        },
        {
            data: "description",
            name: "description"
        },
        {
            data: "action",
            name: "action",
            orderable: false
        },
        ],
        columnDefs: [{
            targets: [],
            orderable: false,
        },],
    });
}
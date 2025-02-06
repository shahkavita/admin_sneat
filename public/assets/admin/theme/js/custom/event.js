$("#feature_img").html("");
$("#banner_img").html("");
$("#imgHid").val("");
$("#imgHid1").val("");
$("#eventform")[0].reset();
$("#hid").val("");

$("#img_privew").hide();
$("#priview_image_title").hide();
feature_photo.onchange = evt => {
    const [file] = feature_photo.files
    if (file) {
        $("#img_privew").show();
        $("#priview_image_title").show();
        img_privew.src = URL.createObjectURL(file)
    }
}

$("#img_privew1").hide();
$("#priview_image_title1").hide();
banner.onchange = evt => {
    const [file] = banner.files
    if (file) {
        $("#img_privew1").show();
        $("#priview_image_title1").show();
        img_privew1.src = URL.createObjectURL(file)
    }
}

$(document).ready(function () {

    // Initialize CKEditor
    CKEDITOR.replace('event_content', {
        allowedContent: true,
    });

    $.validator.addMethod("conditionalImgRequired", function (value, element) {
        var imgHidValue = $('#imgHid').val();
        if (!imgHidValue && !value.trim()) {
            return false;
        }
        return true;
    }, "This field is required");

    var validationRules = {
        event_title: "required",
        event_short_content: "required",
        event_content: "required",
        event_start_date: "required",
        event_end_date: {
            greaterThan: "#event_start_date",
            required: true
        },
        feature_photo: {
            conditionalImgRequired: true
        },
        banner: {
            conditionalImgRequired: true
        },
        event_location: "required",
        event_map: "required",
        meta_title: "required",
        meta_keywords: "required",
        meta_description: "required",
        status: "required"
    };

    var validationMessages = {
        event_title: "This field is required",
        event_short_content: "This field is required",
        event_content: "This field is required",
        event_start_date: "This field is required",
        event_end_date: "This field is required",
        event_location: "This field is required",
        event_map: "This field is required",
        feature_photo: "This field is required",
        banner: "This field is required",
        meta_title: "This field is required",
        meta_keywords: "This field is required",
        meta_description: "This field is required",
        status: "This field is required"
    };

    $("#eventform").validate({
        rules: validationRules,
        message: validationMessages,
        submitHandler: function () {

            $('#loader-container').show();
            var formData = new FormData($("#eventform")[0]);
            let event_content = CKEDITOR.instances.event_content.getData();
            const dataWithoutPTags = event_content.replace(/<p[^>]*>/g, '').replace(/<\/p>/g,
                '');
            formData.append("event_content", event_content);
            $.ajax({
                url: BASE_URL + '/admin/event/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status == 1) {
                        toastr.success(data.message);
                        $('#loader-container').hide();
                        $("#event").modal("hide");
                    } else {
                        toastr.error(data.message);
                    }

                    $("#eventform")[0].reset();
                    CKEDITOR.instances.event_content.setData("");
                    $("#hid").val();
                    $("#event_content").val("");
                    $('#eventTable').DataTable().ajax.reload();
                }
            });
        }
    });

    eventlisting();


    $(document).on("click", '#eventmodal', function () {
        $("#event").modal("show");
    });

    $("#eventform").submit(function () {

    });

    $("#event").on("hidden.bs.modal", function () {
        $('#eventform').trigger("reset");
        $("#event_content").val("");
        CKEDITOR.instances.event_content.setData("");
        $("#hid").val("");
        $("#imgHid").val("");
        $("#imgHid1").val("");
        $("#img_privew").hide();
        $("#priview_image_title").hide();
        $("#img").html("");
        $("#img1").html("");
        $("#feature_img").html("");
        $("#banner_img").html("");
        $("#img_privew1").hide();
        $("#priview_image_title1").hide();
        $('#validationMessage').text('');
        $("#eventform").validate().resetForm();
        $("#eventform").find('.error').removeClass('error');
        $('#event_content').siblings('.ck-editor').remove();

    });

    $(document).on("click", ".event_edit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/admin/event/edit/" + id,
            data: {
                id: id
            },
            success: function (response) {
                if (response?.status == 1) {
                    if (response?.data) {
                        $("#event").modal("show");
                        $("#hid").val(response?.data?.id);
                        $("#event_title").val(response?.data?.event_title);
                        $("#event_short_content").val(response?.data?.event_short_content);
                        CKEDITOR.instances.event_content.setData(response?.data?.event_content);
                        $("#event_start_date").val(response?.data?.event_start_date);
                        $("#event_end_date").val(response?.data?.event_end_date);
                        $("#event_location").val(response?.data?.event_location);
                        $("#event_map").val(response?.data?.event_map);

                        var feature_photo = "<img src='{{ asset('uploads/') }}/" + response?.data?.feature_photo + "' width='100px' height='100px'>";
                        $("#feature_img").html(feature_photo);
                        $("#imgHid").val(response?.data?.feature_photo)
                        var banner = "<img src='{{ asset('uploads/') }}/" + response?.data?.banner +
                            "' width='100px' height='100px'>";
                        $("#banner_img").html(banner);
                        $("#imgHid1").val(response?.data?.banner)

                        $("#meta_title").val(response?.data?.meta_title);
                        $("#meta_keywords").val(response?.data?.meta_keywords);
                        $("#meta_description").val(response?.data?.meta_description);
                        $("#status").val(response?.data?.status);
                    }
                }
            }
        });
    })

    $(document).on("click", ".event_delete", function () {
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
                    url: "/admin/event/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response?.status == 1) {
                            $('#eventTable').DataTable().ajax.reload();
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

function eventlisting() {

    $("#eventTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/event/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "event_title",
            name: "title"
        },
        {
            data: "feature_photo",
            name: "photo",
            orderable: false
        },
        {
            data: "banner",
            name: "banner",
            orderable: false
        },
        {
            data: "event_start_date",
            name: "start_date"
        },
        {
            data: "event_end_date",
            name: "end_date"
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
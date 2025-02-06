$(document).ready(function () {

    // Initialize CKEditor
    CKEDITOR.replace('description', {
        allowedContent: true,
    });
    
    $('#name').on('input', function () {
        var name = $(this).val();
        var slug = slugify(name);
        $('#url').val(slug);
    });

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    $("#service_img_privew").hide();
    $("#service_priview_image_title").hide();
    $('#serviceForm').trigger("reset");
    $("#hid").val("");
    $("#imgHid").val("");
    $("#img").html("");

    image.onchange = evt => {
        const [file] = image.files
        if (file) {
            $("#service_img_privew").show();
            $("#service_priview_image_title").show();
            service_img_privew.src = URL.createObjectURL(file)
        }
    }

    serviceList();

    $("#serviceModal").on("hidden.bs.modal", function () {
        $('#serviceForm').trigger("reset");
        $("#hid").val("");
        $("#serviceForm").validate().resetForm();
        $("#imgHid").val("");
        $("#img").html("");
        $("#serviceForm").find('.error').removeClass('error');
        $("#service_img_privew").hide();
        $("#service_priview_image_title").hide();
        CKEDITOR.instances.description.setData("");
    });

    $(document).on("click", "#service", function () {
        $("#serviceModal").modal("show");
    });

    // Custom validation method to check word count
    $.validator.addMethod("wordCount", function (value, element, params) {
        var wordCount = value.trim().split(/\s+/).length;
        return wordCount >= params[0] && wordCount <= params[1];
    }, jQuery.validator.format("Description must be between {0} and {1} words."));

    $.validator.addMethod("conditionalImgRequired", function (value, element) {
        var imgHidValue = $('#hid').val();
        if (!imgHidValue && !value.trim()) {
            return false;
        }
        return true;
    }, "This field is required");

    var validationRules = {
        name: "required",
        shortDescription: {
            required: true
        },
        description: "required",
        status: "required",
        image: {
            conditionalImgRequired: true
        }
    };

    var validationMessages = {
        name: 'This field is required',
        shortDescription: {
            required: "shortDescription is required",
            minlength: "shortDescription must be at least 5 words",
            maxlength: "shortDescription must be at most 15 words",
            customWordCountValidation: true
        },
        description: 'This field is required',
        image: 'This field is required',
        status: 'This field is required',
    };

    $('form[id="serviceForm"]').validate({
        rules: validationRules,
        messages: validationMessages,
        submitHandler: function () {
            $('#loader-container').show();
            var formData = new FormData($("#serviceForm")[0]);

            let description = CKEDITOR.instances.description.getData();

            const dataWithoutPTags = description.replace(/<p[^>]*>/g, '').replace(/<\/p>/g, '');

            formData.append("description", dataWithoutPTags);
            $.ajax({
                url: BASE_URL + '/admin/service/add',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    $('#loader-container').hide();
                    var data = JSON.parse(response);
                    if (data?.status == 1) {
                        $("#serviceForm")[0].reset();
                        $("#hid").val("");
                        $("#serviceForm").validate().resetForm();
                        $("#serviceForm").find('.error').removeClass('error');
                        toastr.success(data.msg);
                        CKEDITOR.instances.description.setData("");
                        $("#serviceModal").modal("hide");
                        $('#serviceTable').DataTable().ajax.reload();
                    } else {
                        toastr.error(data.msg);
                    }
                }
            });
        },
    });

    $(document).on("click", "#editService", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/admin/service/edit",
            data: {
                id: id
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data?.status == 1) {
                    if (data?.services_data) {
                        var services_data = data.services_data;
                        $("#serviceModal").modal("show");
                        $("#hid").val(services_data.id);
                        $("#name").val(services_data.name);
                        $("#url").val(services_data.slug);
                        $("#shortDescription").val(services_data.short_description);
                        CKEDITOR.instances.description.setData(services_data.description);
                        // $("#description").val(services_data.description);
                        if (services_data.services_data_img != "") {
                            $("#img").html(services_data.services_data_img);
                        }
                        $("#imgHid").val(services_data.services_data_img);
                        $("#status").val(services_data.status);
                        console.log('services_data:', services_data)
                    }
                } else {
                    toastr.error(data.msg);
                }
            }
        });
    });
});

function serviceList() {
    $("#serviceTable").DataTable({
        processing: true,
        bDestroy: true,
        bAutoWidth: false,
        serverSide: true,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/service",
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
            data: "name",
            name: "name"
        },
        {
            data: "image",
            name: "image"
        },
        {
            data: "status",
            name: "status"
        },
        {
            data: "action",
            name: "action"
        },
        ],
        columnDefs: [{
            targets: [],
            orderable: false,
        },],

    });
}

$(document).on("click", "#deleteService", function () {
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
                url: "/admin/service/delete",
                data: {
                    id: id,
                    _token: $("[name='_token']").val(),
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data?.status == 1) {
                        $('#serviceTable').DataTable().ajax.reload();
                        toastr.success(data.msg);
                    } else {
                        toastr.error(data.msg);
                    }
                }
            });
        }
    });
});
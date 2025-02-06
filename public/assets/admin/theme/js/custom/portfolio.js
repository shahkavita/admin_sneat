$(document).ready(function () {
    $('#categorySelect').select2();
    $("#imgHid").val("");
    $("#portfolioForm")[0].reset();
    $("#hid").val("");

    $("#img_preview").hide();
    $('#image').change(function() {
        const file = this.files[0];
        if (file) {
            // Create an object URL for the selected file
            const objectUrl = URL.createObjectURL(file);
            // Set the src attribute of the image element with the object URL
            $('#img_preview').attr('src', objectUrl).show();
        }
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

    portfolioList();

    $(document).on("click", "#portfolio", function () {
        $("#portfolioModal").modal("show");
    });

    // CKEDITOR.replace('content', {
    //     toolbar: 'Basic',
    //     width: '100%',
    //     height: 300,
    // },{versionCheck:false,});

    CKEDITOR.replace('content',{versionCheck:false,});


    $("#portfolioModal").on("hidden.bs.modal", function () {
        $('#portfolioForm').trigger("reset");
        CKEDITOR.instances.content.setData("");
        $('#categorySelect').val(null).trigger('change');
        $("#hid").val("");
        $("#portfolioForm").validate().resetForm();
        $("#imgHid").val("");
        $("#img").html("");
        $("#portfolioForm").find('.error').removeClass('error');
        $("#img_preview").hide();
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
        shortContent: "required",
        categorySelect: "required",
        image: {
            conditionalImgRequired: true
        }
    };

    var validationMessages = {
        name: 'This field is required',
        shortContent: 'This field is required',
        categorySelect: 'This field is required',
        image: 'This field is required',
    };

    $('form[id="portfolioForm"]').validate({
        rules: validationRules,
        messages: validationMessages,
        submitHandler: function () {
            $('#loader-container').show();
            var editor = CKEDITOR.instances.content;
            var contentValue = editor.getData();
            var formData = new FormData($("#portfolioForm")[0]);
            formData.append('content', contentValue);
            $.ajax({
                url: BASE_URL + '/admin/portfolio/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == 0) {
                        $("#portfolioForm")[0].reset();
                        editor.setData('');
                        $("#hid").val("");
                        $("#portfolioForm").validate().resetForm();
                        $("#portfolioForm").find('.error').removeClass('error');
                        toastr.success(data.message);
                        $('#loader-container').hide();
                        $("#portfolioModal").modal("hide");
                        $('#portfolioTable').DataTable().ajax.reload();
                    } else {
                        toastr.success(data.message);
                    }
                }
            });
        },
    });
});

function portfolioList() {
    $("#portfolioTable").DataTable({
        processing: true,
        bDestroy: true,
        bAutoWidth: false,
        serverSide: true,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/portfolio/list",
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
            name: "image",
            orderable: false,
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
            // searchable: true,
        },],
    });
}

$(document).on("click", '.editPortfolio', function () {
    let id = $(this).data("id");
    $.ajax({
        type: "GET",
        url: "/admin/portfolio/edit/" + id,
        success: function (response) {
            $("#portfolioModal").modal("show");
            $("#hid").val(response.data.id);
            $("#name").val(response.data.name);
            $("#shortContent").val(response.data.short_content);
            CKEDITOR.instances.content.setData(response.data.content);
            $("#clientname").val(response.data.client_name);
            $("#clientCompany").val(response.data.client_company);
            $("#startDate").val(response.data.start_date);
            $("#endDate").val(response.data.end_date);
            $("#website").val(response.data.website);
            $("#cost").val(response.data.cost);
            $("#clientComment").val(response.data.client_comment);
            $("#categorySelect").val(response.portfolio_category_ids);
            $("#categorySelect").trigger('change');
            $("#industrySelect").val(response?.data?.industry_id);
            var portfolio_photo = "<img src='{{ asset('uploads/') }}/" + response.data
                .image + "' width='100px' height='100px' style='width: 13%;'>";
            $("#img").html(portfolio_photo);

            $("#imgHid").val(response.data.image);
        }

    })
});

$(document).on('click', '.deletePortfolio', function () {

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
                type: "DELETE",
                url: BASE_URL + "/admin/portfolio/delete/" + deleteId,
                data: {
                    _token: $("[name='_token']").val(),
                },
                success: function (response) {
                    if (response?.status == 1) {
                        toastr.success(response?.text);
                        $('#portfolioTable').DataTable().ajax.reload();
                    } else {
                        
                        toastr.error(response?.text);
                    }
                },
            });
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });

});
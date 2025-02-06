$(document).ready(function () {

    // Initialize CKEditor
    CKEDITOR.replace('faq_content', {
        allowedContent: true,
    });

    faqlisting();

    $(document).on("click", "#faq", function () {
        $("#faqmodal").modal("show");
    });

    $("#faqform").validate({
        rules: {
            faq_title: "required",
            faq_content: "required",
            show_on_home: "required",
            status: "required"
        },
        message: {
            faq_title: "This field is required",
            faq_content: "This field is required",
            show_on_home: "This field is required",
            status: "This field is required"
        },
        submitHandler: function () {
            var formData = new FormData($("#faqform")[0]);
            $('#loader-container').show();
            let message = CKEDITOR.instances.faq_content.getData();
            formData.append("faq_content", message);
            $.ajax({
                url: BASE_URL + '/admin/faq/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status == 0) {
                        toastr.success(data.message);
                        $('#loader-container').hide();
                        $("#faqmodal").modal("hide");
                    } else {
                        toastr.error(data.message);
                    }
                    $("#faqform")[0].reset();
                    $("#hid").val("");
                    $('#faqTable').DataTable().ajax.reload();
                }
            });
        }
    });

    $("#faqform").submit(function () {

    });

    $("#faqmodal").on("hidden.bs.modal", function () {
        $('#faqform').trigger("reset");
        $("#hid").val("");
        $("#show_on_home").val("");
        CKEDITOR.instances.faq_content.setData("");
        $('#validationMessage').text('');
        $("#faqform").validate().resetForm();
        $("#faqform").find('.error').removeClass('error');
        $('#show_on_home').siblings('.ck-editor').remove();

    });

    $(document).on("click", ".faq_edit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/admin/faq/edit/" + id,
            data: {
                id: id
            },
            success: function (response) {
                if (response?.status == 1) {
                    if (response?.faqData) {
                        $("#faqmodal").modal("show");
                        $("#hid").val(response.faqData?.id);
                        $("#faq_title").val(response?.faqData?.faq_title);
                        CKEDITOR.instances.faq_content.setData(response?.faqData
                            ?.faq_content);
                        $("#show_on_home").val(response?.faqData?.show_on_home);
                        $("#status").val(response?.faqData?.status);
                    }
                }
            }
        });
    });

    $(document).on("click", ".faq_delete", function () {
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
                    url: "/admin/faq/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response?.status == 1) {
                            toastr.success(response?.text);
                            $('#faqTable').DataTable().ajax.reload();
                        } else {
                            toastr.error(response?.text);

                        }
                    }
                });

            }
        });


    });

});

function faqlisting() {

    $("#faqTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/faq/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "faq_title",
            name: "faq_title"
        },
        {
            data: "show_on_home",
            name: "show_on_home"
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
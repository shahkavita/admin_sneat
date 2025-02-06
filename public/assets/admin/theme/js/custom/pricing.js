$(document).ready(function () {

    // Initialize CKEditor
    CKEDITOR.replace('text', {
        allowedContent: true,
    });

    pricinglist();

    $("#pricing").validate({
        rules: {
            icon: "required",
            title: "required",
            price: "required",
            subtitle: "required",
            button_text: "required",
            button_url: "required",
            status: "required"
        },
        messages: {
            icon: "This field is required",
            title: "This field is required",
            price: "This field is required",
            subtitle: "This field is required",
            button_text: "This field is required",
            button_url: "This field is required",
            status: "This field is required"
        }
    });
    // To see the value of the instances od text

    // let editor = CKEDITOR.instances.text.getData();
    // console.log("outside",editor);
    $("#pricing").submit(function () {

        $('#loader-container').show();
        var formData = new FormData($("#pricing")[0]);
        let editor = CKEDITOR.instances.text.getData();


        formData.append("text", editor);

        $.ajax({
            url: BASE_URL + '/admin/pricing/save',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                console.log(data);
                if (data.status == 0) {
                    toastr.success(data.message);

                    $('#loader-container').hide();
                    $('#addpricing').modal('hide');
                } else {
                    toastr.error(data.message);
                }
                $("#hid").val("");
                $("#text").val("");
                CKEDITOR.instances.text.setData("");
                $("#pricing")[0].reset();
                $('#pricingTable').DataTable().ajax.reload();
            }
        });
    });

    $("#addpricing").on("hidden.bs.modal", function () {
        $('#pricing').trigger("reset");
        $("#hid").val("");
        $("#text").val("");
        CKEDITOR.instances.text.setData("");
        $('#validationMessage').text('');
        $("#pricing").validate().resetForm();
        $("#pricing").find('.error').removeClass('error');
        $('#text').siblings('.ck-editor').remove();

    });

    $(document).on("click", ".pricing_edit", function () {

        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "/admin/pricing/edit/" + id,
            data: {
                id: id,
                _token: $("[name='_token']").val(),
            },
            success: function (response) {
                if (response?.status == 1) {
                    if (response?.pricing) {
                        $('#addpricing').modal('show');
                        $('#hid').val(response?.pricing?.id);
                        $('#icon').val(response?.pricing?.icon);
                        $('#title').val(response?.pricing?.title);
                        $('#price').val(response?.pricing?.price);
                        $('#subtitle').val(response?.pricing?.subtitle);
                        CKEDITOR.instances.text.setData(response?.pricing?.text);
                        $("#button_text").val(response?.pricing?.button_text);
                        $("#button_url").val(response?.pricing?.button_url);
                        $("#status").val(response?.pricing?.status);
                    }
                }
            }
        });
    });

    $(document).on("click", ".pricing_delete", function () {
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
                    url: "/admin/pricing/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response.status == 1) {
                            toastr.success(response?.text);
                        } else {
                            toastr.error(response?.text);
                        }
                        $('#pricingTable').DataTable().ajax.reload();
                    }
                });
            }
        });
    });
});

function pricinglist() {

    $("#pricingTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/pricing/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "icon",
            name: "icon"
        },
        {
            data: "title",
            name: "title"
        },
        {
            data: "price",
            name: "price"
        },
        {
            data: "subtitle",
            name: "subtitle"
        },

        {
            data: "button_text",
            name: "button_text"
        },
        {
            data: "button_url",
            name: "button_url"
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

function open_pricing_pop_up() {
    $("#addpricing").modal("show");
}
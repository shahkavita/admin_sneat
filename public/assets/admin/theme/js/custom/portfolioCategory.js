$(document).ready(function () {
    $('#categoryname').on('input', function () {
        var categoryname = $(this).val();
        var slug = slugify(categoryname);
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

    portfolioCategoryList();

    $("#portfolioCategoryModal").on("hidden.bs.modal", function () {
        $("#portfolioCategoryForm")[0].reset();
        $("#hid").val("");
        $("#portfolioCategoryForm").validate().resetForm();
        $("#portfolioCategoryForm").find('.error').removeClass('error');
    });


    $('form[id="portfolioCategoryForm"]').validate({
        rules: {
            categoryname: "required",
            status: "required",
        },
        messages: {
            categoryname: 'This field is required',
            status: 'This field is required',
        },
        submitHandler: function (form) {
            $('#loader-container').show();
            var formData = new FormData(form);
            $.ajax({
                url: BASE_URL + '/admin/portfolio_category/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == 0) {
                        toastr.success(data.message);
                        
                        $('#loader-container').hide();
                        $("#portfolioCategoryForm")[0].reset();
                        $("#portfolioCategoryForm").validate().resetForm();
                        $("#portfolioCategoryForm").find('.error').removeClass(
                            'error');
                        $('#portfolioCategoryModal').modal('hide');
                        $('#portfolioCategoryTable').DataTable().ajax.reload();

                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        },
    });
})

$(document).on('click', '#addPortfolioCategory', function () {
    $('#portfolioCategoryModal').modal('show');
});

$(document).on('click', '#categoryEdit', function () {

    var editId = $(this).data("id");

    $.ajax({
        type: "GET",
        url: "/admin/portfolio_category/edit/" + editId,
        data: {
            _token: $("[name='_token']").val(),
            id: editId,
        },
        success: function (data) {
            if (data.status == 1) {
                $('#hid').val(data.data.id);
                $('#categoryname').val(data?.data?.name);
                $('#status option[value="' + data.data.status + '"]').prop('selected', true);
                $('#portfolioCategoryModal').modal('show');

            } else if (data.status == 1) {
                toastr.error(data.message);
            }
        },
    });
});

$(document).on('click', '#categoryDelete', function () {

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
                url: BASE_URL + "/admin/portfolio_category/delete/" + deleteId,
                data: {
                    _token: $("[name='_token']").val(),
                },
                success: function (response) {
                    if (response?.status == 1) {
                        toastr.success(response?.message);
                        $('#portfolioCategoryTable').DataTable().ajax.reload();
                    }else{
                        toastr.error(response?.message);
                    }
                },
            });

        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });

});


function portfolioCategoryList() {
    $("#portfolioCategoryTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/portfolio_category/list",
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
            // searchable: true,
        },],
    });
}
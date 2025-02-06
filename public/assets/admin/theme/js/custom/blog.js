$(document).ready(function () {

    // Initialize CKEditor
    CKEDITOR.replace('description', {
        allowedContent: true,
    });

    $('#title').on('input', function () {
        var title = $(this).val();
        var slug = slugify(title);
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

    bloglisting();

    $(document).on("click", "#blog", function () {
        $("#blogmodal").modal("show");
    });


    $("#blogForm").validate({
        rules: {
            title: "required",
            status: "required",

            url: {
                remote: {
                    url: BASE_URL + '/admin/blog/check-slug',
                    type: "POST",
                    data: {
                        slug: function () {
                            return $("#url").val();
                        },
                        id: function () {
                            return $("#hid").val();
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataFilter: function (data) {
                        var json = JSON.parse(data);
                        if (json.exists == true) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            },
            message: {
                required: true
            },
        },
        messages: {
            title: "This field is required",
            status: "This field is required",
            message: {
                required: "This field is required"
            },
            url: {
                remote: "Slug already exists"
            }
        },
        submitHandler: function () {
            var formData = new FormData($("#blogForm")[0]);
            let description = CKEDITOR.instances.description.getData();
            const dataWithoutPTags = description.replace(/<p[^>]*>/g, '').replace(/<\/p>/g, '');
            formData.append("description", dataWithoutPTags);

            $.ajax({
                url: BASE_URL + '/admin/blog/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if (response.status == 0) {
                        $("#blogmodal").modal("hide");
                        CKEDITOR.instances.description.setData("");
                        toastr.success(response.message);
                        $("#blogForm")[0].reset();
                        $("#hid").val("");
                        $('#blogTable').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                }
            })
        }
    });

    $("#blogmodal").on("hidden.bs.modal", function () {
        $('#blogForm').trigger("reset");
        $("#hid").val("");
        $("#title").val("");
        CKEDITOR.instances.description.setData("");
        $("#blogForm").validate().resetForm();
        $("#blog_img").html('');
    });


    $(document).on("click", "#blogEdit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "/admin/blog/edit/" + id,
            data: {
                id: id
            },
            success: function (response) {
                if (response?.status == 1) {
                    if (response?.blog_data) {
                        $("#blogmodal").modal("show");
                        $("#hid").val(response?.blog_data?.id);
                        $("#title").val(response?.blog_data?.title);
                        CKEDITOR.instances.description.setData(response?.blog_data
                            ?.description);
                        $("#url").val(response?.blog_data?.slug);
                        $("#status").val(response?.blog_data?.status);
                        $("#meta_title").val(response?.blog_data?.meta_title);
                        $("#meta_description").val(response?.blog_data
                            ?.meta_description);
                        $("#meta_keyword").val(response?.blog_data?.meta_keyword);
                        var imagePath = "/blog/" + response?.blog_data?.image;
                        var blog_photo = "<img src='" + imagePath + "' alt='Blog Image' width='auto' height='150px'>";
                        $("#blog_img").html(blog_photo);
                    }
                }
            }
        });
    });

    $(document).on("click", "#blogDelete", function () {
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
                    url: "/admin/blog/delete/" + id,
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        if (response?.status == 1) {
                            toastr.success(response.text);
                            $('#blogTable').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.text);
                        }
                    }
                });

            }
        });
    });


})

function bloglisting() {
    $("#blogTable").DataTable({
        searching: true,
        paging: true,
        pageLength: 10,
        ajax: {
            type: "POST",
            url: BASE_URL + "/admin/blog/list",
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "title",
            name: "title"
        },
        {
            data: "slug",
            name: "slug"
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
$(document).ready(function () {

    $("#imgHid").val("");
    $("#photogalleryForm")[0].reset();
    $("#hid").val("");

    $("#img_privew").hide();
    $("#priview_image_title").hide();
    photo.onchange = evt => {
        const [file] = photo.files
        if (file) {
            $("#img_privew").show();
            $("#priview_image_title").show();
            img_privew.src = URL.createObjectURL(file)
        }
    }

    photogalleryList()

    $(document).on('click', '#addPhoto', function () {
        $('#photogalleryModal').modal('show');
    });

    $("#photogalleryModal").on("hidden.bs.modal", function () {
        $("#photogalleryForm")[0].reset();
        $("#hid").val("");
        $("#imgHid").val("");
        $("#img").html("");
        $("#img_privew").hide();
        $("#priview_image_title").hide();
        $("#photogalleryForm").validate().resetForm();
    });

    $.validator.addMethod("conditionalImgRequired", function (value, element) {
        var imgHidValue = $('#imgHid').val();
        if (!imgHidValue && !value.trim()) {
            return false;
        }
        return true;
    }, "This field is required");


    $('form[id="photogalleryForm"]').validate({
        rules: {
            photo: {
                conditionalImgRequired: true
            }
        },
        messages: {
            photo: 'This field is required',
        },
        submitHandler: function () {
            var formData = new FormData($("#photogalleryForm")[0]);
            $('#loader-container').show();
            $.ajax({
                url: BASE_URL + '/admin/photo_gallery/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == 0) {
                        toastr.success(data.message);
                        $("#photogalleryForm")[0].reset();
                        $("#photogalleryForm").validate().resetForm();
                        $("#photogalleryForm").find('.error').removeClass(
                            'error');
                        $('#loader-container').hide();
                        $('#photogalleryModal').modal('hide');
                        $('#photoGalleryTable').DataTable().ajax.reload();
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        },
    });

    function photogalleryList() {
        $("#photoGalleryTable").DataTable({
            processing: true,
            bDestroy: true,
            bAutoWidth: false,
            serverSide: true,
            ajax: {
                type: "POST",
                url: BASE_URL + "/admin/photoGalleryTable/list",
                data: {
                    _token: $("[name='_token']").val(),
                },
            },
            columns: [{
                data: "id",
                name: "id"
            },
            {
                data: "photo",
                name: "photo",
                orderable: false
            },
            {
                data: "action",
                name: "action",
                orderable: false,
            }
            ],
            columnDefs: [{
                targets: [],
                orderable: false,
            },],
        });
    }

    $(document).on('click', '.edit', function () {
        var editId = $(this).data("id");

        $.ajax({
            type: "post",
            url: BASE_URL + "/admin/photoGallery/edit",
            data: {
                _token: $("[name='_token']").val(),
                id: editId
            },
            success: function (response) {
                var data = response;
                if (data.status == 1) {
                    var photo_gallery_data = data ?.photo_gallery_data;
                    let photo = photo_gallery_data.photo
                    $('#photogalleryModal').modal('show');
                    $('#hid').val(photo_gallery_data.id);
                    if (typeof imageUrl !== 'undefined') {
                        var image = "<img src='" + imageUrl + '/' + photo + "' width='100px' style='width:35%;' height='100px'>";
                    } else {
                        console.error('imageUrl is not defined');
                    }
                    $("#img").html(image);
                    $("#imgHid").val(photo_gallery_data.photo);
                }
            }
        });
    });


    $(document).on('click', '.delete', function () {

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
                    url: BASE_URL + "/admin/photoGallery/delete",
                    data: {
                        _token: $("[name='_token']").val(),
                        id: deleteId,
                    },
                    success: function (response) {
                        let data = response;
                        if (data.status == 1) {
                            toastr.success(data.text);
                            photogalleryList();
                        } else {
                            toastr.error(data.text);
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
})

$(document).ready(function () {
    $("#imgHid").val("");
    $("#teamForm")[0].reset();
    $("#hid").val("");
    $("#img_privew").hide();
    $("#priview_image_title").hide();
    $("#oldimgbox").hide();

    img.onchange = evt => {
        const [file] = img.files
        if (file) {
            $("#img_privew").show();
            $("#priview_image_title").show();
            img_privew.src = URL.createObjectURL(file)
        }
    }

    $("#teamModal").on("hidden.bs.modal", function () {
        $("#imgHid").val("");
        $("#teamForm")[0].reset();
        $("#hid").val("");
        $("#teamForm").validate().resetForm();
        $("#teamForm").find('.error').removeClass('error');
        $("#oldimgbox").hide();
        $("#img_privew").hide();
        $("#priview_image_title").hide();
    });

    var headers = $('meta[name="csrf-token"]').attr('content');

    let list = $('#teamTable').dataTable({
        searching: true,
        paging: true,
        pageLength: 10,

        "ajax": {
            url: BASE_URL + "/admin/teamlist",
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
            data: "role",
            name: "role"
        },
        {
            data: "image",
            name: "image",
            orderable: false
        },
        {
            data: "facebook",
            name: "facebook",
            orderable: false
        },
        {
            data: "twitter",
            name: "twitter",
            orderable: false
        },
        {
            data: "discord",
            name: "discord",
            orderable: false
        },
        {
            data: "skype",
            name: "skype",
            orderable: false
        },
        {
            data: "linkedin",
            name: "linkedin",
            orderable: false
        },
        {
            data: "instagram",
            name: "instagram",
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

$(document).on('click', '#addTeam', function () {
    $('#teamModal').modal('show');
    $("#modal_title").html("");
    $("#modal_title").html("Add Team");
    $("#img").attr("required", true);
    $("#modal_title").html("Add Team")
});

var roledata = $.ajax({
    url: "/admin/team/roledata",
    type: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
        var data = JSON.parse(response);
        if (data?.status == 1) {
            if (data?.team_role_data) {
                var team_role = data.team_role_data;
                if (team_role.length == 0) {
                    var roleoption = "<option selected disabled>Select Role</option>";
                    $("#role").html(roleoption);
                    $("#group").html("<a href='/admin/teamrole' class='btn btn-primary my-group-button' style='font-size: 20px;'>+</a>")

                } else {
                    var roleoption = "<option selected disabled>Select Role</option>";
                    for (let i = 0; i < team_role.length; i++) {
                        roleoption += '<option value="' + team_role[i].id + '">' + team_role[i]
                            .role_name + '</option>';
                    }
                    $("#role").html(roleoption);
                }
            }
        }
    }
});

var validationRules = {
    name: "required",
    role: "required",
};

var validationMessages = {
    name: 'This field is required',
    role: 'This field is required',
};

$('form[id="teamForm"]').validate({
    rules: validationRules,
    messages: validationMessages,
    submitHandler: function () {
        var formData = new FormData($("#teamForm")[0]);
        $('#loader-container').show();
        $.ajax({
            url: BASE_URL + '/admin/team/save',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data?.status == 1) {
                    toastr.success(data.message);

                    $('#loader-container').hide();
                    $('#teamModal').modal('hide');
                } else {
                    toastr.error(data.message);
                    $('#loader-container').hide();
                }
                $('#teamTable').DataTable().ajax.reload();
                $("#teamForm")[0].reset();
                $("#teamForm").validate().resetForm();
                $("#teamForm").find('.error').removeClass('error');
            }
        });
    },
});

$(document).on('click', '#teamEdit', function () {
    var editId = $(this).data("id");
    $.ajax({
        type: "GET",
        url: BASE_URL + "/admin/team/edit",
        data: {
            _token: $("[name='_token']").val(),
            id: editId,
        },
        success: function (response) {
            if (response?.status == 1) {
                if (response?.team_data) {
                    var team_data = response.team_data;
                    $("#modal_title").html("Edit Team")
                    $('#teamModal').modal('show');
                    $('#hid').val(team_data.id);
                    $('#name').val(team_data.name);
                    $('#role').val(team_data.role);
                    $('#skype').val(team_data.skype);
                    $('#twitter').val(team_data.twitter);
                    $('#facebook').val(team_data.facebook);
                    $('#discord').val(team_data.discord);
                    $('#instagram').val(team_data.instagram);
                    $('#linkedin').val(team_data.linkedin);
                    $("#imgHid").val(team_data.img);
                    $("#img").attr("required", false);
                    if (team_data.team_img != "") {
                        $("#oldimgbox").show();
                        $("#imgbox").html(team_data.team_img);
                    }
                }
            }
        },
    });
});

$(document).on('click', '#teamDelete', function () {
    var deleteId = $(this).data("id");

    Swal.fire({
        title: "Are You Sure , You Want to Delete This?",
        showCancelButton: true,
        confirmButtonText: "Confirm",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: BASE_URL + "/admin/team/delete",
                data: {
                    _token: $("[name='_token']").val(),
                    id: deleteId,
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data?.status == 1) {
                        toastr.success(data.message);
                        $('#teamTable').DataTable().ajax.reload();
                    } else {
                        toastr.error(data.message);
                    }
                },
            });
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });
});
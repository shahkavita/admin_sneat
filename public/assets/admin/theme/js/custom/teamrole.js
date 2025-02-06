$(document).ready(function () {
    $("#teamroleModal").on("hidden.bs.modal", function () {
        $("#teamRoleForm").trigger("reset");
        $("#hid").val("")
    })

    let list = $('#teamRoleTable').dataTable({
        searching: true,
        paging: true,
        pageLength: 10,

        "ajax": {
            url: "/admin/list",
            type: 'POST',
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
            },
        },
        columns: [{
            data: 'id'
        },
        {
            data: 'role_name'
        },
        {
            data: 'action',
            orderable: false
        },
        ],
    });

    $(document).on('click', '#addTeamrole', function () {
        $('#teamroleModal').modal('show');
        $("#teamRoleForm").trigger("reset");
        $("#team_role_modal_heading").html("")
        $("#teamRoleForm").validate().resetForm();
        $("#team_role_modal_heading").html("Add Team Role")
    });

    $('form[id="teamRoleForm"]').validate({
        rules: {
            name: "required",
        },
        messages: {
            name: 'This field is required',
        },
        submitHandler: function () {
            $('#loader-container').show();
            var formData = new FormData($("#teamRoleForm")[0]);
            $.ajax({
                url: "/admin/teamrole/save",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (responce) {
                    var data = JSON.parse(responce);
                    if (data?.status == 1) {
                        toastr.success(data.msg);

                        $('#loader-container').hide();
                        $('#teamroleModal').modal('hide');
                        $("#teamRoleForm").trigger("reset");
                        $('#teamRoleTable').DataTable().ajax.reload();
                        $("#hid").val("");
                    } else {
                        toastr.error(data.msg);
                    }
                }
            });
        }
    });

    $(document).on('click', '#teamroleEdit', function () {
        var editId = $(this).data("id");
        $.ajax({
            type: "GET",
            url: BASE_URL + "/admin/teamrole/edit",
            data: {
                _token: $("[name='_token']").val(),
                id: editId,
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data?.status == 1) {
                    $('#hid').val(data.data.id);
                    $('#name').val(data.data.role_name);
                    $('#teamroleModal').modal('show');
                    $("#team_role_modal_heading").html("")
                    $("#team_role_modal_heading").html("Edit Team Role")
                } else {
                    toastr.error(data.msg);
                }
            }
        });
    });

    $(document).on("click", ".teamroleDelete", function () {
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
                    url: "/admin/teamrole/delete",
                    data: {
                        id: id,
                        _token: $("[name='_token']").val(),
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        console.log('data:', data)
                        if (data?.status == 1) {
                            $('#teamRoleTable').DataTable().ajax.reload();
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                        }
                    }
                });
            }
        });
    });
})
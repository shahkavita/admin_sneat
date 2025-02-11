$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#employeeTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/employee/list', // This URL should return data in JSON format
            method: 'POST',
            data: {
                _token: $("[name='_token']").val(),
            },
            dataSrc: function(json) {
                console.log(json); // Check the structure of the returned JSON
                return json.data; // Ensure that 'data' is the correct property
            }
        },
        order: [
            [0, 'desc']
        ],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'gender', name: 'gender' },
            { data: 'department', name: 'department' },
            { data: 'skills', name: 'skills' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
        ]
    });

    $('#exampleModal').on('hidden.bs.modal', function() {
        $('#employeeform')[0].reset(); // Reset the form when modal is closed
        $('#employeeform').find('input[type="hidden"]').val(''); // Clear hidden inputs
        $('#exampleModalLabel').text('Add Employee');
        $('#empsave').val('Submit')
    });
    $('#empsave').on('click', function(e) {
        const id = $('#hid').val();
        const url = 'employee';
        console.log(id);
        let formname = document.getElementById('employeeform');
        let FormDataPass = new FormData(formname);
        console.log("FormDataPass", FormDataPass);
        $.ajax({
            url: url,
            method: 'POST',
            contentType: false, // Necessary for FormData
            processData: false,
            data: FormDataPass,
            success: function(response) {

                $('#employeeform')[0].reset();
                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                    backdrop: true
                });
                $('#employeeTable').DataTable().ajax.reload();
                $('#exampleModal').modal('hide');
                $('#hid').val("");
                $('#exampleModalLabel').text('Add Employee');
                $('#empsave').val('Submit');

            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                $('.text-danger').text('');
                if (errors) {
                    if (errors.name) $('.error-name').text(errors.name[0]);
                    if (errors.email) $('.error-email').text(errors.email[0]);
                    if (errors.gender) $('.error-gender').text(errors.gender[0]);
                    if (errors.department) $('.error-department').text(errors.department[0]);
                    if (errors.skills) $('.error-skills').text(errors.skills[0]);
                    if (errors.status) $('.error-status').text(errors.status[0]);
                }
            }
        });
    });
});

function editemployee(id) {
    console.log(id);
    $('.text-danger').text('');
    $.ajax({
        url: 'employee/' + id,
        method: 'GET',
        success: function(response) {
            $('#exampleModal').modal('show');
            $('#employeeform')[0].reset();
            $('#exampleModalLabel').text('Update Employee');
            $('#hid').val(response.id);
            $("#ename").val(response.name);
            $("#email").val(response.email);
            $(`input[name="gender"][value="${response.gender}"]`).prop('checked', true);
            $("#edepartment").val(response.department);
            $(`input[name="status"][value="${response.status}"]`).prop('checked', true);

            const skills = response.skills.split(',')
            $('input[type="checkbox"]').each(function() {
                if (skills.includes($(this).val())) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
            $('#empsave').val('Update');
        }
    })
}

function deleteemployee(id) {
    console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'employee/' + id,
                method: 'DELETE',
                success: function(response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        backdrop: true
                    });
                    $('#employeeTable').DataTable().ajax.reload();
                }
            });
        }
    });
}

function viewemployee(id) {
    console.log(id);
    $.ajax({
        url: 'employee/' + id,
        type: 'GET',
        success: function(response) {
            $("#staticBackdrop").modal('show');
            $("#employeeCode").text(response.id);
            $("#employeeName").text(response.name);
            $("#employeeEmail").text(response.email);
            $("#employeeGender").text(response.gender);
            $("#employeeDepartment").text(response.department);
            if (response.status == 1) {
                $("#employeeStatus").text("Active");
            } else {
                $("#employeeStatus").text('Inactive');
            }
            $("#employeeSkills").text(response.skills);
        }
    })
}
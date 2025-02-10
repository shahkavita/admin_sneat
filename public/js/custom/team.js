$(document).ready(function(e) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#image').change(function(event) {
        let reader = new FileReader();
        reader.onload = function(e) {
            oldImageUrl = $("#imagePreview").attr("src");
            $('#imagePreview').attr('src', e.target.result).show();
            $("#cancel-image").show();
        }
        reader.readAsDataURL(this.files[0]);
    });
    $("#cancel-image").click(function() {
        $("#imagePreview").attr("src", oldImageUrl);
        $("#image").val(""); // Clear file input
        $(this).hide(); // Hide cancel button
    });
    $('#teamTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/team/list', // This URL should return data in JSON format
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
            { data: 'role', name: 'role' },
            { data: 'image', name: 'image' },
            { data: 'facebook', name: 'facebook' },
            { data: 'twitter', name: 'twitter' },
            { data: 'skype', name: 'skype' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action' },
        ]
    });
    $('#exampleModal').on('hidden.bs.modal', function() {

        $('#imagePreview').hide().attr('src', '');
        $('#image').val('');
        $('#teamform')[0].reset(); // Reset the form when modal is closed
        $('#teamform').find('input[type="hidden"]').val(''); // Clear hidden inputs
        $('#exampleModalLabel').text('Add Team');
        $('.text-danger').text('');
        $("#cancel-image").hide();
        $('#teamsave').val('Submit')
    });
    $('#teamsave').on('click', function(e) {
        const id = $('#hid').val();
        $('.text-danger').text('');
        const url = 'team/add';
        console.log(id);
        let formname = document.getElementById('teamform');
        let FormDataPass = new FormData(formname);

        FormDataPass.append('_token', $('meta[name="csrf-token"]').attr('content'));

        console.log("FormDataPass", FormDataPass);
        $.ajax({
            url: url,
            method: 'POST',
            contentType: false, // Necessary for FormData
            processData: false,
            data: FormDataPass,
            success: function(response) {

                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                    backdrop: true
                });

                $('#exampleModal').modal('hide');
                $('#teamform')[0].reset();
                $('#teamTable').DataTable().ajax.reload();
                $('#exampleModalLabel').text('Add Category');
                $('#teamsave').val('Submit');
                $('#hid').val("");
                $('.text-danger').text('');
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                $('.text-danger').text('');
                if (errors) {
                    if (errors.name) $('.error-name').text(errors.name[0]);
                    if (errors.role) $('.error-role').text(errors.role[0]);
                    if (errors.image) $('.error-image').text(errors.image[0]);
                    if (errors.facebook) $('.error-facebook').text(errors.facebook[0]);
                    if (errors.twitter) $('.error-twitter').text(errors.twitter[0]);
                    if (errors.skype) $('.error-skype').text(errors.skype[0]);
                }
            }
        });
    });
});

function editteam(id) {
    // initializeCKEditor();
    console.log(id);
    $('.text-danger').text('');
    $.ajax({
        url: 'team/edit/' + id,
        method: 'GET',
        success: function(response) {
            // initializeCKEditor();
            $('#exampleModal').modal('show');
            $('#teamform')[0].reset();
            $('#exampleModalLabel').text('Update Team');
            $('#hid').val(response.id);
            $("#name").val(response.name);
            $("#skype").val(response.skype);
            $("#twitter").val(response.twitter);
            $("#facebook").val(response.facebook);
            $("#role").val(response.role);
            // $("#cancel-image").show();
            if (response.image) {
                $('#imagePreview').attr('src', '/storage/' + response.image).show();
            }
            $("#oldimage").val(response.image)

            $('#teamsave').val('Update');
        }
    })
}

function deleteteam(id) {
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
                url: 'team/' + id,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
                },
                success: function(response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        backdrop: true
                    });
                    $('#teamTable').DataTable().ajax.reload();
                }
            });
        }
    });
}
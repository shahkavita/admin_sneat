$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#categoryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/product/category/list', // This URL should return data in JSON format
            method: 'POST',
            data: {
                _token: $("[name='_token']").val(),
            },
            dataSrc: function(json) {
                console.log(json); // Check the structure of the returned JSON
                return json.data; // Ensure that 'data' is the correct property
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
        ]
    });
    $('#exampleModal').on('hidden.bs.modal', function() {
        $('#productform')[0].reset(); // Reset the form when modal is closed
        $('#productform').find('input[type="hidden"]').val(''); // Clear hidden inputs
        $('#exampleModalLabel').text('Add Category');
        $('#categorysave').val('Submit')
        $('.text-danger').text('');
    });

    $('#categorysave').on('click', function(e) {
        const id = $('#hid').val();
        $('.text-danger').text('');
        const url = 'category';
        console.log(id);
        let formname = document.getElementById('productform');
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
                $('#productform')[0].reset();
                $('#categoryTable').DataTable().ajax.reload();
                $('#exampleModalLabel').text('Add Category');
                $('#categorysave').val('Submit');
                $('#hid').val("");
                $('.text-danger').text('');
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                $('.text-danger').text('');
                if (errors) {
                    if (errors.name) $('.error-name').text(errors.name[0]);
                    if (errors.status) $('.error-status').text(errors.status[0]);
                }
                //$('.text-danger').text('');
            }
        });
    });
});

function editcategory(id) {
    console.log(id);
    $('.text-danger').text('');
    $.ajax({
        url: 'category/' + id,
        method: 'GET',
        success: function(response) {
            $('#exampleModal').modal('show');
            $('#productform')[0].reset();
            $('#exampleModalLabel').text('Update Category');
            $('#hid').val(response.id);
            $("#name").val(response.name);
            $("#status").val(response.status);
            $('#categorysave').val('Update');
        }
    })
}

function deletecategory(id) {
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
                url: 'category/' + id,
                method: 'DELETE',
                success: function(response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        backdrop: true
                    });
                    $('#categoryTable').DataTable().ajax.reload();
                }

            });
        }
    });
}
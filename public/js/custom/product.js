let editorInstance;

function initializeCKEditor() {
    if (editorInstance) {
        editorInstance.destroy().then(() => {
            createCKEditor();
        });
    } else {
        createCKEditor();
    }
}

function createCKEditor() {
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            editorInstance = editor;
            editor.editing.view.change(writer => {
                writer.setStyle('min-height', '120px', editor.editing.view.document.getRoot());
                writer.setStyle('max-height', '200px', editor.editing.view.document.getRoot());
            });
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });
}

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    initializeCKEditor();

    $('#image').change(function(event) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(this.files[0]);
    });


    // Reinitialize CKEditor when modal opens


    $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/product/list', // This URL should return data in JSON format
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
            { data: 'p_id', name: 'p_id' },
            { data: 'p_name', name: 'p_name' },
            { data: 'description', name: 'description' },
            { data: 'image', name: 'image' },
            { data: 'p_price', name: 'p_price' },
            { data: 'p_status', name: 'p_status' },
            { data: 'category_name', name: 'category_name' },
            { data: 'action', name: 'action' },
        ]
    });
    $('#exampleModal').on('hidden.bs.modal', function() {
        initializeCKEditor();
        $('#imagePreview').hide().attr('src', '');
        $('#image').val('');
        $('#productform')[0].reset(); // Reset the form when modal is closed
        $('#productform').find('input[type="hidden"]').val(''); // Clear hidden inputs
        $('#exampleModalLabel').text('Add Category');
        $('#categorysave').val('Submit')
    });

    $('#productsave').on('click', function(e) {
        const id = $('#hid').val();
        $('.text-danger').text('');
        const url = 'product/addproduct';
        console.log(id);
        let formname = document.getElementById('productform');
        let FormDataPass = new FormData(formname);
        if (editorInstance) {
            FormDataPass.append('description', editorInstance.getData());
        }

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
                $('#productTable').DataTable().ajax.reload();
                $('#exampleModalLabel').text('Add Category');
                $('#productsave').val('Submit');
                $('#hid').val("");
                $('.text-danger').text('');
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                $('.text-danger').text('');
                if (errors) {
                    if (errors.name) $('.error-name').text(errors.name[0]);
                    if (errors.description) $('.error-description').text(errors.description[0]);
                    if (errors.price) $('.error-price').text(errors.price[0]);
                    if (errors.image) $('.error-image').text(errors.image[0]);
                    if (errors.category) $('.error-category').text(errors.category[0]);
                    if (errors.status) $('.error-status').text(errors.status[0]);
                }
                //$('.text-danger').text('');
            }
        });
    });

});

function editproduct(id) {
    // initializeCKEditor();
    console.log(id);
    $('.text-danger').text('');
    $.ajax({
        url: 'product/editproduct/' + id,
        method: 'GET',
        success: function(response) {
            // initializeCKEditor();
            $('#exampleModal').modal('show');
            $('#productform')[0].reset();
            $('#exampleModalLabel').text('Update Category');
            $('#hid').val(response.p_id);
            $("#name").val(response.p_name);
            $("#price").val(response.p_price);
            $("#category").val(response.category_id);
            $(`input[name="status"][value="${response.p_status}"]`).prop('checked', true);

            if (response.p_image) {
                $('#imagePreview').attr('src', '/storage/' + response.p_image).show();
            }
            $('#productsave').val('Update');
            /*if (CKEDITOR.instances['description']) {
                CKEDITOR.instances['description'].setData(response.p_des);
            } else {
                // Initialize CKEditor if not already initialized
                CKEDITOR.replace('description');
                CKEDITOR.instances['description'].setData(response.p_des);
            }*/

        }
    })
}

function deleteproduct(id) {
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
                url: 'products/' + id,
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
                    $('#productTable').DataTable().ajax.reload();
                }
            });
        }
    });
}
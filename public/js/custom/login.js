$(document).ready(function() {
    // Set up AJAX for CSRF token automatically
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Sign-up AJAX Request
    $("#signup").on("click", function(e) {
        e.preventDefault(); // Prevent form submission

        var form = document.getElementById('register');
        var formdata = new FormData(form);

        // Add CSRF token to FormData manually (optional since it's in the AJAX setup)
        formdata.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: "/register",
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Register response: ", response);

                if (response.success) {
                    $('#register')[0].reset(); // Reset the form fields
                    Swal.fire({
                        title: 'Registered Successfully!',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000 // Message will show for 1 second
                    }).then(() => {
                        // Redirect after 1 second
                        window.location.href = response.redirect_url;
                    });
                } else {
                    alert("Registration failed. Please try again.");
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Validation error
                    const errors = xhr.responseJSON.errors;
                    if (errors.name) {
                        $('#name-error').text(errors.name[0]);
                    }
                    if (errors.email) {
                        $('#email-error').text(errors.email[0]);
                    }
                    if (errors.password) {
                        $('#password-error').text(errors.password[0]);
                    }
                } else {
                    alert('Something went wrong. Please try again.');
                }
            }
        });
    });

    // Login AJAX Request
    $("#login").on("click", function(e) {
        e.preventDefault(); // Prevent form submission

        var form = document.getElementById('loginform');
        var formdata = new FormData(form);

        // Add CSRF token to FormData manually (optional since it's in the AJAX setup)
        formdata.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: "/login",
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Login response: ", response);

                if (response.success) {
                    Swal.fire({
                        title: 'Login Successful!',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000 // Message will show for 3 seconds
                    }).then(() => {
                        // Redirect after 3 seconds
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    });
                } else {
                    alert("Invalid login credentials. Please try again.");
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;

                // Display errors inside the span tags

                if (errors.email) {
                    $('#email-error').text(errors.email[0]);
                }
                if (errors.password) {
                    $('#password-error').text(errors.password[0]);
                }
            }
        });
    });
    $("#updatepassword").on("click", function(e) {
        e.preventDefault(); // Prevent form submission

        var form = document.getElementById('resetpassword');
        var formdata = new FormData(form);

        // Add CSRF token to FormData manually (optional since it's in the AJAX setup)
        formdata.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: "/updatepassword",
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("update response: ", response);
                if (response.status) {
                    Swal.fire({
                        title: 'Password Updated Successful!',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000 // Message will show for 3 seconds
                    }).then(() => {
                        // Redirect after 3 seconds
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    });
                } else {
                    alert("Please try again.");
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                // alert(errors)
                // Display errors inside the span tags
                if (errors.password) {
                    $('#password-error').text(errors.password[0]);
                }
                if (errors.password_confirmation) {
                    $('#password_confirmation-error').text(errors.password_confirmation[0]);
                }
            }
        });
    });
    $("#forgot").on("click", function(e) {
        e.preventDefault(); // Prevent form submission

        var form = document.getElementById('Authentication');
        var formdata = new FormData(form);

        // Add CSRF token to FormData manually (optional since it's in the AJAX setup)
        formdata.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: "/forgotpassword",
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Login response: ", response);
                if (response.status) {
                    // $('#Authentication')[0].reset(); // Reset the form fields
                    Swal.fire({
                        title: 'Forgot Password !',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 4000 // Message will show for 1 second
                    });
                } else {
                    Swal.fire({
                        title: 'Forgot Password !',
                        text: response.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 4000 // Message will show for 1 second
                    });
                }
            },
            error: function(xhr, status, error) {
                // General error handling for login request

                let errors = xhr.responseJSON.errors;
                if (errors && errors.email) {
                    errorMessage = errors.email[0];
                    Swal.fire({
                        title: 'Forgot Password Error',
                        text: errorMessage,
                        icon: 'error',
                        showConfirmButton: true,
                        timer: 3000 // Message will show for 3 seconds
                    });
                    $('#Authentication')[0].reset();
                }

            }
        });
    });
});
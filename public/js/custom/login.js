$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const routes = {
        register: "{{ route('auth.register') }}",
        login: "{{ route('login.user') }}",
        logout: "{{ route('auth.logout') }}"
    };
    $("#signup").on("click",function(e){
        var form=document.getElementById('register')
        var formdata=new FormData(form)
       
        console.log(formdata)
        $.ajax({
            url: "/register/save",
            type: 'POST',
            data:formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#register')[0].reset(); 
                    Swal.fire({
                      title: 'Registerd Successful!',
                      text: response.message,
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 1000 // Message will show for 4 seconds
                  }).then(() => {
                      // Redirect to index page after 4 seconds
                      window.location.href ='/login';// Change this to your desired page URL
                  });
                }   
                },
                error: function (xhr) {
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
    $("#login").on("click",function(e){
        var form=document.getElementById('loginform');
        var formdata=new FormData(form);
        console.log(formdata)
        console.log('test');
        $.ajax({
            url:"/login/check",
            type: 'POST',
            data:formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                    if (response.success) {
                      Swal.fire({
                        title: 'Login Successful!',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000 // Message will show for 4 seconds
                    }).then(() => {
                        // Redirect to index page after 4 seconds
                        //http://127.0.0.1:8000/admin
                        window.location.href ='/admin'// Change this to your desired page URL
                    });                    
            }
        }
        });
    });
});
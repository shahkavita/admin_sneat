$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.form-link[data-form="general"]').parent().addClass('active'); // Add active class to the menu item
    $('#general').show();

    $(".form-link").click(function(e) {
        e.preventDefault();
        $('.list-group-item').removeClass('active');
        // Add 'active' class to the clicked menu item
        $(this).parent().addClass('active');
        // Show the corresponding form content
        var formId = $(this).data('form');
        $("#form-container").html($("#" + formId).html()); // Show the form content by ID

        /*$(".list-group-item").removeClass("active");
        var formId = $(this).data("form"); // Get the form ID
        console.log(formId);
        $(this).parent().addClass("active");
        $("#form-container").html($("#" + formId).html());*/

        $('#logo').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                oldImageUrl = $("#previewlogo").attr("src");
                $('#previewlogo').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('#favicon').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                oldImageUrl = $("#previewfavicon").attr("src");
                $('#previewfavicon').attr('src', e.target.result).show();
                //$("#cancel-image").show();
            }
            reader.readAsDataURL(this.files[0]);
        });
        loadsettings();

        function loadsettings() {
            $.get("/admin/settings/fetchsettings", function(response) {

                $("#companyname").val(response.settings[0].value);
                $("#city").val(response.settings[1].value);
                $("#state").val(response.settings[2].value);
                $("#country").val(response.settings[3].value);
                $("#zipcode").val(response.settings[4].value);
                $("#phonenumber").val(response.settings[5].value);
                $("#email").val(response.settings[6].value);
                $("#project").val(response.settings[7].value);
                $("#globalcustomer").val(response.settings[8].value);
                $("#experience").val(response.settings[9].value);
                $("#client").val(response.settings[10].value);
                $("#previewlogo").attr('src', "/storage/" + response.settings[11].value).show();
                $("#previewfavicon").attr('src', "/storage/" + response.settings[12].value).show();
                loadCountries(response.country, response.settings[3].value);

            });
        }

        function loadCountries(country, selectedCountry) {
            let countryDropdown = $('#country');
            countryDropdown.empty();
            countryDropdown.append('<option value="">Select Country</option>');

            $.each(country, function(index, country) {
                let selected = selectedCountry == country.id ? 'selected' : '';
                countryDropdown.append(`<option value="${country.id}" ${selected}>${country.name}</option>`);
            });
        }

        $("#general").on('click', function(e) {
            e.preventDefault();

            let formname = document.getElementById('generalsetting');
            let FormDataPass = new FormData(formname);
            FormDataPass.append('_token', $('meta[name="csrf-token"]').attr('content'));
            let url = 'general/updatesettings';
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
                },
                error: function(xhr, status, error) {
                    // Debugging: Check error in console
                    if (xhr.status === 422) { // Laravel validation error
                        let errors = xhr.responseJSON.errors;
                        console.log(errors);
                        $.each(errors, function(key, messages) {
                            // Convert the key to match class name (e.g., settings.companyname -> settings-companyname)
                            let fieldName = key.split('.').pop();
                            console.log("filedname" + fieldName);
                            // Find the error container for this field (e.g., error-settings-companyname)
                            let errorContainer = $("." + "error-" + fieldName);
                            console.log("container" + errorContainer);
                            // Clear any previous errors
                            errorContainer.html('');
                            $.each(messages, function(index, message) {
                                // Loop through the messages and append them
                                // Display each error message inside the error container
                                errorContainer.append('<p>' + message + '</p>'); // Each message in a <p> tag
                            });
                        });

                    } else {
                        alert("An unexpected error occurred: " + xhr.responseText);
                    }
                }
            });
        });

        loadsmtp();
        $("#smtp").on('click', function(e) {
            e.preventDefault();
            let formname = document.getElementById('smtpform');
            let FormDataPass1 = new FormData(formname);
            FormDataPass1.append('_token', $('meta[name="csrf-token"]').attr('content'));
            let url = '/admin/settings/smtp/updatesmtp';
            console.log(url);
            console.log("FormDataPass", FormDataPass1);
            // alert('ajax called');
            $.ajax({
                url: url,
                method: 'POST',
                contentType: false, // Necessary for FormData
                processData: false,
                data: FormDataPass1,
                success: function(response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        backdrop: true
                    });
                },
                error: function(xhr, status, error) {
                    // Debugging: Check error in console
                    const errors = xhr.responseJSON.errors;
                    if (errors) { // Laravel validation error 
                        console.log(errors);
                        if (errors.mailengine) $('.error-mailengine').text(errors.mailengine[0]);
                        if (errors.emailprotocol) $('.error-emailprotocol').text(errors.emailprotocol[0]);
                        if (errors.encryption) $('.error-encryption').text(errors.encryption[0]);
                        if (errors.host) $('.error-host').text(errors.host[0]);
                        if (errors.port) $('.error-port').text(errors.port[0]);
                        if (errors.email) $('.error-emails').text(errors.email[0]);
                        if (errors.username) $('.error-username').text(errors.username[0]);
                        if (errors.password) $('.error-password').text(errors.password[0]);
                        if (errors.charset) $('.error-charset').text(errors.charset[0]);

                    } else {
                        alert("An unexpected error occurred: " + xhr.responseText);
                    }
                }
            });
        });

        function loadsmtp() {
            $.get("/admin/settings/smtpsettings", function(data) {
                $(`input[name="mailengine"][value="${data[0].value}"]`).prop('checked', true);
                $(`input[name="emailprotocol"][value="${data[1].value}"]`).prop('checked', true);
                $("#encryption").val(data[2].value);
                $("#host").val(data[3].value);
                $("#port").val(data[4].value);
                $("#email").val(data[5].value);
                $("#username").val(data[6].value);
                $("#password").val(data[7].value);
                $("#charset").val(data[8].value);
            });
        }
        $("#sendemail").on('click', function(e) {
            e.preventDefault();
            console.log('send mail button');
            let formname = document.getElementById('testmail');
            let FormDataPass = new FormData(formname);
            FormDataPass.append('_token', $('meta[name="csrf-token"]').attr('content'));
            let url = '/admin/settings/smtp/test';
            alert(url)
            $.ajax({
                URL: url,
                method: 'POST',
                contentType: false,
                processData: false,
                data: FormDataPass,
                success: function(response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        backdrop: true
                    });
                    $("#testemail").val('');
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON;
                    console.log(errors);
                    Swal.fire({
                        title: "Error!",
                        text: xhr.message,
                        icon: "error",
                        backdrop: true
                    });
                }

            });
        });
    });
});
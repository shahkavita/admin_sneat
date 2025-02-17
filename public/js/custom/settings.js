$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".form-link").click(function(e) {
        e.preventDefault();
        $(".list-group-item").removeClass("active");
        var formId = $(this).data("form"); // Get the form ID
        console.log(formId);
        $(this).parent().addClass("active");
        $("#form-container").html($("#" + formId).html());

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
            $.get("/admin/settings/fetchsettings", function(data) {
                $("#companyname").val(data[0].value);
                $("#city").val(data[1].value);
                $("#state").val(data[2].value);
                $("#country").val(data[3].value);
                $("#zipcode").val(data[4].value);
                $("#phonenumber").val(data[5].value);
                $("#email").val(data[6].value);
                $("#project").val(data[7].value);
                $("#globalcustomer").val(data[8].value);
                $("#experience").val(data[9].value);
                $("#client").val(data[10].value);
                $("#previewlogo").attr('src', "/storage/" + data[11].value).show();
                $("#previewfavicon").attr('src', "/storage/" + data[12].value).show();
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
                        console.log(errors)
                        $.each(errors, function(key, messages) {
                            let fieldName = key.split('.').pop() // Convert 'settings.name' -> 'settings-name'
                            console.log(fieldName)
                            console.log(key)
                            $("." + "error-" + fieldName).text(messages[0]); // Show first error message
                            // Show first error
                        });
                    } else {
                        alert("An unexpected error occurred: " + xhr.responseText);
                    }
                }
            });
        });
    });
});
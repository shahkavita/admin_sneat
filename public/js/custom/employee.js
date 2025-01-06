function loaddata()
   {
    $.ajax({
      url: 'employee/index',
      method: 'GET',
      success: function (data) {
          const tableBody = $('#employeeTable');
          tableBody.empty(); // Clear existing rows

          // Loop through the employees and append rows\
          if (data.length === 0) {
            tableBody.append(`
                <tr>
                    <td colspan="7" style="text-align: center;">No data available</td>
                </tr>
            `);
        }
         else
         {
            data.forEach(employee => {
                const row = `
                    <tr>
                        <td>${employee.id}</td>
                        <td>${employee.name}</td>
                        <td>${employee.email}</td>
                        <td>${employee.gender}</td>
                        <td>${employee.department}</td>
                        <td>${employee.skills.split(',').join('<br>')}</td> 
                       <td>
                          <button class="btn btn-primary btn-sm" 
                              onclick='viewemployee(${employee.id })' id="view" name="view">
                              <i class="fa fa-eye" aria-hidden="true"></i></button>
  
                              <button class="btn btn-info btn-sm" 
                              onclick='editemployee(${employee.id })'id="empedit" name="empedit">
                              <i class="fa fa-pencil" aria-hidden="true"></i></button>
                            
                              <button class="btn btn-danger btn-sm" 
                              onclick='deleteemployee(${employee.id })' id="empdel" name="empdel">
                              <i class="fa fa-trash" aria-hidden="true"></i></button>
                       </td>     
                    </tr>
                `;
                tableBody.append(row);
            
            });
         }          
      },
  });
}
$(document).ready(function(){
    loaddata();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#empsave').on('click',function (e)
    {
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
                success: function (response) {
                    loaddata();
                    $('#employeeform')[0].reset();
                    Swal.fire({
                    title: "Success!",
                    text:response.message,
                    icon: "success",
                    backdrop: true
                  });
                $('#exampleModal').modal('hide'); 
                $('#hid').val("");
                $('#exampleModalLabel').text('Add Employee');
                $('#empsave').val('Submit'); 

       },
       error: function (xhr) {
        const errors = xhr.responseJSON.errors;
        $('.text-danger').text('');
        if (errors) {
            if (errors.name) $('.error-name').text(errors.name[0]);
            if (errors.email) $('.error-email').text(errors.email[0]);
            if (errors.gender) $('.error-gender').text(errors.gender[0]);
            if (errors.department) $('.error-department').text(errors.department[0]);
            if (errors.skills) $('.error-skills').text(errors.skills[0]);
        }
    }
       });
    });
});
function editemployee(id)
{
    console.log(id);
    $('.text-danger').text('');
    $.ajax({
        url:'employee/'+id,
        method:'GET',
        success:function(response)
        {
            $('#exampleModal').modal('show');
            $('#employeeform')[0].reset();
            $('#exampleModalLabel').text('Update Employee');
            $('#hid').val(response.id);
            $("#ename").val(response.name);
            $("#email").val(response.email);
            $(`input[name="gender"][value="${response.gender}"]`).prop('checked',true);
            $("#edepartment").val(response.department);
        
            const skills=response.skills.split(',')
            $('input[type="checkbox"]').each(function () {
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
function deleteemployee(id)
{
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
            url:'employee/'+id,
            method:'DELETE',
            success:function(response)
            {
                loaddata();
                Swal.fire({
                    title: "Success!",
                    text:response.message,
                    icon: "success",
                    backdrop: true
                  });  
            }
           });
        }
    });
}
function viewemployee(id)
{
    console.log(id);
    $.ajax({
        url:'employee/'+id,
        type:'GET',
        success:function(response)
        {
            $("#staticBackdrop").modal('show');
            $("#employeeCode").text(response.id);
            $("#employeeName").text(response.name);
            $("#employeeEmail").text(response.email);
            $("#employeeGender").text(response.gender);
            $("#employeeDepartment").text(response.department);
            $("#employeeSkills").text(response.skills);
        }
    })
}
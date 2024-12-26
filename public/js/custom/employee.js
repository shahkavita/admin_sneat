$(document).ready(function() {  
  loaddata();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $(document).on('click', '#empform', function () {  
       $('#empsave').on('click',function (e) {
            e.preventDefault();
            let formname=document.getElementById('employeeform');
            let f1=new FormData(formname);
            console.log(f1);
           $.ajax({
                url:'employee',
                method:'POST',
                contentType: false, // Necessary for FormData
                processData: false,
                data:f1,
                success: function (response) {

                alert("Record Inserted Successfully!!")
                loaddata();
                    $('#exampleModal').modal('hide');
                    $('#employeeform')[0].reset();
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
   });
  function loaddata()
   {
    $.ajax({
      url: 'employee/index',
      method: 'GET',
      success: function (data) {
          const tableBody = $('#employeeTable');
          tableBody.empty(); // Clear existing rows

          // Loop through the employees and append rows
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
                            data-id='${employee.id }' id="empedit" name="empedit">
                            <i class="fa fa-pencil" aria-hidden="true"></i></button>
                            <button class="btn btn-danger btn-sm" 
                            data-id='${employee.id }' id="empdel" name="empdel">
                            <i class="fa fa-trash" aria-hidden="true"></i></button>


                     </td>     
                  </tr>
              `;
              tableBody.append(row);
          });
      },
      error: function (error) {
          console.error('Error fetching employee data:', error);
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
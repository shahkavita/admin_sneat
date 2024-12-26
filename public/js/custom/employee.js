$(document).ready(function() {  
  loaddata();
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
        url:'employee/index/'+id,
        type:'GET',
        success:function(response)
        {
            $("#staticBackdrop").modal('show');
            $("#employeeName").text(response.name);
            $("#employeeEmail").text(response.email);
            $("#employeeGender").text(response.gender);
            $("#employeeDepartment").text(response.department);
            $("#employeeSkills").text(response.skills);
        }
    })
}
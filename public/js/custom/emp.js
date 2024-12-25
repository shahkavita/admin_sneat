$(document).ready(function() {  
  //alert('script running');
  loaddata();
   });
  function loaddata()
   {
    $.ajax({
      url: 'admin/employee',
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
                      <td>${employee.department}</td>
                      <td>${employee.skills}</td>          
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
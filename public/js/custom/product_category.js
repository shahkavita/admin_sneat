$(document).ready(function() {  
    loaddata();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
   // $(document).on('click', '#empform', function () {  
         $('#categorysave').on('click',function (e)
          {
                  const id = $('#hid').val();
                  $('.text-danger').text('');
                  const url = 'category';
                  console.log(id);
                  let formname = document.getElementById('productform');
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
                      Swal.fire({
                          title: "Success!",
                          text:response.message,
                          icon: "success",
                          backdrop: true
                        });
                      $('#exampleModal').modal('hide');
                      $('#productform')[0].reset();
                      $('#exampleModalLabel').text('Add Category');
                      $('#categorysave').val('Submit');
                      $('#hid').val("");
                      $('.text-danger').text('');
             },
             error: function (xhr) {
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
     //});
    function loaddata()
     {
      $.ajax({
        url: 'category/index',
        method: 'GET',
        success: function (data) {
            const tableBody = $('#productTable');
            tableBody.empty(); // Clear existing rows
  
            // Loop through the employees and append rows\
            if (data.length === 0) {
              tableBody.append(`
                  <tr>
                      <td colspan="4" style="text-align: center;">No data available</td>
                  </tr>
              `);
          }
           else
           {
              data.forEach(product => {
                const statusButton = product.status === 1
                    ? `<button class="btn btn-success">Active</button>`
                    : `<button class="btn btn-danger">Inactive</button>`;

                  const row = `
                      <tr>
                          <td>${product.id}</td>
                          <td>${product.name}</td>
                          <td>${statusButton}</td>
                          
                         <td>
                                <button class="btn btn-info btn-sm" 
                                onclick='editcategory(${product.id })'id="catgoryedit" name="categoryedit">
                                <i class="fa fa-pencil" aria-hidden="true"></i></button>
                              
                                <button class="btn btn-danger btn-sm" 
                                onclick='deletecategory(${product.id })' id="categorydel" name="categorydel">
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
  function editcategory(id)
  {
      console.log(id);
      $('.text-danger').text('');
      $.ajax({
          url:'category/'+id,
          method:'GET',
          success:function(response)
          {
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
  function deletecategory(id)
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
              url:'category/'+id,
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
 
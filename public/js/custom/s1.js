function loaddata()
{
  $.ajax({
        url:"/employee",
        method:'GET',


  });
}

$(document).ready(function() {   
    $(document).on('click', '#empform', function () {  
       
      $('#empsave').on('click',function (e) {
       e.preventDefault();
       let formname=document.getElementById('employeeform');
       let f1=new FormData(formname);
       console.log(f1);
       $.ajax({
              url:"/employee",
              method:'POST',
              contentType: false, // Necessary for FormData
              processData: false,
              data:f1,
            success: function (response) {
              alert("Record Inserted Successfully!!")
                $('#exampleModal').modal('hide');
                $('#employeeform')[0].reset();
           }
       });
      });
    });
    $(document).on('click','#empedit',function(){
        $('#editModal').modal('show');
        const id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: '/employee/' + id, // Laravel route
            type: 'GET',
            data: { id: id },
            success:function(response)
            {
                $("#eid").val(response.id);
                $("#ename").val(response.name);
                $("#eemail").val(response.email);
                console.log(response.department);
               $('#department').val(response.department);
                $('input[name="gender"][value="' + response.gender + '"]').prop('checked', true);
               console.log(response.skills);
               const skills = response.skills.split(',');
               $('input[name="skills"]').each(function () {
                   $(this).prop('checked', skills.includes($(this).val()));
               });
               /*skill.forEach(function (s) {
                $('input[name="skills[]"][value="' + s + '"]').prop('checked', true);
            });*/
            }
        });
    });
    $(document).on('click','#empupdate',function(e){
       
        const id=$("#eid").val();
        console.log(id);
        console.log($("#ename").val());
        console.log($("#eemail").val());
        console.log($("#edepartment").val());
        e.preventDefault();
        let formname=document.getElementById('editemployee');
        console.log(formname);
        let f1=new FormData(formname);
        console.log(f1);
        $.ajax({
               url:"/employee/"+id,
               method:'PATCH',
               headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
               contentType: false, // Necessary for FormData
               processData: false,
               data:f1,
             success: function (response) {
               alert(response.message);
               $('#editModal').modal('hide');
            }
        });
    });
    $(document).on('click','#empdel',function(){
        const id = $(this).data('id');
        console.log(id);
        if (confirm('Are you sure you want to delete this employee?')) 
        {
            $.ajax({
                url: '/employee/' + id, // Laravel route
                method: 'DELETE',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success:function(response)
                {
                  alert(response.message);
                }
            });
        }
        else
        {
            alert('You clicked on cancel button!!');
        }
        
    });
    $(document).on('click', '#employee', function () {
      $('#viewEmployeeModal').modal('show');
        const id = $(this).data('id');
        console.log(id);
        // Fetch employee details using AJAX
        $.ajax({
          url: '/employee/' + id, // Laravel route
          type: 'GET',
            data: { id: id },
            success: function (response) {
              // Populate modal with data
            console.log(response); 
             $("#id").text(response.id);
              $("#name").text(response.name);
              $("#gender").text(response.gender);
              $("#mail").text(response.email);
              $("#dep").text(response.department);
              console.log(response.email);
              console.log(response.department);
              
              $("#skills").text(response.skills);
              
                $('#viewEmployeeModal').show(); // Show modal
            },
            error: function () {
                alert('Failed to fetch data.');
            }
        });
    });
   });
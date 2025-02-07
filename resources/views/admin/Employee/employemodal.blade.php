<!-- Button trigger modal -->
 <button type="button"  id="empform" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    New Employee
  </button>
  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form  id="employeeform" name="employeeform" method="POST">
            <input type="hidden" id="hid" name="hid">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" name="name" id="ename"/>
              <span class="text-danger error-name"></span>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="text" class="form-control" id="email" name="email">
              <span class="text-danger error-email"></span>
            </div>

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Gender</label>
              <input type="radio"  name="gender" id="male" value="Male">
              <label for="recipient-name" class="col-form-label">Male</label>
              <input type="radio"  name="gender" id="female" value="Female">
              <label for="recipient-name" class="col-form-label">Female</label>
              <br>
              <span class="text-danger error-gender"></span>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Department</label>
              <select name="department" id="edepartment" class="form-control">
                <option value="Sales">Sales</option>
                <option value="Development">Development</option>
                <option value="Human Resource">Human Resource</option>
                <option value="Accounts">Accounts</option>
              </select>
              <span class="text-danger error-department"></span>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Skills</label><br>
              <input class="form-check-input" type="checkbox" id="communication" value="Communication" name="skills[]">
              <label class="col-form-label" for="inlineCheckbox1">Communication</label>

              <input class="form-check-input" type="checkbox" id="team work" value="Team Work" name="skills[]">
              <label class="col-form-label" for="inlineCheckbox1">Team Work</label>

              <input class="form-check-input" type="checkbox" id="Leadership" value="Leadership" name="skills[]">
              <label class="col-form-label" for="inlineCheckbox1">Leadership</label>

              <input class="form-check-input" type="checkbox" id="time management" value="Time Management" name="skills[]">
              <label class="col-form-label" for="inlineCheckbox1">Time Management</label><br>
              <span class="text-danger error-skills"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="empsave" id="empsave"/>
        </div>
      </div>
    </div>
  </div>
  <!--show modal-->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Employee Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <table class="table table-striped">
          <tr>
            <td><strong>Code</strong></td>
            <td><span id="employeeCode"></span></td>
          </tr>

          <tr>
            <td><strong>Name</strong></td>
            <td><span id="employeeName"></span></td>
          </tr>
          <tr>
            <td><strong>Email</strong></td>
            <td><span id="employeeEmail"></span></td>
          </tr>
          <tr>
            <td><strong>Department</strong></td>
            <td><span id="employeeDepartment"></span></td>
          </tr>
          <tr>
            <td><strong>Skills</strong></td>
            <td><span id="employeeSkills"></span></td>
          </tr>
         </table>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

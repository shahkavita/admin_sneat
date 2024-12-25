@extends('layout.main')
@section('title')
    Employee List
@endsection
@section('page-name')
Employee List
@endsection
@section('content')
<!-- Button trigger modal -->
<button type="button"  id="empform" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  New Employee
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  id="employeeform" name="employeeform">
          @csrf
       
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="recipient-name" name="name" id="ename">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Gender</label>
            <input type="radio"  name="gender" id="male" value="Male">
            <label for="recipient-name" class="col-form-label">Male</label>
            <input type="radio"  name="gender" id="female" value="Female">
            <label for="recipient-name" class="col-form-label">Female</label>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Department</label>
            <select name="department" id="edepartment" class="form-control">
              <option value="Sales">Sales</option>
              <option value="Development">Development</option>
              <option value="Human Resource">Human Resource</option>
              <option value="Accounts">Accounts</option>
            </select>
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
            <label class="col-form-label" for="inlineCheckbox1">Time Management</label>
 
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

<!-- Bootstrap Table with Header - Footer -->
<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Department</th>
          <th>Skills</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $d=>$s1)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$s1->id}}</strong></td>
          <td>{{$s1->name}}</td>
          <td>{{$s1->email}}</td>
          <td>{{$s1->gender}}</td>
          <td>{{$s1->department}}
          </td>
            <td>{!! implode('<br>', explode(',', $s1->skills)) !!}</td>
                 
          </td> 
          <td>
            <button class="btn btn-primary btn-sm" 
            data-id="{{$s1->id }}" id="employee" name="employee"><i class="fa fa-eye" aria-hidden="true"></i></button>

            <button class="btn btn-info btn-sm" 
            data-id="{{$s1->id }}" id="empedit" name="empedit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
           
            <button class="btn btn-danger btn-sm" 
            data-id="{{$s1->id }}" id="empdel" name="empdel"><i class="fa fa-trash" aria-hidden="true"></i></button>

        </td>
              
        </tr>  
        @endforeach      
      </tbody>
      <tfoot class="table-border-bottom-0">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Department</th>
          <th>Skills</th>
          <th>Actions</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<!--view employee-->
<div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="viewEmployeeModalLabel">Employee Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table class="table table-striped" border="1px">
              <tr>
                <td>
                  <p><strong>Code:</strong> <span id="id"></span></p>
                </td>
              <td>
                <p><strong>Name:</strong> <span id="name"></span></p>
              </td>
            </tr>
            <tr>
              <td>
                <p><strong>Email:</strong> <span id="mail"></span></p>
              </td>
              <td>
                <p><strong>Gender:</strong> <span id="gender"></span></p>
              </td>   
            </tr>
            <tr>
              <td>
                <p><strong>Department:</strong> <span id="dep"></span></p>
                </td>
              <td>
              <p><strong>Skills:</strong> <span id="skills"></span></p>
              </td>
            </tr>
          </table>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
<!-- Bootstrap Table with Header - Footer -->

<!--edit employee-->

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  id="editemployee" name="editemployee" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" class="form-control" id="eid" name="id">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control"  name="name" id="ename">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="eemail" name="email">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Gender</label>
            <input type="radio"  name="gender" id="male" value="Male">
            <label for="recipient-name" class="col-form-label">Male</label>
            <input type="radio"  name="gender" id="female" value="Female">
            <label for="recipient-name" class="col-form-label">Female</label>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Department</label>
            <select name="department" id="department" class="form-control">
              <option value="Sales">Sales</option>
              <option value="Development">Development</option>
              <option value="Human Resource">Human Resource</option>
              <option value="Accounts">Accounts</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Skills</label><br>
            <input class="form-check-input" type="checkbox" id="communication" value="Communication" name="skills">
            <label class="col-form-label" for="inlineCheckbox1">Communication</label>
 
            <input class="form-check-input" type="checkbox" id="team work" value="Team Work" name="skills">
            <label class="col-form-label" for="inlineCheckbox1">Team Work</label>

            <input class="form-check-input" type="checkbox" id="Leadership" value="Leadership" name="skills">
            <label class="col-form-label" for="inlineCheckbox1">Leadership</label>
 
            <input class="form-check-input" type="checkbox" id="time management" value="Time Management" name="skills">
            <label class="col-form-label" for="inlineCheckbox1">Time Management</label>
 
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="empedit" id="empupdate" value="Update"/>
      </div>
    </div>
  </div>
</div>
<!--end of edit employee-->

<hr class="my-5" />
@endsection
@section('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection
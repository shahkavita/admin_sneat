@extends('layout.main')
@section('title')
    Show 
@endsection
@section('page-name')
Employee Details
@endsection
@section('content')
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Employee Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Name:</strong> <span id="employeeName"></span></p>
          <p><strong>Email:</strong> <span id="employeeEmail"></span></p>
          <p><strong>Gender:</strong> <span id="employeegender"></span></p>
          <p><strong>Department:</strong> <span id="employeedepartment"></span></p>
          <p><strong>Skills:</strong> <span id="employeeskills"></span></p>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <tbody>
          <tr>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> 
                Employee Code
            <strong>{{$s1->id}}</strong></td>
          </tr>
          <tr>
            <td>{{$s1->name}}</td>
          </tr>
          <tr>

            <td>{{$s1->email}}</td>
          </tr>
          <tr>
            <td>{{$s1->gender}}</td>
          </tr>
          <tr>
            <td>{{$s1->department}}</td>
          </tr>
            <td>{{$s1->skills}}</td> 
            <td><a href="{{route('employee.index')}}">Back</td>       
          </tr>    
        </tbody>
        
      </table>
    </div>
  </div>
@endsection
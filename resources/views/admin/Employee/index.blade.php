@extends('layout.main')
@section('title')
    Employee List
@endsection
@section('page-name')
Employee List
@endsection
@section('content')
@include('admin.Employee.employemodal')
<!-- Bootstrap Table with Header - Footer -->
<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th style="width: 10px">Id</th>
          <th style="width: 10px">Name</th>
          <th style="width: 20px">Email</th>
          <th style="width: 10px">Gender</th>
          <th style="width: 20px">Department</th>
          <th style="width: 10px">Skills</th>
          <th style="width: 20px">Actions</th>
         
        </tr>
      </thead>
      <tbody id="employeeTable">
            
      </tbody>
      
    </table>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/custom/employee.js')}}"></script>
@endsection
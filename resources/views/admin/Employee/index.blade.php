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
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Department</th>
          <th>Skills</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="employeeTable">
            
      </tbody>
      
    </table>
  </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('js/custom/emp.js')}}"></script>
@endsection
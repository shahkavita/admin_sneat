@extends('admin.layout.index')
@section('admin-title')
   Admin | Employee
@endsection
@section('page-name')
    Employee List
@endsection
@section('admin-content')
    @include('admin.Employee.modal')
    <!-- Bootstrap Table with Header - Footer -->
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Ajax Sourced Server-side -->
       <div class="card" style="padding:30px">
           <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employee </span>/ List</h4>
    
         <div class="card-datatable text-nowrap">
           <table class="cell-border compact stripe" id="employeeTable">
             <thead>
                <tr>
                    <th style="width: 10px">Id</th>
                    <th style="width: 10px">Name</th>
                    <th style="width: 20px">Email</th>
                    <th style="width: 10px">Gender</th>
                    <th style="width: 10px">Department</th>
                    <th style="width: 10px">Skills</th>
                    <th style="width: 10px">Status</th>
                    <th style="width: 20px">Actions</th>

                </tr>
             </thead>
           </table>
         </div>
       </div>
       <!--/ Ajax Sourced Server-side --> 
     </div>
     <!--/ Content -->
@endsection
@section('admin.layout.footer')
    <script src="{{ asset('js/custom/employee.js') }}"></script>
@endsection

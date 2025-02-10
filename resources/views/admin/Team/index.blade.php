@extends('admin.layout.index')
@section('admin-title')
    Admin | Team
@endsection
@section('page-name')
    Team List
@endsection
@section('admin-content')
@include('admin.Team.modal')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Ajax Sourced Server-side -->
   <div class="card" style="padding:30px">
       <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Team/</span>List</h4>

     <div class="card-datatable text-nowrap">
       <table class="cell-border compact stripe" id="teamTable">
         <thead>
           <tr>
               <th>No</th>
               <th>Name</th>
               <th>Role</th>
               <th>Image</th>
               <th>Facebook</th>
               <th>Twitter</th>
               <th>Skype</th>
               <th>Created At</th>
               <th>Updated At</th>
               <th>Action</th>
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
    <script src="{{ asset('js/custom/team.js') }}"></script>
 @endsection
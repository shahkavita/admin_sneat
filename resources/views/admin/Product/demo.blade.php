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

 
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Yajra Datatables Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css">  
</head>
<body>
<div class="container">
    <h1>Laravel 10 Yajra Datatables Tutorial - ItSolutionStuff.com</h1>
    <div>
        <textarea name="editor1" id="editor"></textarea>
    </div>
    <table class="table table-bordered data-table">

        <thead>

            <tr>

                <th>No</th>

                <th>Name</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

</div>

     

</body>

     

<script type="text/javascript">
				
  $(function () {
    var table = $('.data-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('demo.index') }}",

        columns: [

            {data: 'id', name: 'id'},

            {data: 'name', name: 'name'},

            {data: 'status', name: 'status'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });

      
    const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph
    } = CKEDITOR;

    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            licenseKey: '<YOUR_LICENSE_KEY>', // Create a free account on https://portal.ckeditor.com/checkout?plan=free
            plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
  });

</script>
<script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>
   
</html>
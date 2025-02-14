@extends('admin.layout.index')
@section('admin-title')
    Admin | Settings
@endsection
@section('page-name')
    Settings
@endsection
@section('admin-content')
<!-- Content -->
    <!-- Ajax Sourced Server-side -->
     <div class="card-datatable text-nowrap">
        <div class="container mt-6">
            <div class="card shadow-lg">
                <div class="row g-0">
                    <!-- Left Side: Links -->
                    <div class="col-md-3 bg-light" style="margin: 2px">
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-action"><a href="#" class="form-link" data-form="general">General</a></li>
                                <li class="list-group-item list-group-item-action"><a href="#" class="form-link" data-form="theme">Theme</a></li>
                                <li class="list-group-item list-group-item-action"><a href="#" class="form-link" data-form="smtp">SMTP</a></li>
                                <li class="list-group-item list-group-item-action"><a href="#" class="form-link" data-form="socialmedia">Social Media</a></li>
                                <li class="list-group-item list-group-item-action"><a href="#" class="form-link" data-form="additional">Additional</a></li>
                            </ul>
                        </div>
                    </div>
        
                    <!-- Right Side: Dynamic Form -->
                    <div class="col-md-8">
                        <div class="p-4">
                              <div id="form-container">
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('admin.settings.modal')
        <!-- JavaScript -->   
        <!-- Bootstrap JS -->
   </div>
   <!--/ Ajax Sourced Server-side --> 
 <!--/ Content -->

@endsection
@section('admin.layout.footer')
<style>
    /* Prevent text from shifting */
    .list-group-item {
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        padding-left: 15px !important; /* Keep padding consistent */
    }
    .list-group-item.active:hover{
        color: white !important;
       /* Keep padding consistent */
    }
    .list-group-item.active {
        /* Blue highlight */
        color: white !important;
        font-weight: normal !important; /* Prevent bold text */
       
        padding-left: 15px !important; /* Keep padding same to prevent shifting */
    }
   
    .form-link {
        text-decoration: none; /* Remove underline */
        color: inherit; /* Ensure text color follows parent */
        display: block; /* Make the entire area clickable */
        width: 100%; /* Ensure full clickability */
    }
</style>
<script src="{{ asset('js/custom/settings.js') }}"></script>
@endsection
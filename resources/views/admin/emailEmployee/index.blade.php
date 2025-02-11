@extends('admin.layout.index')
@section('admin-title')
   Admin | Email To Employee
@endsection
@section('page-name')
Email To Employee
@endsection
@section('admin-content')
    <!-- Bootstrap Table with Header - Footer -->
     <!-- Content -->
     <h4 class="fw-bold py-1">Email To Employee</h4>
     <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Ajax Sourced Server-side -->
       <div class="card" style="padding:30px">
         
         <div class="card-datatable text-nowrap">
            <form  id="emailemployee" name="emailemployee" method="POST" enctype="multipart/form-data">
               @csrf
                <input type="hidden" id="hid" name="hid">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject"/>
                  <span class="text-danger error-subject"></span>
                </div>
    
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Message</label>
                    <textarea id="message" name="message" class="form-control">
                    </textarea>
                     <span class="text-danger error-message"></span>
                  </div> 
               
                  <div class="mb-3">
                     <input type="submit" name="submit" id="emailsend" value="Send" class="btn btn-primary"/>  
                    <input type="reset" name="reset" id="reset" value="Clear" class="btn btn-secondary"/>  
                  </div> 
               
              </form>
         </div>
       </div>
       <!--/ Ajax Sourced Server-side --> 
     </div>
     <!--/ Content -->
@endsection
@section('admin.layout.footer')
    <script src="{{ asset('js/custom/emailemployee.js') }}"></script>
@endsection

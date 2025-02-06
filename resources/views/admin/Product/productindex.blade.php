@extends('admin.layout.index')
@section('admin-title')
    Admin | Product
@endsection
@section('page-name')
    Product List
@endsection
@section('admin-content')
@include('admin.Product.productmodal')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Ajax Sourced Server-side -->
   <div class="card" style="padding:30px">
       <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span>List</h4>

     <div class="card-datatable text-nowrap">
       <table class="cell-border compact stripe" id="productTable">
         <thead>
           <tr>
               <th>No</th>
               <th>Name</th>
               <th>Description</th>
               <th>Image</th>
               <th>Price</th>
               <th>Status</th>
               <th>Category</th>
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
    <script src="{{ asset('js/custom/product.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endsection
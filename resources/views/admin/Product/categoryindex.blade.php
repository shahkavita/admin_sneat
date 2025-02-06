@extends('layout.main')
@section('title')
    Product 
@endsection
@section('page-name')
Product List
@endsection
@section('content')
@include('admin.Product.categorymodal')
<!-- Bootstrap Table with Header - Footer -->

<div class="card">
  <div class="table-responsive text-nowrap">
    <table id="categoryTable"  class="datatables-users table border-top" >

      <thead>

          <tr>

              <th>No</th>

              <th>Name</th>

              <th>Status</th>

              <th>Action</th>

          </tr>

      </thead>

      <tbody id="data">
          <tr>
           
          </tr>
      </tbody>

  </table>

  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/custom/product_category.js') }}"></script> 
@endsection

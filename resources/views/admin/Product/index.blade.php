@extends('layout.main')
@section('title')
    Category
@endsection
@section('page-name')
Category
@endsection
@section('content')
@include('admin.Product.categorymodal')
<!-- Bootstrap Table with Header - Footer -->
<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th style="width: 10px">Id</th>
          <th style="width: 10px">Name</th>
          <th style="width: 20px">Status</th>
          <th style="width: 20px">Actions</th>
         
        </tr>
      </thead>
      <tbody id="productTable">
            
      </tbody>
      
    </table>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/custom/product_category.js') }}"></script>
@endsection

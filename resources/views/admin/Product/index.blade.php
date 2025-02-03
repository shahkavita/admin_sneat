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
    <table id="categoryTable">
      <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Status</th>
              <th>Actions</th>
          </tr>
      </thead>
      <tbody></tbody>
  </table>

  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/custom/product_category.js') }}"></script> 
@endsection

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
            <td>1</td>
          </tr>
      </tbody>

  </table>

  </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/custom/product_category.js') }}"></script> 
@endsection

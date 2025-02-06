@extends('admin.layout.index')
@section('admin-title')
    Admin | Category
@endsection
@section('admin-content')
    @include('admin.Product.categorymodal')
       <!-- Content -->
       <div class="container-xxl flex-grow-1 container-p-y">
         <!-- Ajax Sourced Server-side -->
        <div class="card" style="padding:30px">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span>Category</h4>
     
          <div class="card-datatable text-nowrap">
            <table class="cell-border compact stripe" id="categoryTable">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Status</th>
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
    <script src="{{ asset('js/custom/product_category.js') }}"></script>
@endsection

@extends('admin.layout.index')
@section('admin-title')
    Admin | Team
@endsection
@section('page-name')
    Team List
@endsection
@section('admin-content')

<div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-1">Team</h4>
        <div class="row gy-1">
            <div>
                <button class="btn btn-primary float-end ms-2 me-4 mb-2" id="empform" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add
                </button>
            </div>
        </div>
        <div class="card p-2">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table" id="teamTable">
                        <thead class="table-light">
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
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ Content -->
@include('admin.Team.modal')
@endsection
@section('admin.layout.footer')
    <script src="{{ asset('js/custom/team.js') }}"></script>
@endsection



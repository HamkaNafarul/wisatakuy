@extends('layouts.dashboard')
@section('layout_title', 'Daftar Pengguna')
@section('layout_content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin-page') }}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Pengguna</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-yellow-100 border-0 shadow">
                <div class="card-header">
                    <div class="mb-3 mb-sm-0">
                        <div class="row">
                            <div class="col-12 col-lg-6 d-flex">
                                <div class="fs-5 fw-normal justify-content-center align-self-center"><i class="fas fa-user"></i> Daftar Pengguna</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded yajra-datatable w-100">
                            <thead>
                                <tr>
                                    {{-- <th class="border-0 rounded-start text-center">No</th>
                                    <th class="border-0">Username</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Password</th>
                                    <th class="border-0">Role</th>
                                    <th class="border-0 rounded-end no-sort">Aksi</th> --}}
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('layout_script')
    <script>
        $(function () {

          var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('api.user') }}",
              columns: [
                  {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    "width": "10%",
                  },
                  {
                    data: 'nama',
                    name: 'nama'
                  },
                  {
                    data: 'email',
                    name: 'email'
                  },
                  {
                    data: 'admin',
                    name: 'admin'
                  }
              ]
          });

        });
    </script>

@endsection

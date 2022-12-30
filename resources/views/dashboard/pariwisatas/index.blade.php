@extends('layouts.dashboard')
@section('layout_title', 'Objek Pariwisata')
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
            <li class="breadcrumb-item active" aria-current="page">Daftar Objek Pariwisata</li>
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
                            <div class="fs-5 fw-normal justify-content-center align-self-center"><i class="fas fa-igloo"></i> Daftar Objek Wisata</div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <a href="{{ route('pariwisata.create') }}" class="btn btn-primary d-inline-flex align-items-center me-2 float-lg-end">
                                <i class="fas fa-add me-2"></i>
                                Tambah Wisata
                            </a>
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
                    <table class="table table-centered table-nowrap w-100 mb-0 rounded yajra-datatable">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0 rounded-start text-center">#</th>
                                <th class="border-0">Nama</th>
                                <th class="border-0">Alamat</th>
                                <th class="border-0">Jenis</th>
                                <th class="border-0">Harga</th>
                                <th class="border-0 rounded-end no-sort">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('layout_script')
    <script>
        $(document).ready(function(){
            var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('api.wisata') }}",
              columns: [
                  {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                  },
                  {
                    data: 'nama',
                    name: 'nama'
                  },
                  {
                    data: 'alamat',
                    name: 'alamat'
                  },
                  {
                    data: 'nama_kategori',
                    name: 'nama_kategori'
                  },
                  {
                    data: 'harga',
                    name: 'harga'
                  },
                  {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    "render": function ( data, type, row, meta ) {
                        return '<a href="/admin-page/pariwisata/'+ data[0] +'/edit" class="btn btn-sm btn-warning btn-edit me-2" data-id="'+ data[0] +'" data-nama="'+ data[1] +'"><i class="fas fa-pencil me-2"></i>Edit</a> <button class="btn btn-sm btn-danger btn-delete" data-id="'+ data[0] +'" data-nama="'+ data[1] +'"><i class="fas fa-trash me-2"></i>Hapus</button>'
                    },
                  },
              ],
              columnDefs: [
                  {
                    "className": "dt-center",
                    "targets": [0,5]
                  }
              ]
          });
        });
    </script>


    <script>
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var nama = $(this).data('nama');
            var id = $(this).data('id');

            Swal.fire({
                icon: 'warning',
                title: 'Hapus '+nama+'?',
                text: 'Data yang terhapus tidak dapat dikembalikan.',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/admin-page/pariwisata/'+id,
                        type: 'DELETE',
                        dataType: 'html',
                        data: {method: '_DELETE', submit: true},

                        success: function(data) {
                            if (data == true) {
                                Swal.fire({
                                    title: 'Dihapus!',
                                    text: 'Wisata berhasil dihapus.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Wisata gagal dihapus.',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(){
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Wisata gagal dihapus.',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }).always(function (data) {
                        $('.yajra-datatable').DataTable().draw(false);
                    });
                }
            })
        });
    </script>
@endsection

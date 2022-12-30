@extends('layouts.dashboard')
@section('layout_title', 'Kategori Wisata')
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
                                <div class="fs-5 fw-normal justify-content-center align-self-center"><i class="fas fa-water"></i> Kategori Wisata</div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <button type="button" class="btn btn-primary d-inline-flex align-items-center me-2 float-lg-end" data-bs-toggle="modal" data-bs-target="#modal-form">
                                    <i class="fas fa-add me-2"></i>
                                    Tambah Kategori
                                </button>
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
                                    <th>#</th>
                                    <th>Jenis Wisata</th>
                                    <th>Aksi</th>
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

    
    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card p-3 p-lg-4">
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h4">Tambah Kategori Wisata</h1>
                        </div>
                        <div class="alert alert-danger print-error-msg mb-0" style="display:none">
                            <ul class="mb-0"></ul>
                        </div>
                        <div class="mt-4">
                            @csrf
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="jenis">Nama Kategori</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-water"></i>
                                    </span>
                                    <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror" placeholder="Nama Kategori" value="{{ old('jenis') }}" id="jenis" autofocus required>
                                </div>  
                                @error('jenis')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End of Form -->
                            <div class="d-grid">
                                <button class="btn btn-gray-800 btn-tambah">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card p-3 p-lg-4">
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h4">Edit Kategori Wisata</h1>
                        </div>
                        <div class="alert alert-danger print-error-edit mb-0" style="display:none">
                            <ul class="mb-0"></ul>
                        </div>
                        <div class="mt-4">
                            <!-- Form -->
                            <input type="hidden" id="te-id" value="">
                            <div class="form-group mb-4">
                                <label for="jenis">Nama Kategori</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-water"></i>
                                    </span>
                                    <input type="text" name="te-jenis" class="form-control @error('jenis') is-invalid @enderror" placeholder="Nama Kategori" value="" id="te-jenis" autofocus required>
                                </div>  
                            </div>
                            <!-- End of Form -->
                            <div class="d-grid">
                                <button class="btn btn-gray-800 btn-submit-edit">Edit</button>
                            </div>
                        </div>
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
              ajax: "{{ route('api.kategori') }}",
              columns: [
                  {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex', 
                    orderable: false,
                    searchable: false
                  },
                  {
                    data: 'jenis',
                    name: 'jenis'
                  },
                  {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                    "render": function ( data, type, row, meta ) { 
                        $id = data[0]
                        return '<button class="btn btn-warning btn-edit me-2" data-id="'+ data[0] +'" data-remote="/dashboard/kategori/'+ data[0] +'" data-jenis="'+ data[1] +'"><i class="fas fa-pencil me-2"></i>Edit</button> <button class="btn btn-danger delete-confirm" data-id="'+ data[0] +'" data-jenis="'+ data[1] +'"><i class="fas fa-trash me-2"></i>Hapus</button>'
                    },
                  },
              ]
          });
          
        });
    </script>
    <script>
        $(document).on('click', '.delete-confirm', function (e) { 
            e.preventDefault();
            var nama = $(this).data('jenis');
            var id = $(this).data('id');

            Swal.fire({
                icon: 'warning',
                title: 'Hapus '+nama+'?',
                text: 'Data objek wisata yang berelasi akan dihapus',
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
                        url: '/admin-page/kategori/'+id,
                        type: 'DELETE',
                        dataType: 'html',
                        data: {method: '_DELETE', submit: true},

                        success: function(data) {
                            console.log(data); //Try to log the data and check the response
                            if (data == true) {
                                Swal.fire({
                                    title: 'Dihapus!',
                                    text: 'Kategori berhasil dihapus.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                reset();
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Kategori gagal dihapus.',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                reset();
                            }
                        },
                        error: function(){
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Kategori gagal dihapus.',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            reset();
                        }
                    }).always(function (data) {
                        $('.yajra-datatable').DataTable().draw(false);
                    });
                }
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".btn-tambah").click(function(e){
                e.preventDefault();
        
                var _token = $("input[name='_token']").val();
                var jenis = $("input[name='jenis']").val();
        
                $.ajax({
                    url: "{{ route('kategori.store') }}",
                    type:'POST',
                    data: {_token:_token, jenis:jenis},
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil ditambahkan.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#modal-form').modal('hide');
                            $('.yajra-datatable').DataTable().draw(true);
                            reset();
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
        
            }); 
        
            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
        });
    </script>
    <script>
        $(document).on('click', '.btn-edit', function (e) {
            reset();
            var jenis = $(this).data('jenis');
            var id  = $(this).data('id');

            $('#modal-edit').modal('show');
            $('#te-jenis').val(jenis).trigger('change');
            $('#te-id').val(id).trigger('change');
        }); 
        
        $(".btn-submit-edit").click(function(e){
            e.preventDefault();
    
            var _token = $("input[name='_token']").val();
            var jenis = $("#te-jenis").val();
            var id  = $("#te-id").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin-page/kategori/'+id,
                type: 'PATCH',
                dataType: 'json',
                data: {method: '_PATCH', kategori: id, jenis:jenis},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil dirubah.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modal-edit').modal('hide');
                        $('.yajra-datatable').DataTable().draw(true);
                        reset();
                    }else{
                        printErrorEdit(data.error);
                    }
                }
            });
    
        }); 
    
        function printErrorEdit (msg) {
            $(".print-error-edit").find("ul").html('');
            $(".print-error-edit").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-edit").find("ul").append('<li>'+value+'</li>');
            });
        }
    </script>
    <script>
        function reset(){
            $(".print-error-edit").css('display','none');
            $(".print-error-msg").css('display','none');
            $("#jenis").val('').trigger('change');
            $("#te-jenis").val('').trigger('change');
            $('#te-id').val('').trigger('change');
            $('.btn-submit-edit').attr('data-id', '').trigger('change');
        }
    </script>
@endsection

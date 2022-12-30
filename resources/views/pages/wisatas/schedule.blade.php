@extends('layouts.public')
@section('layout_title', 'Daftar Pesanan')
@section('layout_content')
    <section class="section-details-header details-page-header"></section>
    <section class="section-details-content details-page-content">
        <div class="container">
            <div class="row">
                <div class="col p-3 p-lg-0">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                Destinasi Wisata
                            </li>
                            <li class="breadcrumb-item active">
                                Pesanan Saya
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pl-lg-0">
                    <div class="card card-details">
                        <div class="row">
                            <div class="col-12">
                                {{-- <h1>{{ $wisata->nama }}</h1> --}}
                            </div>
                        </div>
                        <div class="gallery mt-3">
                            <div class="col-12 mb-4">
                                <div class="card border-0 shadow">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap w-100 mb-0 rounded yajra-datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="border-0 rounded-start text-center">No</th>
                                                        <th class="border-0">Tanggal</th>
                                                        <th class="border-0">Nama Wisata</th>
                                                        <th class="border-0">Gambar</th>
                                                        <th class="border-0">Jumlah orang</th>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- modal detil --}}
    <div class="modal fade" id="modal-detil" tabindex="-1" role="dialog" aria-labelledby="modal-detil" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">QR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                        <div class="mt-1" >                            
                            <div class="qr d-flex justify-content-center" id="qr">
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>        


@endsection
@section('layout_script')
    <!-- Barcode -->
    <script src="/vendor/qr/jquery.classyqr.min.js"></script>

    <script>
        $(document).ready(function(){
            var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('jadwal.index') }}",
              columns: [
                  {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex', 
                    orderable: false,
                    searchable: false
                  },
                  {
                    data: 'date',
                    name:'date'
                  },
                  {
                    data: 'nama_objek_wisata',
                    name: 'nama_objek_wisata'
                  },
                  {
                    data: 'gambar',
                    name:'gambar',
                    orderable: false, 
                    searchable: false,
                    "render": function ( data, type, full, meta ) { 
                        // return '<a href="/admin-page/pariwisata/'+ data[0] +'/edit" class="btn btn-sm btn-warning btn-edit me-2" data-id="'+ data[0] +'" data-nama="'+ data[1] +'"><i class="fas fa-pencil me-2"></i>Edit</a> <button class="btn btn-sm btn-danger btn-delete" data-id="'+ data[0] +'" data-nama="'+ data[1] +'"><i class="fas fa-trash me-2"></i>Hapus</button>'
                        return '<img src="'+data+'" class="p-1" alt="gambar" height="75px">';
                    },
                  },
                  {
                    data: 'jumlah_orang',
                    name: 'jumlah_orang'
                  },
                  {
                    data: 'total_anggaran',
                    name: 'total_anggaran'
                  },
                  {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                    "render": function ( data, type, row, meta ) { 
                        return '<a class="btn btn-sm btn-warning btn-detil me-2" data-id="'+ data[0]+'" data-remote="/jadwal/'+data[0]+'" data-kode="'+data[1]+'"><i class="fas fa-qrcode me-2"></i> QR Code</a>'
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
        $(document).on('click', '.btn-detil', function(e){
            e.preventDefault();
            var kode = $(this).data('kode');
            $('#modal-detil').modal('show');
            if ($('#qr').is(':empty')) {
                $('#qr').ClassyQR({
                create: true, // signals the library to create the image tag inside the container div.
                type: 'text', // text/url/sms/email/call/locatithe text to encode in the QR. on/wifi/contact, default is TEXT
                text: kode // the text to encode in the QR. 
                });
            }
                // console.log(kode);
        });
    </script>
    <script>
        $(document).on('click', '.close', function(e){
            $('#qr').empty();;
        })
    </script>
@endsection
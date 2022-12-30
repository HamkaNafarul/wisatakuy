@extends('layouts.public')
@section('layout_title', $wisata->nama )
@section('layout_content')

<style>
    .file-field input[type=file] {
    max-width: 230px;
    position: absolute;
    cursor: pointer;
    opacity: 0;
    padding-bottom: 30px;
    }
    .avatar-xl{
        width: 20rem;

    }
    .img{
        max-width: 100%;
    }
</style>
        <section class="section-details-header details-page-header"></section>
        <section class="section-details-content details-page-content" style="margin-bottom: 30px">
            <div class="container">
                <div class="row">
                    <div class="col p-3 p-lg-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    Destinasi Wisata
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ $wisata->nama }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            <div class="row">
                                <div class="col-12 col-lg-10">
                                    <h1>{{ $wisata->nama }}</h1>
                                    <p class="mb-0">{{ $wisata->nama_kecamatan }}</p>
                                </div>
                                <div class="col-12 col-lg-2 mb-2 mb-lg-0">
                                    <a href="{{ route('public.wisata.lokasi', $wisata->id_objek_wisata) }}" class="btn btn-md btn-block btn-danger">Lokasi</a>
                                </div>
                            </div>
                            <div class="gallery mt-3">
                                <div class="xzoom-container">
                                    <img src="{{ asset($wisata->gambar) }}" class="xzoom" id="xzoom-default" xoriginal="{{ asset($wisata->gambar) }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10">
                                    <h1>Tentang Wisata</h1>
                                </div>
                                <div class="col-2 text-right">
                                    <button class="btn btn-lg p-0"><i class="far fa-bookmark fa-lg"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {!! $wisata->deskripsi !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3 mt-lg-0 mb-3">
                        <div class="card card-details card-right card-detail">
                            <h2>Informasi Wisata</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%" class="font-weight-bold">Tipe Wisata</th>
                                    <td width="50%" class="text-right font-weight-bold">
                                        {{ $wisata->nama_kategori }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%" class="font-weight-bold">Harga</th>
                                    <td width="50%" class="text-right font-weight-bold">
                                        Rp. {{ $wisata->harga }} / <i class="fas fa-user"></i>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            {{-- <form action="" method="post"> --}}
                                <button class="btn agendakan btn-block btn-join-now mt-3 py-2" type="submit" data-bs-toggle="modal" data-bs-target="#modal-pesan">
                                    Agendakan Sekarang
                                </button>
                            {{-- </form> --}}
                        </div>

                        {{-- <div class="card card-details card-right card-detail details-page-card-rating mt-3">
                            <h2>Rating dan Ulasan</h2>
                            <table class="trip-informations mb-2">
                                <tr>
                                    <td width="100%" class="text-center">
                                        <div id="rater-step" data-rating="4.5"></div>
                                    </td>
                                </tr>
                            </table>
                            <div class="row page-details">
                                <figure class="fir-image-figure">
                                    <div class="fir-imageover">
                                        <img class="fir-author-image fir-clickcircle" src="https://fir-rollup.firebaseapp.com/de-sm.jpg" alt="David East - Author" />
                                    </div>
                                    <figcaption>
                                        <div class="fig-author-figure-title">
                                            David East
                                        </div>
                                        <div class="fig-author-figure-title">
                                            Pemandangan indah, biaya masuk murah, stand
                                            makanan dan minuman sangat beragam.
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div> --}}
                        {{-- <div class="join-container">
                            <form action="" method="post">
                                <button class="btn btn-block btn-rating mt-3 py-2" type="submit" data-bs-toggle="modal" data-bs-target="#modal-ulasan">
                                    Beri Ulasan
                                </button>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>

    {{-- modal pesan --}}
        <div class="modal fade" id="modal-pesan" tabindex="-1" role="dialog" aria-labelledby="modal-pesan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pesan Tiket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="card p-3 p-lg-4">
                            <div class="alert alert-danger print-error-msg mb-0" style="display:none" role="alert">
                                <ul class="mb-0"></ul>
                            </div>
                            <div class="mt-4">
                                @csrf
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="jumlah_orang">Jumlah Orang</label>
                                    <input type="hidden" name="id_objek_wisata" value="{{$wisata->id_objek_wisata}}">
                                    <input type="hidden" name="harga" value="{{$wisata->harga}}">
                                    {{-- <input type="hidden" name="id_user" value="{{Auth::user()->id}}"> --}}

                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="number" name="jumlah_orang" min="1" class="form-control @error('jumlah_orang') is-invalid @enderror" placeholder="Jumlah Orang" value="{{ old('jumlah_orang') }}" id="jumlah_orang" autofocus required>
                                    </div>
                                    @error('jumlah_orang')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <label for="tanggal">Tanggal Kunjungan</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                        <input type='date' name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Jumlah Orang" value="{{ old('tanggal') }}" id="tanggal" autofocus required />
                                    </div>
                                    @error('tanggal')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- End of Form -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-pesan">Pesan</button>
                    </div>
                </div>
            </div>
        </div>

    {{-- modal ulasan --}}
        <div class="modal fade" id="modal-ulasan" tabindex="-1" role="dialog" aria-labelledby="modal-ulasan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ulasan untuk {{$wisata->nama}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="card p-3 p-lg-4">
                            <div class="alert alert-danger print-error-msg-ulasan mb-0" style="display:none" role="alert">
                                <ul class="mb-0"></ul>
                            </div>
                            <div class="mt-4">
                                <form action="" id="ulasan-form" method="post">

                                @csrf
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <input type="hidden" name="id_objek_wisata" value="{{$wisata->id_objek_wisata}}">
                                        <div class="col-12">
                                            <div class="card card-body border-0 shadow mb-4">
                                                <h2 class="h5 mb-4">Ulasan</h2>
                                                <div class="form-group">
                                                    <textarea id="my-editor" name="my-editor" class="form-control"></textarea>
                                                </div>
                                                @error('ulasan')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>

                                </div>
                                <!-- End of Form -->
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-ulasan">Kirim Ulasan</button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('layout_script')
    <script>
        $(document).ready(function() {
            $(".close").click(function(e){
                e.preventDefault();
                $('#modal-pesan').modal('hide');
                reset();
            })
            $(".agendakan").click(function(e){
                e.preventDefault();
                $('#modal-pesan').modal('show');

            })
            $(".btn-rating").click(function(e){
                e.preventDefault();
                $('#modal-ulasan').modal('show');

            })

            $(".btn-pesan").click(function(e){
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var id_objek_wisata = $("input[name='id_objek_wisata']").val();
                var jumlah_orang = $("input[name='jumlah_orang']").val();
                var total_anggaran = parseInt(jumlah_orang) * parseInt($("input[name='harga']").val());
                var tanggal = $("input[name='tanggal']").val();
                var benar = false;

                            Swal.fire({
                                icon: 'question',
                                title: 'Pesan tiket untuk'+jumlah_orang+' orang?',
                                text: 'Pesanan akan diproses',
                                showCancelButton: true,
                                confirmButtonText: 'Iya',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: "{{ route('jadwal.store') }}",
                                        type:'POST',
                                        data: {_token:_token, id_objek_wisata:id_objek_wisata, jumlah_orang:jumlah_orang,total_anggaran:total_anggaran, date:tanggal},
                                        timeout:5000,
                                        success:function(data){
                                            if($.isEmptyObject(data.error)){
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil!',
                                                    text: 'Berhasil Memesan Tiket.',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                                $('#modal-pesan').modal('hide');
                                                $("input[name='jumlah_orang']").val('');
                                                $("input[name='tanggal']").val('');
                                                reset();
                                            }else{
                                                printErrorMsg(data.error);
                                            }
                                        },

                                        error: function(){
                                            window.location = "{{ route('jadwal.store') }}";
                                        }
                                    });

                                }
                            })
                            deleteErrorMsg();



            });

            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
            function deleteErrorMsg () {
                $(".print-error-msg").css('display','none');
            }


            $(".btn-ulasan").click(function(e){
                e.preventDefault();
                var form = $('#ulasan-form')[0];
                var _token = $("input[name='_token']").val();
                var id_objek_wisata = $("input[name='id_objek_wisata']").val();
                var date = new Date();
                var dd = String(date.getDate()).padStart(2, '0');
                var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = date.getFullYear();

                date = yyyy + '-' + mm + '-' + dd;
                var desc = CKEDITOR.instances['my-editor'].getData();
                console.log(desc);
                            Swal.fire({
                                icon: 'question',
                                title: 'Yakin membuat ulasan?',
                                text: 'ulasan akan diproses',
                                showCancelButton: true,
                                confirmButtonText: 'Iya',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: "{{ route('ulasan.store') }}",
                                        type:'POST',
                                        data:{_token:_token, id_objek_wisata:id_objek_wisata, ulasan:desc, date:date},
                                        timeout:5000,
                                        success:function(data){
                                        },

                                        error: function(status){
                                            if (status.status==401) {
                                                window.location = "{{ route('jadwal.store')  }}";
                                            }else{
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil!',
                                                    text: 'Berhasil membuat ulasan.',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                                $('#modal-ulasan').modal('hide');
                                                $("textarea[name='ulasan']").val('');

                                            }
                                        }
                                    });

                                }
                            })
                             deleteErrorMsgUlasan();


            });
            function printErrorMsgUlasan (msg) {
                $(".print-error-msg-ulasan").find("ul").html('');
                $(".print-error-msg-ulasan").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg-ulasan").find("ul").append('<li>'+value+'</li>');
                });
            }
            function deleteErrorMsgUlasan () {
                $(".print-error-msg-ulasan").css('display','none');
            }


        });
    </script>

@endsection

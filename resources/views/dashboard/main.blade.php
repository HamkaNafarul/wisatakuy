@extends('layouts.dashboard')
@section('layout_title', 'Main')
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
                <li class="breadcrumb-item active" aria-current="page">Main</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-yellow-100 border-0 shadow">
                <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                    <div class="d-block mb-3 mb-sm-0">
                        <div class="fs-5 fw-normal mb-2"><i class="fas fa-map-marker"></i> Peta Persebaran</div>
                        <h2 class="fs-3 fw-extrabold">{{ count($wisatas) }} Objek Wisata</h2>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div id="map" style="width: 100%; min-height: 450px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-lg-2 col-sm-12 col-md-12 text-xl-center mb-3 mb-xl-0 d-flex align-items-center">
                            <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="col-lg-10 col-sm-12 col-md-12">
                            <div class="">
                                <h2 class="fw-extrabold h5">Pengguna</h2>
                                <h3 class="mb-1">{{ $jumlah_pengguna }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-lg-2 col-sm-12 col-md-12 text-xl-center mb-3 mb-xl-0 d-flex align-items-center">
                            <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                <i class="fas fa-map-marker"></i>
                            </div>
                        </div>
                        <div class="col-lg-10 col-sm-12 col-md-12">
                            <div class="">
                                <h2 class="fw-extrabold h5">Objek Wisata</h2>
                                <h3 class="mb-1">{{ count($wisatas) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-lg-2 col-sm-12 col-md-12 text-xl-center mb-3 mb-xl-0 d-flex align-items-center">
                            <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="col-lg-10 col-sm-12 col-md-12">
                            <div class="">
                                <h2 class="fw-extrabold h5">Ulasan</h2>
                                <h3 class="mb-1">{{ $jumlah_ulasan }}</h3>
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
        var map = L.map('map').setView([-7.9754989, 112.645687], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    @foreach ($wisatas as $wisata)
        L.marker([{{ $wisata->latitude_Y }}, {{ $wisata->longitude_X }}]).addTo(map)
            .bindPopup("{{ $wisata->nama }}");
    @endforeach
    </script>
@endsection
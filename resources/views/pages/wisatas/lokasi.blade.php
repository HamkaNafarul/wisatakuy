@extends('layouts.public')
@section('layout_title')
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
                                <li class="breadcrumb-item">
                                    {{ $wisata->nama }}
                                </li>
                                <li class="breadcrumb-item active">
                                    Lokasi
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
                                    <h1>{{ $wisata->nama }}</h1>
                                </div>
                            </div>
                            <div class="gallery mt-3">
                                <div class="xzoom-container">
                                    <div class="w-100 travel-details-map" id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
@section('layout_script')
<script>
    var map = L.map('map').setView([-7.9754989, 112.645687], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $wisata->latitude_Y }}, {{ $wisata->longitude_X }}]).addTo(map)
        .bindPopup('{{ $wisata->nama }}')
        .openPopup();
</script>
@endsection
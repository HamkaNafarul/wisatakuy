@extends('layouts.public')
@section('layout_title', 'Daftar Wisata')
@section('layout_content')

        <section class="section-map main-section" id="popular">
			<div class="container">
				<div class="row">
					<div class="col text-center section-map-heading">
                        <h2 class="fs-5 fw-normal mb-2 text-center"><i class="fas fa-map-marker"></i> Peta Persebaran</h2>
                        <p class="fs-3 fw-extrabold">{{ count($wisatas) }} Objek Wisata</p>
					</div>
				</div>
			</div>
		</section>
        <section class="section-map-content main-section" id="popular">
            <div class="container">
                <div class="col-12 mb-4 p-2">
                    <div class="card bg-yellow-100 border-0 shadow">
                        <div class="card-body p-">
                            <div id="map" style="width: 100%; min-height: 450px;"></div>
                        </div>
                    </div>
                </div>
			</div>
		</section>


		<section class="section-popular main-section" id="popular" style="margin-bottom: -300px !important;">
			<div class="container">
				<div class="row">
					<div class="col text-center section-popular-heading" >
					<h2>Daftar Destinasi Wisata</h2>
					</div>
				</div>
			</div>
		</section>


		<section class="section-popular-content" id="popularContent">
			<div class="container">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="section-popular-travel row justify-content-center">
                            @foreach ($wisatas as $wisata)
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="border-0 shadow rounded card-travel text-center d-flex flex-column" style="background-image: url('{{ urlencode($wisata->gambar) }}');" >
                                    <div class="travel-country">{{ $wisata->nama_kecamatan }}</div>
                                    <div class="travel-location">{{ $wisata->nama }}</div>
                                    <div class="travel-button mt-auto">
                                        <a href="{{ route('public.wisata', $wisata->id_objek_wisata) }}" class="btn btn-travel-details px-4">
                                            Detail Wisata
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div aria-label="Page navigation example" class="row" style="margin-top: 20px">
                    {{ $wisatas->links() }}
                </div>
			</div>
		</section>
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
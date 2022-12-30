@extends('layouts.dashboard')
@section('layout_title', 'Edit Objek Wisata')
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
            <li class="breadcrumb-item">Objek Wisata</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $wisata->nama }}</li>
        </ol>
    </nav>
</div>
<form action="{{ route('pariwisata.update', $wisata->id_objek_wisata) }}" method="POST" enctype='multipart/form-data'>
    @method('PATCH')
    @csrf
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="row">
      <div class="col-12 mb-4">
          <div class="card bg-yellow-100 border-0 shadow">
              <div class="card-header">
                  <div class="mb-3 mb-sm-0">
                      <div class="row">
                          <div class="col-12 col-lg-6 d-flex">
                              <div class="fs-5 fw-normal justify-content-center align-self-center"><i class="fas fa-igloo"></i> {{ $wisata->nama }}</div>
                          </div>
                          <div class="col-12 col-lg-6">
                              <button type="submit" class="btn btn-primary d-inline-flex align-items-center me-2 float-lg-end">
                                  <i class="fas fa-save me-2"></i>
                                  Simpan
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-12 col-xl-8">
          <div class="card card-body border-0 shadow mb-4">
              <h2 class="h5 mb-4">Informasi</h2>
              <div class="row">
                  <div class="col-12 mb-3">
                      <div>
                          <label for="nama">Nama</label>
                          <input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" type="text" placeholder="Nama Objek Wisata" value="{{ old('nama', $wisata->nama) }}" required>
                          @error('nama')
                          <p class="text text-danger">{{ $message }}</p>
                          @enderror
                      </div>
                  </div>
              </div>
              <div class="row align-items-center">
                  <div class="col-md-6 mb-3">
                      <label for="jenis_wisata">Kategori</label>
                      <select class="form-select w-100 mb-0 @error('jenis_wisata') is-invalid @enderror" id="jenis_wisata" name="jenis_wisata" required>
                          <option selected>Jenis Wisata</option>
                          @foreach ($kategoris as $kategori)
                          <option value="{{ $kategori->id_jenis_wisata }}">{{ $kategori->jenis }}</option>
                          @endforeach
                      </select>
                      @error('jenis_wisata')
                      <p class="text text-danger">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="harga">Harga</label>
                      <div class="input-group">
                          <span class="input-group-text">
                              <i class="fas fa-dollar"></i>
                          </span>
                          <input class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" type="text" placeholder="Harga" value="{{ old('harga', $wisata->harga) }}" required>
                          @error('harga')
                          <p class="text text-danger">{{ $message }}</p>
                          @enderror
                      </div>
                  </div>
              </div>
              <div class="row">
                  <h2 class="h5 mb-4">Deskripsi</h2>
                  <div class="form-group">
                      <textarea id="my-editor" name="deskripsi" class="form-control">{{  old('deskripsi', $wisata->deskripsi)  }}</textarea>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-12 col-xl-4">
          <div class="row">
              <div class="col-12">
                  <div class="card card-body border-0 shadow mb-4">
                      <h2 class="h5 mb-4">Gambar</h2>
                      <div class="d-flex align-items-center">
                          <div class="me-3">
                            <img class="rounded avatar-xl gambar-preview" src="/{{ old('gambar', $gambar) }}" alt="change" id="gambar-preview" />
                          </div>
                          <div class="file-field">
                              <div class="d-flex justify-content-xl-center ms-xl-3">
                                  <div class="d-flex">
                                    <svg class="icon text-gray-500 me-2" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <input type="file" id="gambar" name="gambar" accept="image/png, image/jpeg" onchange="document.getElementById('gambar-preview').src = window.URL.createObjectURL(this.files[0])"  required>
                                    <div class="d-md-block text-left">
                                        <div class="fw-normal text-dark mb-1">Pilih Gambar Baru</div>
                                        <div class="text-gray small">JPG atau PNG. Maksimal 1MB</div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      @error('gambar')
                      <p class=" mt-1 text text-danger">{{ $message }}</p>
                      @enderror
                  </div>
              </div>
              <div class="col-12">
                  <div class="card card-body border-0 shadow">
                      <h2 class="h5 mb-4">Lokasi</h2>
                      <div class="row mb-3">
                          <div class="col-12">
                              <div id="map-box" class="w-100" style="min-height: 350px;"></div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-8 mb-3">
                              <div class="form-group">
                                  <label for="alamat @error('alamat') is-invalid @enderror">Alamat</label>
                                  <input class="form-control" name="alamat" id="alamat" type="text" placeholder="Alamat" value="{{ old('alamat', $wisata->alamat) }}" required>
                                  @error('alamat')
                                  <p class="text text-danger">{{ $message }}</p>
                                  @enderror
                              </div>
                          </div>
                          <div class="col-sm-4 mb-3">
                              <label for="kecamatan">Kecamatan</label>
                              <select class="form-select w-100 mb-0 @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" required>
                                  <option selected>Kecamatan</option>
                                  @foreach ($kecamatans as $kecamatan)
                                  <option value="{{ $kecamatan->id_kecamatan }}">{{ $kecamatan->kecamatan }}</option>
                                  @endforeach
                              </select>
                              @error('kecamatan')
                              <p class="text text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="latitude_Y">Latitude</label>
                                  <input class="form-control @error('latitude_Y') is-invalid @enderror" name="latitude_Y" id="latitude_Y" type="text" placeholder="Latitude" value="{{ old('latitude_Y', $wisata->latitude_Y) }}" required>
                              </div>
                              @error('latitude_Y')
                              <p class="text text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="longitude_X">Longitude</label>
                                  <input class="form-control @error('longitude_X') is-invalid @enderror" name="longitude_X" id="longitude_X" type="text" placeholder="Longitude" value="{{ old('longitude_X', $wisata->longitude_X) }}" required>
                              </div>
                              @error('longitude_X')
                              <p class="text text-danger">{{ $message }}</p>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</form>
@endsection
@section('layout_script')
    <script>
        var map = L.map('map-box').setView([-7.8058, 112.1096], 11);
        var marker;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map)

        map.on('click', function (e) {
            if (marker) { // check
                map.removeLayer(marker); // remove
            }
            marker = new L.Marker([e.latlng.lat, e.latlng.lng]).addTo(map); // set
            $('#latitude_Y').val(e.latlng.lat);
            $('#longitude_X').val(e.latlng.lng);
        });

        $('#latitude_Y').on('keyup change', function () {
            var latitude = $('#latitude_Y').val();
            var longitude = $('#longitude_X').val();

            if (marker) { // check
                map.removeLayer(marker); // remove
            }
            marker = new L.Marker([latitude, longitude]).addTo(map); // set
            map.setView([latitude, longitude], 11);
        });

        $('#longitude_X').on('keyup change', function () {
            var latitude = $('#latitude_Y').val();
            var longitude = $('#longitude_X').val();

            if (marker) { // check
                map.removeLayer(marker); // remove
            }
            marker = new L.Marker([latitude, longitude]).addTo(map); // set
            map.setView([latitude, longitude], 11);
        });

        @if (old('latitude_X', $wisata->latitude_Y) != null)
            $('#latitude_Y').trigger('change');
        @endif
    </script>
    <script>
        $("#kecamatan").val({{ old('kecamatan', $wisata->kecamatan) }}).change();
        $("#jenis_wisata").val({{ old('jenis_wisata', $wisata->jenis_wisata) }}).change();
    </script>
@endsection
